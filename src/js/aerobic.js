
document.addEventListener('DOMContentLoaded', function() {  
    // Initialize particles.js  
    particlesJS("particles-js", {  
        particles: {  
            number: {  
                value: 5,  
                density: {  
                    enable: true,  
                    value_area: 800  
                }  
            },  
            color: {  
                value: "#ffffff"  
            },  
            shape: {  
                type: "circle",  
                stroke: {  
                    width: 0,  
                    color: "#000000"  
                },  
                polygon: {  
                    nb_sides: 6  
                },  
                image: {  
                    src: "img/github.svg",  
                    width: 100,  
                    height: 100  
                }  
            },  
            opacity: {  
                value: 0.1,  
                random: false,  
                anim: {  
                    enable: false,  
                    speed: 60,  
                    opacity_min: 0.1,  
                    sync: false  
                }  
            },  
            size: {  
                value: 100,  
                random: false,  
                anim: {  
                    enable: true,  
                    speed: 60,  
                    size_min: 60,  
                    sync: false  
                }  
            },  
            line_linked: {  
                enable: false,  
                distance: 150,  
                color: "#ffffff",  
                opacity: 0.4,  
                width: 1  
            },  
            move: {  
                enable: true,  
                speed: 5,  
                direction: "none",  
                random: false,  
                straight: false,  
                out_mode: "out",  
                bounce: false,  
                attract: {  
                    enable: false,  
                    rotateX: 600,  
                    rotateY: 1200  
                }  
            }  
        },  
        interactivity: {  
            detect_on: "canvas",  
            events: {  
                onhover: {  
                    enable: false,  
                    mode: "repulse"  
                },  
                onclick: {  
                    enable: false,  
                    mode: "push"  
                },  
                resize: true  
            },  
            modes: {  
                grab: {  
                    distance: 140,  
                    line_linked: {  
                        opacity: 1  
                    }  
                },  
                bubble: {  
                    distance: 400,  
                    size: 40,  
                    duration: 2,  
                    opacity: 8,  
                    speed: 3  
                },  
                repulse: {  
                    distance: 200,  
                    duration: 0.4  
                },  
                push: {  
                    particles_nb: 4  
                },  
                remove: {  
                    particles_nb: 2  
                }  
            }  
        },  
        retina_detect: true  
    });  
    
});       

    let activityType;  
    let caloriesBurned = 0;  
    let timerInterval; // Declare timerInterval in the global scope  
    let elapsedTime = 0;  
    let isPaused = false;  

    // Store original box styles and class  
    let originalBoxStyles = {};  
    let originalTransform = '';  
    let originalClassName = '';  

    const weight = parseFloat("<?php echo $weight; ?>");  
    const height = parseFloat("<?php echo $height; ?>");  
    const sex = "<?php echo $sex; ?>";  

    const caloriesPerMinute = {  
        walking: { male: 4.2, female: 3.5 },  
        running: { male: 12, female: 10 },  
        bike: { male: 7, female: 6 },  
        mountain: { male: 6, female: 5 },  
    };  

    const languageData = {  
        en: {  
            activityLabel: "Activity",  
            caloriesBurnedLabel: "Calories Burned",  
            pauseButtonLabel: "Pause",  
            resumeButtonLabel: "Resume",  
            finishButtonLabel: "Finish",  
            walkingActivityLabel: "Walking",  
            runningActivityLabel: "Running",  
            bikeActivityLabel: "Bike",  
            mountainActivityLabel: "Mountain"  
        },  
        fa: {  
            activityLabel: "فعالیت",  
            caloriesBurnedLabel: "کالری سوزانده شده",  
            pauseButtonLabel: "توقف",  
            resumeButtonLabel: "ادامه",  
            finishButtonLabel: "پایان",  
            walkingActivityLabel: "پیاده روی",  
            runningActivityLabel: "دویدن",  
            bikeActivityLabel: "دوچرخه سواری",  
            mountainActivityLabel: "کوهنوردی"  
        }  
    };  

    const currentLanguage = "<?php echo $language; ?>";  
    const lang = languageData[currentLanguage] || languageData.fa;  

    function getActivityLabel(activityType) {  
        switch (activityType) {  
            case "walking":  
                return lang.walkingActivityLabel;  
            case "running":  
                return lang.runningActivityLabel;  
            case "bike":  
                return lang.bikeActivityLabel;  
            case "mountain":  
                return lang.mountainActivityLabel;  
            default:  
                return activityType;  
        }  
    }  

    function startActivity(activity) {  
        const box = event.currentTarget;  
        activityType = activity; 
        
        // Check if the box is already "active" (at the top)  
        if (box.classList.contains('untouchable')) {  
             finishActivity();  
            return; // Exit the function early  
        }  

        // Store original styles and class name BEFORE modifying  
        originalBoxStyles = {  
            width: box.style.width,  
            height: box.style.height,  
            transition: box.style.transition,  
            pointerEvents: box.style.pointerEvents,  
            userSelect: box.style.userSelect  
        };  
        originalTransform = box.style.transform;  
        originalClassName = box.className; // Store the original class name  

        const boxRect = box.getBoundingClientRect();  

        const centerX = (window.innerWidth - boxRect.width) / 2;  
        const topY = 20;  

        box.style.transition = 'transform 1s';  
        box.style.transform = `translate(${centerX - boxRect.left}px, ${topY - boxRect.top + window.scrollY}px)`;  

        box.classList.add('untouchable');  

        const boxText = box.querySelector('span');  
        boxText.style.display = 'none';  

        const boxIcon = box.querySelector('img');  
        boxIcon.style.width = '120px';  
        boxIcon.style.height = '120px';  

        const sidebar = document.getElementById('sidebar');  
        sidebar.style.transition = 'opacity 1s';  
        sidebar.style.opacity = '0';  

        const toggleButton = document.getElementById('toggle-btn');  
        toggleButton.style.transition = 'opacity 1s';  
        toggleButton.style.opacity = '0';  

        const boxes = document.querySelectorAll('.box');  
        boxes.forEach(b => {  
            if (b !== box) {  
                b.style.transition = 'opacity 1s';  
                b.style.opacity = '0';  
            }  
        });  

        setTimeout(() => {  
            createActivityContainer();  
        }, 1000);  

        timerInterval = setInterval(function() { // Assign the interval ID to the global timerInterval  
           // ... your timer logic ...  
        },   1000); 
    }  

    function createActivityContainer() {  
        let activityContainer = document.getElementById('activityContainer');  
        if (!activityContainer) {  
            activityContainer = document.createElement('div');  
            activityContainer.id = 'activityContainer';  
            activityContainer.style.opacity = '0';  
            activityContainer.style.width = '350px'; /* Increased width */  
            activityContainer.style.padding = '20px'; /* Added padding */  
            activityContainer.style.boxSizing = 'border-box'; /* Include padding in width */  
            activityContainer.style.backgroundColor = 'white'; /* Optional: Add a background color for better visibility */  
            activityContainer.style.borderRadius = '5px'; /* Optional: Add rounded corners */  

            const title = document.createElement('h2');  
            title.textContent = `${lang.activityLabel}: ${getActivityLabel(activityType)}`;  
            title.style.marginBottom = '15px'; /* Added margin below the title */  
            title.style.textAlign = 'center'; // Center the title  

            // Time input label and box  
            const timeInputLabel = document.createElement('label');  
            timeInputLabel.textContent = currentLanguage === 'en' ? 'Minutes:' : 'دقیقه:';  
            timeInputLabel.style.display = 'block';  
            timeInputLabel.style.marginBottom = '5px';  
            timeInputLabel.style.textAlign = 'center'; // Center the label  

            // Create input group for buttons and input  
            const timeInputContainer = document.createElement('div');  
            timeInputContainer.className = 'input-group';  
            timeInputContainer.style.marginBottom = '15px';  
            timeInputContainer.style.display = 'flex'; /* Use flexbox to align items */  
            timeInputContainer.style.alignItems = 'center'; /* Vertically align items */  

            // Create decrement button  
            const decrementButton = document.createElement('button');  
            decrementButton.className = 'btn btn-outline-primary';  
            decrementButton.textContent = '-';  
            decrementButton.style.padding = '0.5rem 0.75rem'; /* Adjust button padding */  
            decrementButton.onclick = () => {  
                let currentValue = parseInt(document.getElementById('timeInput').value);  
                document.getElementById('timeInput').value = currentValue > 0 ? currentValue - 1 : 0;  
                calculateCaloriesFromInput();  
            };  

            // Create the time input  
            const timeInput = document.createElement('input');  
            timeInput.type = 'number';  
            timeInput.id = 'timeInput';  
            timeInput.min = '0';  
            timeInput.value = '0'; // Initialize the value  
            timeInput.placeholder = currentLanguage === 'en' ? 'Enter minutes' : 'ورود دقیقه';  
            timeInput.className = 'form-control';  
            timeInput.style.textAlign = 'center';  
            timeInput.style.borderBottom = 'none'; /* Remove the bottom border */  
            timeInput.addEventListener('input', calculateCaloriesFromInput);  

            // Create increment button  
            const incrementButton = document.createElement('button');  
            incrementButton.className = 'btn btn-outline-primary';  
            incrementButton.textContent = '+';  
            incrementButton.style.padding = '0.5rem 0.75rem'; /* Adjust button padding */  
            incrementButton.onclick = () => {  
                let currentValue = parseInt(document.getElementById('timeInput').value);  
                document.getElementById('timeInput').value = currentValue + 1;  
                calculateCaloriesFromInput();  
            };  

            // Append elements to the input group  
            timeInputContainer.appendChild(decrementButton);  
            timeInputContainer.appendChild(timeInput);  
            timeInputContainer.appendChild(incrementButton);  

            // Calories Display (Label above, Value below)  
            const caloriesDisplayContainer = document.createElement('div');  
            caloriesDisplayContainer.id = 'caloriesBurnedContainer';  
            caloriesDisplayContainer.style.textAlign = 'center';  

            const caloriesLabel = document.createElement('div');  
            caloriesLabel.textContent = `${lang.caloriesBurnedLabel}:`;  
            caloriesLabel.style.fontSize = '1.5em';  
            caloriesLabel.style.fontWeight = 'bold'; 

            const caloriesValue = document.createElement('div');  
            caloriesValue.id = 'caloriesBurned';  
            caloriesValue.style.fontSize = '1.5em';  
            caloriesValue.style.fontWeight = 'bold'; 
            caloriesValue.style.marginTop = '10px';
            const kcalText = currentLanguage === 'fa' ? 'کیلوکال' : 'kcal';  
            caloriesValue.textContent = `0 ${kcalText}`;  

            caloriesDisplayContainer.appendChild(caloriesLabel);  
            caloriesDisplayContainer.appendChild(caloriesValue);  

            activityContainer.appendChild(title);  
            activityContainer.appendChild(timeInputLabel);  
            activityContainer.appendChild(timeInputContainer); // Append the input group  
            activityContainer.appendChild(caloriesDisplayContainer); // Append the container  

            const activityButtons = document.createElement('div');  
            activityButtons.className = 'activity-buttons';  
            activityButtons.style.textAlign = 'center'; /* Center the buttons */  

            const saveButton = document.createElement('button');  
            saveButton.id = 'saveButton';  
            saveButton.textContent = currentLanguage === 'en' ? 'Save' : 'ذخیره';  
            saveButton.className = 'btn btn-primary me-2'; /* Add some right margin */  
            saveButton.style.width = '100px'; /* Set equal width */  
            saveButton.onclick = saveActivity;  

            const startButton = document.createElement('button');  
            startButton.textContent = currentLanguage === 'en' ? 'Start' : 'شروع';  
            startButton.className = 'btn btn-success';  
            startButton.style.width = '100px'; /* Set equal width */  
            startButton.onclick = startTimer;  

            activityButtons.appendChild(saveButton);  
            activityButtons.appendChild(startButton);  
            activityContainer.appendChild(activityButtons);  

            document.body.appendChild(activityContainer);  

            setTimeout(() => {  
                activityContainer.style.transition = 'opacity 3s';  
                activityContainer.style.opacity = '1';  
            }, 50);  
        } else {  
            activityContainer.querySelector('h2').textContent = `${lang.activityLabel}: ${getActivityLabel(activityType)}`;  
        }  
    }

    function calculateCaloriesFromInput() {  
        const timeInput = document.getElementById('timeInput');  
        const minutes = parseFloat(timeInput.value); // Get minutes from input  
        const seconds = minutes * 60;  
        clearInterval(timerInterval);

        if (activityType && caloriesPerMinute[activityType]) {  
            const caloriesPerMinuteForActivity = caloriesPerMinute[activityType][sex];  

            if (typeof weight === 'number' && !isNaN(weight)) {  
                let bmr;  
                if (sex === 'male') {  
                    bmr = (10 * weight) + (6.25 * height) - (5 * 30) + 5;  
                } else {  
                    bmr = (10 * weight) + (6.25 * height) - (5 * 30) - 161;  
                }  

                caloriesBurned = ((bmr / 24) * caloriesPerMinuteForActivity * seconds) / 3600;  
            } else {  
                caloriesBurned = (caloriesPerMinuteForActivity / 60) * seconds;  
            }  
            const kcalText = currentLanguage === 'fa' ? 'کیلوکال' : 'kcal';  
            document.getElementById('caloriesBurned').textContent = `${caloriesBurned.toFixed(2)} ${kcalText}`;  
        }  
    }  

    function toggleSidebar() {  
        const sidebar = document.getElementById('sidebar');  
        sidebar.classList.toggle('active');  

        if (sidebar.classList.contains('active')) {  
            sidebar.style.transform = "translateX(0)";  
        } else {  
            sidebar.style.transform = "translateX(100%)";  
        }  
    }  

    window.addEventListener('load', function () {  
        const sidebar = document.getElementById('sidebar');  
        sidebar.style.transform = "translateX(100%)";  
    });  

    function finishActivity() {  
        clearInterval(timerInterval);  
        elapsedTime = 0;  
        isPaused = false;  
        const kcalText = currentLanguage === 'fa' ? 'کیلوکال' : 'kcal';  

        caloriesBurned = 0;  

        document.getElementById('caloriesBurned').textContent = `${lang.caloriesBurnedLabel}: 0 ${kcalText}`;  

        const activityContainer = document.getElementById('activityContainer');  
        if (activityContainer) {  
            activityContainer.style.transition = 'opacity 1s';  
            activityContainer.style.opacity = '0';  
            setTimeout(() => {  
                activityContainer.remove();  
            }, 1000);  
        }  

        const sidebar = document.getElementById('sidebar');  
        sidebar.style.transition = 'transform 1s';  
        sidebar.style.opacity = '1';  

        const toggleButton = document.getElementById('toggle-btn');  
        toggleButton.style.transition = 'opacity 1s';  
        toggleButton.style.opacity = '1';  

        const movedBox = document.querySelector('.box.untouchable');  
        if (movedBox) {  
            // Apply transitions *before* modifying styles  
            movedBox.style.transition = 'transform 1s, width 1s, height 1s';  
            movedBox.style.transform = 'translate(0, 0)';  

            // Remove the 'untouchable' class  
            movedBox.classList.remove('untouchable');  

            movedBox.style.pointerEvents = 'auto';  
            movedBox.style.userSelect = 'auto';  

            const boxIcon = movedBox.querySelector('img');  
            boxIcon.style.width = '';  
            boxIcon.style.height = '';  

            const boxText = movedBox.querySelector('span');  
            boxText.style.display = '';  

            // Reset CSS variables to trigger animation  
            movedBox.style.setProperty('--rotate', '0deg');  
            setTimeout(() => {  
                movedBox.style.setProperty('--rotate', '360deg');  
            }, 50); // Small delay to trigger the animation  
        }  

        const boxes = document.querySelectorAll('.box');  
        boxes.forEach(box => {  
            if (box !== movedBox) {  
                box.style.pointerEvents = 'auto';  
                box.style.userSelect = 'auto';  
                box.classList.remove('untouchable');  
                box.style.transition = 'opacity 1s';  
                box.style.opacity = '1';  
            }  
        });  

        // Restore sidebar transition  
        setTimeout(() => {  
            sidebar.style.transition = 'transform 0.3s';  
        }, 1000);  
    }  

    function incrementTime() {  
        const input = document.getElementById('timeInput');  
        input.value = parseInt(input.value) + 1;  
        calculateCaloriesFromInput();  
    }  

    function decrementTime() {  
        const input = document.getElementById('timeInput');  
        const currentValue = parseInt(input.value);  
        if (currentValue > 0) {  
            input.value = currentValue - 1;  
            calculateCaloriesFromInput();  
        }  
    }  

    function saveActivity() {  
        const activity = activityType;  
        const minutes = document.getElementById('timeInput').value;  
        const calories = caloriesBurned;  

        // Condition to check if timeInput has a value greater than zero  
        if (minutes > 0) {  
            // Create the message element  
            const message = document.createElement('div');  
            message.textContent = currentLanguage === 'en' ? "Data is saved" : "اطلاعات ذخیره شد";  
            message.style.position = 'fixed';  
            message.style.bottom = '50px'; // Position above bottom menu  
            message.style.left = '50%';  
            message.style.transform = 'translateX(-50%)';  
            message.style.backgroundColor = 'rgba(0, 128, 0, 0.8)'; // Semi-transparent green  
            message.style.color = 'white';  
            message.style.padding = '10px 20px';  
            message.style.borderRadius = '5px';  
            message.style.zIndex = '1000'; // Ensure it's on top  
            message.style.opacity = '0'; // Start hidden  
            message.style.transition = 'opacity 0.5s'; // Fade-in effect  

            // Add the message to the body  
            document.body.appendChild(message);  

            // Trigger the fade-in effect  
            setTimeout(() => {  
                message.style.opacity = '1';  
            }, 50);  

            // Fade out and remove the message after a delay  
            setTimeout(() => {  
                message.style.opacity = '0';  
                setTimeout(() => {  
                    document.body.removeChild(message);  
                }, 500); // Wait for fade-out to complete  
            }, 3000);  
        }  

        // *****  IMPORTANT:  *****  
        // You need to replace the following comment with the actual code  
        // to save the `activity`, `minutes`, and `calories` data  
        // to your desired storage (e.g., database via AJAX, local storage, etc.).  
        // Example using localStorage (This is just an example, adapt to your needs):  
        // localStorage.setItem('lastActivity', JSON.stringify({ activity: activity, minutes: minutes, calories: calories }));  
        // ****************************  
        console.log("Saving activity data:", {  
            activity: activity,  
            minutes: minutes, 
            calories: calories  
        });  

        //  For example, if you want to send the data to a PHP script using AJAX, you would do something like this:  
        /*  
        fetch('save_activity.php', {  
            method: 'POST',  
            headers: {  
                'Content-Type': 'application/json'  
            },  
            body: JSON.stringify({ activity: activity, minutes: minutes, calories: calories })  
        })  
        .then(response => response.json())  
        .then(data => {  
            console.log('Success:', data);  
            // Handle success message or redirect  
        })  
        .catch(error => {  
            console.error('Error:', error);  
            // Handle error message  
        });  
        */  
    }  

    function startTimer() {  
    const activityContainer = document.getElementById('activityContainer');  
    const lang = languageData[currentLanguage] || languageData.fa;  
    let elapsedTime = 0;  
    let isPaused = false;  

    // 1. Fade out existing elements  
    const elementsToFade = Array.from(activityContainer.children);  
    elementsToFade.forEach(element => {  
        element.style.transition = 'opacity 0.5s';  
        element.style.opacity = '0';  
    });  

    setTimeout(() => {  
        // Remove the original elements after they've faded  
        elementsToFade.forEach(element => element.remove());  

        // 2. Create and display timer  
        const timerDisplay = document.createElement('div');  
        timerDisplay.id = 'timer';  
        timerDisplay.textContent = '00:00';  
        timerDisplay.style.fontSize = '3em';  
        timerDisplay.style.fontWeight = 'bold';  
        timerDisplay.style.textAlign = 'center';  
        timerDisplay.style.marginBottom = '15px';  

        activityContainer.appendChild(timerDisplay);  

        // 3. Create and display calorie counter  
        const caloriesDisplayContainer = document.createElement('div'); // Create a container  
        caloriesDisplayContainer.id = 'caloriesBurnedContainer';  
        caloriesDisplayContainer.style.textAlign = 'center'; // Center the content  

        const caloriesLabel = document.createElement('div');  
        caloriesLabel.textContent = `${lang.caloriesBurnedLabel}:`; // Just the label  
        caloriesLabel.style.fontSize = '2em'; // Larger font for the value  
        caloriesLabel.style.fontWeight = 'bold';  
        caloriesLabel.style.marginTop = '10px';  

        const caloriesValue = document.createElement('div');  
        caloriesValue.id = 'caloriesBurned';  
        caloriesValue.style.fontSize = '2em'; // Larger font for the value  
        caloriesValue.style.fontWeight = 'bold';  
        caloriesValue.style.marginTop = '20px';  
        const kcalText = currentLanguage === 'fa' ? 'کیلوکال' : 'kcal';  
        caloriesValue.textContent = `0 ${kcalText}`; // Initial value  

        caloriesDisplayContainer.appendChild(caloriesLabel);   // Label above  
        caloriesDisplayContainer.appendChild(caloriesValue);   // Value below  

        activityContainer.appendChild(caloriesDisplayContainer);  

        // 4. Replace buttons  
        const activityButtons = document.createElement('div');  
        activityButtons.className = 'activity-buttons';  
        activityButtons.style.textAlign = 'center';  

        const pauseButton = document.createElement('button');  
        pauseButton.id = 'pauseButton';  
        pauseButton.textContent = lang.pauseButtonLabel;  
        pauseButton.className = 'btn btn-warning me-2';  
        pauseButton.style.width = '100px';  
        pauseButton.onclick = pauseTimer;  

        const finishButton = document.createElement('button');  
        finishButton.id = 'finishButton';  
        finishButton.textContent = lang.finishButtonLabel;  
        finishButton.className = 'btn btn-danger';  
        finishButton.style.width = '100px';  
        finishButton.onclick = finishActivity;  

        activityButtons.appendChild(pauseButton);  
        activityButtons.appendChild(finishButton);  
        activityContainer.appendChild(activityButtons);  

        // 5. Start the timer and calorie updates  
        let startTime = Date.now() - elapsedTime;  
        timerInterval = setInterval(function () { // REMOVED LET  
            elapsedTime = Date.now() - startTime;  
            const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));  
            const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);  

            const formattedMinutes = String(minutes).padStart(2, '0');  
            const formattedSeconds = String(seconds).padStart(2, '0');  

            document.getElementById('timer').textContent = `${formattedMinutes}:${formattedSeconds}`;  

            //Update calories burned based on elapsed time  
            calculateCaloriesFromTimer(elapsedTime); // Use the timer value  
        }, 1000);  

        //Fade in the new elements  
        setTimeout(() => {  
            Array.from(activityContainer.children).forEach(element => {  
                element.style.transition = 'opacity 0.5s';  
                element.style.opacity = '1';  
            });  
        }, 50);  

    }, 500); // Wait for fade out  
}  

