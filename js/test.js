   // Pedometer functionality with enhanced debugging  
   let stepCount = 0;  
   let isCounting = false;  
   let lastTimestamp = 0;  
   let activityHistory = [];  
   let chart;  
   let strideLength = 0.762; // meters  
   let weight = 70;  
   
   // DOM elements  
   const stepsElement = document.getElementById('steps');  
   const distanceElement = document.getElementById('distance');  
   const caloriesElement = document.getElementById('calories');  
   const startBtn = document.getElementById('startBtn');  
   const stopBtn = document.getElementById('stopBtn');  
   const resetBtn = document.getElementById('resetBtn');  
   const historyBody = document.getElementById('historyBody');  
   const installBtn = document.getElementById('installBtn');  
   
   // Debug panel elements  
   const debugPanel = document.createElement('div');  
   debugPanel.id = 'debugPanel';  
   debugPanel.style.position = 'fixed';  
   debugPanel.style.bottom = '0';  
   debugPanel.style.left = '0';  
   debugPanel.style.width = '100%';  
   debugPanel.style.backgroundColor = 'rgba(0,0,0,0.8)';  
   debugPanel.style.color = 'white';  
   debugPanel.style.padding = '10px';  
   debugPanel.style.maxHeight = '150px';  
   debugPanel.style.overflowY = 'auto';  
   debugPanel.style.fontFamily = 'monospace';  
   debugPanel.style.fontSize = '12px';  
   debugPanel.style.zIndex = '1000';  
   debugPanel.style.display = 'none';  
   document.body.appendChild(debugPanel);  
   
   const debugToggle = document.createElement('button');  
   debugToggle.textContent = 'Toggle Debug';  
   debugToggle.style.position = 'fixed';  
   debugToggle.style.bottom = '160px';  
   debugToggle.style.right = '10px';  
   debugToggle.style.zIndex = '1001';  
   debugToggle.addEventListener('click', () => {  
       debugPanel.style.display = debugPanel.style.display === 'none' ? 'block' : 'none';  
   });  
   document.body.appendChild(debugToggle);  
   
   function debugLog(message) {  
       console.log(message);  
       const debugEntry = document.createElement('div');  
       debugEntry.textContent = `[${new Date().toLocaleTimeString()}] ${message}`;  
       debugPanel.appendChild(debugEntry);  
       debugPanel.scrollTop = debugPanel.scrollHeight;  
   }  
   
   function showAlert(message, isError = false) {  
       const alertDiv = document.createElement('div');  
       alertDiv.textContent = message;  
       alertDiv.style.position = 'fixed';  
       alertDiv.style.top = '20px';  
       alertDiv.style.left = '50%';  
       alertDiv.style.transform = 'translateX(-50%)';  
       alertDiv.style.padding = '10px 20px';  
       alertDiv.style.borderRadius = '5px';  
       alertDiv.style.backgroundColor = isError ? '#ff4444' : '#4CAF50';  
       alertDiv.style.color = 'white';  
       alertDiv.style.zIndex = '1000';  
       alertDiv.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';  
       document.body.appendChild(alertDiv);  
       
       setTimeout(() => {  
           alertDiv.style.opacity = '0';  
           setTimeout(() => document.body.removeChild(alertDiv), 500);  
       }, 3000);  
   }  
   
   // Initialize Chart  
   function initializeChart() {  
       try {  
           const ctx = document.getElementById('activityChart').getContext('2d');  
           chart = new Chart(ctx, {  
               type: 'line',  
               data: {  
                   labels: [],  
                   datasets: [{  
                       label: 'Steps',  
                       data: [],  
                       borderColor: '#4CAF50',  
                       backgroundColor: 'rgba(76, 175, 80, 0.1)',  
                       borderWidth: 2,  
                       tension: 0.1,  
                       fill: true  
                   }]  
               },  
               options: {  
                   responsive: true,  
                   maintainAspectRatio: false,  
                   scales: {  
                       y: {  
                           beginAtZero: true  
                       }  
                   }  
               }  
           });  
           debugLog('Chart initialized successfully');  
       } catch (error) {  
           debugLog(`Error initializing chart: ${error.message}`);  
           showAlert('Error initializing chart', true);  
       }  
   }  
   
   // Update chart with new data  
   function updateChart() {  
       try {  
           const now = new Date();  
           const timeLabel = `${now.getHours()}:${now.getMinutes().toString().padStart(2, '0')}`;  
           
           debugLog(`Updating chart with ${stepCount} steps at ${timeLabel}`);  
           
           chart.data.labels.push(timeLabel);  
           chart.data.datasets[0].data.push(stepCount);  
           
           if (chart.data.labels.length > 12) {  
               chart.data.labels.shift();  
               chart.data.datasets[0].data.shift();  
           }  
           
           chart.update();  
           debugLog('Chart updated successfully');  
       } catch (error) {  
           debugLog(`Error updating chart: ${error.message}`);  
       }  
   }  
   
   // Handle device motion  
   function handleMotion(event) {  
       if (!isCounting) {  
           debugLog('Motion detected but counting is not active');  
           return;  
       }  
       
       try {  
           const acceleration = event.accelerationIncludingGravity;  
           const timestamp = event.timeStamp || Date.now();  
           
           if (!acceleration) {  
               debugLog('No acceleration data available in motion event');  
               return;  
           }  
           
           // Debug output for motion data  
           debugLog(`Motion data - x: ${acceleration.x?.toFixed(2) || 'null'}, y: ${acceleration.y?.toFixed(2) || 'null'}, z: ${acceleration.z?.toFixed(2) || 'null'}`);  
           
           // Calculate magnitude of acceleration  
           const magnitude = Math.sqrt(  
               (acceleration.x || 0) ** 2 +   
               (acceleration.y || 0) ** 2 +   
               (acceleration.z || 0) ** 2  
           );  
           
           debugLog(`Calculated magnitude: ${magnitude.toFixed(2)}`);  
           
           // Check if enough time has passed since the last step (increased debounce to 500ms)  
           if (timestamp - lastTimestamp > 500) { // Increased from 300ms to 500ms  
               // Increased threshold to 12 for better step detection  
               if (magnitude > 12) {  
                   stepCount++;  
                   debugLog(`Step detected! Total steps: ${stepCount}`);  
                   
                   updateDisplay();  
                   updateChart();  
                   lastTimestamp = timestamp;  
                   
                   // Add history entry every 10 steps  
                   if (stepCount % 10 === 0) {  
                       addHistoryEntry();  
                   }  
                   
                   showAlert(`Step counted: ${stepCount}`);  
               }  
           } else {  
               debugLog('Motion ignored - too soon after last step');  
           }  
       } catch (error) {  
           debugLog(`Error processing motion event: ${error.message}`);  
           showAlert('Error processing motion', true);  
       }  
   }  
   
   // Start counting steps  
   async function startCounting() {  
       debugLog('Attempting to start step counting...');  
       
       if (isCounting) {  
           debugLog('Already counting steps');  
           return;  
       }  
       
       try {  
           // Check for motion sensor support  
           if (typeof DeviceMotionEvent !== 'undefined') {  
               debugLog('DeviceMotionEvent is supported');  
               
               // iOS 13+ requires permission  
               if (typeof DeviceMotionEvent.requestPermission === 'function') {  
                   debugLog('Requesting motion permission...');  
                   const permission = await DeviceMotionEvent.requestPermission();  
                   
                   if (permission === 'granted') {  
                       debugLog('Motion permission granted');  
                       startMotionTracking();  
                   } else {  
                       debugLog('Motion permission denied');  
                       showAlert('Motion permission is required', true);  
                       return;  
                   }  
               } else {  
                   debugLog('No permission required (non-iOS device)');  
                   startMotionTracking();  
               }  
           } else {  
               debugLog('DeviceMotionEvent not supported');  
               showAlert('Motion sensors not supported', true);  
               startMockSensor();  
           }  
       } catch (error) {  
           debugLog(`Error starting step counting: ${error.message}`);  
           showAlert('Error starting step counter', true);  
       }  
   }  
   
   function startMotionTracking() {  
       debugLog('Starting motion tracking...');  
       isCounting = true;  
       startBtn.disabled = true;  
       stopBtn.disabled = false;  
       
       // Add event listener for motion  
       window.addEventListener('devicemotion', handleMotion);  
       debugLog('Added devicemotion event listener');  
       
       // Add initial history entry  
       if (stepCount === 0) {  
           addHistoryEntry();  
       }  
       
       showAlert('Step counting started!');  
       debugLog('Step counting successfully started');  
   }  
   
   // Stop counting steps  
   function stopCounting() {  
       debugLog('Stopping step counting...');  
       isCounting = false;  
       startBtn.disabled = false;  
       stopBtn.disabled = true;  
       
       // Remove motion listener  
       window.removeEventListener('devicemotion', handleMotion);  
       debugLog('Removed devicemotion event listener');  
       
       // Add final history entry  
       addHistoryEntry();  
       
       showAlert('Step counting stopped');  
       debugLog('Step counting stopped successfully');  
   }  
   
   // Reset step count  
   function resetCounter() {  
       debugLog('Resetting step count...');  
       stepCount = 0;  
       updateDisplay();  
       activityHistory = [];  
       historyBody.innerHTML = '';  
       
       if (chart) {  
           chart.data.labels = [];  
           chart.data.datasets[0].data = [];  
           chart.update();  
       }  
       
       showAlert('Counter reset');  
       debugLog('Step counter reset successfully');  
   }  
   
   // Mock sensor for testing  
   function startMockSensor() {  
       debugLog('Starting mock sensor for testing...');  
       isCounting = true;  
       startBtn.disabled = true;  
       stopBtn.disabled = false;  
       
       let mockInterval = setInterval(() => {  
           const mockEvent = {  
               accelerationIncludingGravity: {  
                   x: (Math.random() * 4 - 2),  
                   y: (Math.random() * 4 - 2),  
                   z: (Math.random() * 4 - 2)  
               },  
               timeStamp: Date.now()  
           };  
           
           debugLog('Generating mock motion data');  
           handleMotion(mockEvent);  
       }, 800);  
       
       // Stop the mock sensor when stop button is clicked  
       const stopHandler = () => {  
           clearInterval(mockInterval);  
           stopCounting();  
           stopBtn.removeEventListener('click', stopHandler);  
       };  
       stopBtn.addEventListener('click', stopHandler);  
       
       showAlert('Using mock sensor (no real motion data)');  
   }  
   
   // Update the display  
   function updateDisplay() {  
       try {  
           stepsElement.textContent = stepCount;  
           const distance = stepCount * strideLength; // Now in meters  
           distanceElement.textContent = `${distance.toFixed(2)}`;  
           caloriesElement.textContent = Math.round(stepCount * 0.04);  
           debugLog(`Display updated - Steps: ${stepCount}, Distance: ${distance.toFixed(2)}`);  
       } catch (error) {  
           debugLog(`Error updating display: ${error.message}`);  
       }  
   }  
   
   // Add entry to history  
   function addHistoryEntry() {  
       try {  
           const now = new Date();  
           const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});  
           const distance = stepCount * strideLength; // Calculate distance in meters  
           
           activityHistory.push({  
               time: timeString,  
               steps: stepCount,  
               distance: distance.toFixed(2)  
           });  
           
           debugLog(`Added history entry - Time: ${timeString}, Steps: ${stepCount}, Distance: ${distance.toFixed(2)}`);  
           
           // Update history table  
           historyBody.innerHTML = '';  
           activityHistory.slice().reverse().forEach(entry => {  
               const row = document.createElement('tr');  
               row.innerHTML = `  
                   <td>${entry.time}</td>  
                   <td>${entry.steps}</td>  
                   <td>${entry.distance} meters</td>  
               `;  
               historyBody.appendChild(row);  
           });  
       } catch (error) {  
           debugLog(`Error adding history entry: ${error.message}`);  
       }  
   }  
   
   // Load saved data  
   function loadSavedData() {  
       try {  
           const savedData = localStorage.getItem('pedometerData');  
           if (savedData) {  
               const data = JSON.parse(savedData);  
               stepCount = data.stepCount || 0;  
               activityHistory = data.activityHistory || [];  
               
               debugLog(`Loaded saved data - Steps: ${stepCount}, History entries: ${activityHistory.length}`);  
               
               updateDisplay();  
               
               // Update history table  
               historyBody.innerHTML = '';  
               activityHistory.slice().reverse().forEach(entry => {  
                   const row = document.createElement('tr');  
                   row.innerHTML = `  
                       <td>${entry.time}</td>  
                       <td>${entry.steps}</td>  
                       <td>${entry.distance} meters</td>  
                   `;  
                   historyBody.appendChild(row);  
               });  
           } else {  
               debugLog('No saved data found');  
           }  
       } catch (error) {  
           debugLog(`Error loading saved data: ${error.message}`);  
       }  
   }  
   
   // Save data  
   function saveData() {  
       try {  
           const data = {  
               stepCount,  
               activityHistory  
           };  
           localStorage.setItem('pedometerData', JSON.stringify(data));  
           debugLog(`Data saved - Steps: ${stepCount}, History entries: ${activityHistory.length}`);  
       } catch (error) {  
           debugLog(`Error saving data: ${error.message}`);  
       }  
   }  
   
   // Initialize the app  
   function init() {  
       debugLog('Initializing pedometer app...');  
       
       // Check if running as PWA  
       if (window.matchMedia('(display-mode: standalone)').matches) {  
           debugLog('Running as installed PWA');  
           installBtn.style.display = 'none';  
       } else {  
           debugLog('Running in browser');  
       }  
       
       // Initialize components  
       initializeChart();  
       loadSavedData();  
       
       // Set up periodic save  
       setInterval(saveData, 10000);  
       window.addEventListener('beforeunload', saveData);  
       
       // Set up event listeners  
       startBtn.addEventListener('click', startCounting);  
       stopBtn.addEventListener('click', stopCounting);  
       resetBtn.addEventListener('click', resetCounter);  
       
       // Check for PWA installation  
       window.addEventListener('beforeinstallprompt', (e) => {  
           e.preventDefault();  
           installBtn.style.display = 'block';  
           
           installBtn.addEventListener('click', () => {  
               e.prompt();  
               installBtn.style.display = 'none';  
           });  
       });  
       
       debugLog('App initialization complete');  
   }  
   
   // Start the app  
   init();  