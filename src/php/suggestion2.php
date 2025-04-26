<?php  

// Check if a language is set in the session, otherwise default to Persian  
if (isset($_SESSION['language'])) {  
    $language = $_SESSION['language'];  
} else {  
    $language = 'fa'; // Default language  
}  
?>  

<!DOCTYPE html>  
<html lang="<?php echo $language; ?>">  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>  
        <?php echo $language === 'en' ? 'Suggestions' : 'پیشنهادات'; ?>  
    </title>  
    <link href="../../src/css/tabler.min.css" rel="stylesheet">  
    <link href="../../src/css/styles.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">   
    <!-- Font Links -->  
    <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Montserrat.ttf"> <!-- Montserrat -->  
    <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Vazir.ttf"> <!-- Vazir, ensure the path is correct -->  

    <style>  
        body {  
            text-align: <?php echo $language === 'fa' ? 'right' : 'center'; ?>;  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>;  
            padding: 20px;  
            position: relative;  
            overflow: hidden;  
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */   
        }  

        #particles-js {  
            position: absolute;  
            width: 100%;  
            height: 100%;  
            background-color: #000;  
            background: linear-gradient(45deg, rgb(14, 107, 189), rgb(118, 204, 213));  
            z-index: 0;  
        }  

        .carousel-container {  
            width: 80%;  
            /* Responsive width */  
            max-width: 900px;  
            /* Maximum width */  
            margin: 50px auto;  
            /* Center the carousel */  
            position: relative;  
            /* Position relative for absolute positioning of controls */  
        }  

        .carousel {  
            background-color: rgba(0, 0, 0, 0.7);  
            /* Black background with 0.7 opacity */  
            z-index: 1;  
            position: relative;  
            border-radius: 10px;  
            /* Rounded corners */  
        }  

        .carousel-inner {  
            padding: 20px;  
        }  

        .carousel-item {  
            color: white;  
            /* Text color */  
            text-align: center;  
        }  

        .carousel-item h3 {  
            font-size: 2rem;  
            margin-bottom: 15px;  
        }  

        .carousel-item p {  
            font-size: 1.2rem;  
        }  

        .carousel-buttons {  
            display: flex;  
            justify-content: center;  
            margin-top: 20px;  
            flex-direction: <?php echo $language === 'fa' ? 'row-reverse' : 'row'; ?>;  
            /* Reverse button order for Persian */  
            flex-wrap: wrap;  
            /* Allow buttons to wrap to the next line on smaller screens */  
        }  

        .homepage-button {  
            font-size: 0.8rem;  
                /* Even smaller font on very small screens */  
                padding: 8px 12px;  
                min-width: 120px;  
                /* Further reduce minimum width */  
        }  

        /* Media query for smaller screens */  
        @media (max-width: 576px) {  
            .homepage-button {  
                font-size: 0.7rem;  
                /* Even smaller font on very small screens */  
                padding: 6px 10px;  
                min-width: 100px;  
                /* Further reduce minimum width */  
            }  
        }  
    </style>  
</head>  

<body class="<?php echo $language; ?>">  
    <div id="particles-js"></div>  
    <div class="container">  
        <div class="carousel-container">  
            <div id="suggestionCarousel" class="carousel slide" data-ride="carousel">  
                <div class="carousel-inner">  
                    <div class="carousel-item active" id="firstSlide">  
                        <h3>  
                            <?php echo $language === 'en' ? 'Suggestions' : 'پیشنهادات'; ?>  
                        </h3>  
                        <p>  
                            <?php  
                            $suggestionText = $language === 'en' ?  
                                'Dear (Family Name), encouragement increases the likelihood of repeating that behavior. You are now within the normal weight range. By engaging in exercise, you will enhance your abilities and move towards the ultimate reward, which is the satisfaction of exercising.' :  
                                '(فامیل طرف) عزیز ، تشویق یک رفتار احتمال تکرار ان رفتار را افزایش می دهد ، شما در محدوده وزنی نرمال قرار گرفته اید ، با انجام تمرینات ورزشی توانایی های خود را افزایش داده و بسمت تشویق نهایی که احساس رضایت از انجام ورزش است حرکت کنید.';  
                            echo $suggestionText;  
                            ?>  
                        </p> 
                        <div class="carousel-buttons">  
                            <button class="homepage-button" onclick="goToHomePage()">  
                                <?php echo $language === 'en' ? 'Proceed to homepage' : 'رفتن به صفحه اصلی'; ?>  
                            </button>  
                        </div>  
                    </div>  
                </div>  
                <!-- Removed previous and next buttons as there is only one slide -->  
            </div>  
        </div>  
    </div>  

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>  

    <script>  
        particlesJS("particles-js", {  
            "particles": {  
                "number": {  
                    "value": 5,  
                    "density": {  
                        "enable": true,  
                        "value_area": 800  
                    }  
                },  
                "color": {  
                    "value": "#ffffff"  
                },  
                "shape": {  
                    "type": "circle",  
                    "stroke": {  
                        "width": 0,  
                        "color": "#000000"  
                    },  
                    "polygon": {  
                        "nb_sides": 6  
                    },  
                    "image": {  
                        "src": "img/github.svg",  
                        "width": 100,  
                        "height": 100  
                    }  
                },  
                "opacity": {  
                    "value": 0.1,  
                    "random": false,  
                    "anim": {  
                        "enable": false,  
                        "speed": 60,  
                        "opacity_min": 0.1,  
                        "sync": false  
                    }  
                },  
                "size": {  
                    "value": 100,  
                    "random": false,  
                    "anim": {  
                        "enable": true,  
                        "speed": 60,  
                        "size_min": 60,  
                        "sync": false  
                    }  
                },  
                "line_linked": {  
                    "enable": false,  
                    "distance": 150,  
                    "color": "#ffffff",  
                    "opacity": 0.4,  
                    "width": 1  
                },  
                "move": {  
                    "enable": true,  
                    "speed": 5,  
                    "direction": "none",  
                    "random": false,  
                    "straight": false,  
                    "out_mode": "out",  
                    "bounce": false,  
                    "attract": {  
                        "enable": false,  
                        "rotateX": 600,  
                        "rotateY": 1200  
                    }  
                }  
            },  
            "interactivity": {  
                "detect_on": "canvas",  
                "events": {  
                    "onhover": {  
                        "enable": false,  
                        "mode": "repulse"  
                    },  
                    "onclick": {  
                        "enable": false,  
                        "mode": "push"  
                    },  
                    "resize": true  
                },  
                "modes": {  
                    "grab": {  
                        "distance": 140,  
                        "line_linked": {  
                            "opacity": 1  
                        }  
                    },  
                    "bubble": {  
                        "distance": 400,  
                        "size": 40,  
                        "duration": 2,  
                        "opacity": 8,  
                        "speed": 3  
                    },  
                    "repulse": {  
                        "distance": 200,  
                        "duration": 0.4  
                    },  
                    "push": {  
                        "particles_nb": 4  
                    },  
                    "remove": {  
                        "particles_nb": 2  
                    }  
                }  
            },  
            "retina_detect": true  
        });  

        if ('serviceWorker' in navigator) {  
            window.addEventListener('load', () => {  
                navigator.serviceWorker.register('/service-worker.js')  
                    .then(registration => {  
                        console.log('Service Worker registered with scope:', registration.scope);  
                    })  
                    .catch(error => {  
                        console.error('Service Worker registration failed:', error);  
                    });  
            });  
        }  

        function goToHomePage() {  
            window.location.href = "home.php";  
        }  
    </script>  
</body>  

</html>