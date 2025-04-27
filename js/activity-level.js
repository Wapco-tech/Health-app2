
        // Fade-in effect for the page  
        $(document).ready(function () {  
            $(".login-container").css({   
                top: '50%', // Move to center position  
                opacity: '1' // Fade in   
            });  

            // Fade-in effect for the body  
            $("body").animate({ opacity: 1 }, 3000); // Animate body fade-in effect   
        });  