<?php  

// Check if a language is set in the session, otherwise default to Persian  
if (isset($_SESSION['language'])) {  
    $language = $_SESSION['language'];  
} else {  
    $language = 'fa'; // Default language  
}  
?>  

<!DOCTYPE html>  
<html lang="<?php echo isset($_SESSION['language']) ? $_SESSION['language'] : 'fa'; ?>"> <!-- Set language dynamically -->  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Health App'; ?></title> <!-- Use a variable for the title -->  
    <style>  
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');  

        @font-face {  
            font-family: 'Vazir';  
            src: url('src/styles/css/fonts/Vazir.woff') format('woff'), /* Updated path for WOFF font */  
                 url('src/styles/css/fonts/Vazir.ttf') format('truetype'); /* Updated path for TTF font */  
            font-weight: normal;  
            font-style: normal;  
        }  

        body {  
            text-align: <?php echo $language === 'fa' ? 'right' : 'center'; ?>; /* Align text based on language */  
            font-family: <?php echo $language === 'en' ? "'Poppins', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */  
        }  
    </style>  
        <!-- Include jQuery -->  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>  
<body>  
    <link rel="manifest" href="/health-app2/manifest.json">  
    <script>  
        if ('serviceWorker' in navigator) {  
            window.addEventListener('load', () => {  
                navigator.serviceWorker.register('/health-app2/src/sw.js')  
                    .then((registration) => {  
                        console.log('Service Worker registered with scope:', registration.scope);  
                    })  
                    .catch((error) => {  
                        console.error('Service Worker registration failed:', error);  
                    });  
            });  
        }  
    </script>
</body>