        // Function to handle the "Submit" button click  
        function handleActivityLevelSubmit(event) {  
            event.preventDefault(); // Prevent the default form submission  

            var activityLevel = document.querySelector('select[name="activity_level"]').value; // Get the selected activity level  
            var errorMsg = document.getElementById('error-message'); // Get the error message element  

            // Clear previous error message  
            errorMsg.textContent = '';  
            errorMsg.style.display = 'none'; // Hide error message initially  


        }  

        // Fade-in effect for the page  
        $(document).ready(function () {  
            $(".login-container").css({   
                top: '50%', // Move to center position  
                opacity: '1' // Fade in   
            });  

            // Fade-in effect for the body  
            $("body").animate({ opacity: 1 }, 3000); // Animate body fade-in effect   
        });  