function pauseTimer() {  
    if (!isPaused) {  
        clearInterval(timerInterval);  
        pauseButton.textContent = lang.resumeButtonLabel;  
        isPaused = true;  
    } else {  
        startTime = Date.now() - elapsedTime;  
        timerInterval = setInterval(function () {  
            elapsedTime = Date.now() - startTime;  
            const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));  
            const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);  

            const formattedMinutes = String(minutes).padStart(2, '0');  
            const formattedSeconds = String(seconds).padStart(2, '0');  

            document.getElementById('timer').textContent = `${formattedMinutes}:${formattedSeconds}`;  

            //Update calories burned based on elapsed time  
            calculateCaloriesFromTimer(elapsedTime);  
        }, 1000);  
        pauseButton.textContent = lang.pauseButtonLabel;  
        isPaused = false;  
    }  
}  

function calculateCaloriesFromTimer(elapsedTime) {  
    const seconds = elapsedTime / 1000;  // Convert elapsed time to seconds  

    console.log("Seconds:", seconds);  
    console.log("Activity Type:", activityType);  
    console.log("Weight:", weight);  
    console.log("Height:", height);  
    console.log("Sex:", sex);  

    if (activityType && caloriesPerMinute[activityType]) {  
        const caloriesPerMinuteForActivity = caloriesPerMinute[activityType][sex];  

        if (typeof weight === 'number' && !isNaN(weight)) {  
            let bmr;  
            if (sex === 'male') {  
                bmr = (10 * weight) + (6.25 * height) - (5 * 30) + 5;  
            } else {  
                bmr = (10 * weight) + (6.25 * height) - (5 * 30) - 161;  
            }  
            console.log("BMR:", bmr);  

            caloriesBurned = ((bmr / 24) * caloriesPerMinuteForActivity * seconds) / 3600;  
        } else {  
            caloriesBurned = (caloriesPerMinuteForActivity / 60) * seconds;  
        }  
        console.log("Calories Burned:", caloriesBurned);  

        const kcalText = currentLanguage === 'fa' ? 'کیلوکال' : 'kcal';  
        document.getElementById('caloriesBurned').textContent = `${caloriesBurned.toFixed(2)} ${kcalText}`; //Update just the value  
    }  
}