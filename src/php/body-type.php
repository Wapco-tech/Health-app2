<?php  

$language = $_SESSION['language'] ?? 'fa';  

$sex = $_POST['sex'] ?? 'male';  

$bodyTypes = [  
    'male' => [  
        'ectomorph' => [  
            'fa' => '( ECTOMORPH) اکتومورف - عضلات بسیار کم نسبت به طول استخوان ( لاغر-کشیده)',  
            'en' => '(ECTOMORPH) Ectomorph - Very little muscle relative to bone length (Slender-Long)',  
        ],  
        'mesomorph' => [  
            'fa' => '( MESOMORPH) مزومورف _ ساختار استخوانی متوسط ، ماهیچه ای ( دارای تناسب اندام )',  
            'en' => '(MESOMORPH) Mesomorph - Medium bone structure, muscular (Well-proportioned)',  
        ],  
        'endomorph' => [  
            'fa' => '( ENDOMORPH ) اندومورف _ گسترش چربی در کل بدن ( چاق -گرد)',  
            'en' => '(ENDOMORPH) Endomorph - Spread of fat throughout the body (Round-Overweight)',  
        ],  
    ],  
    'female' => [  
        'triangle' => [  
            'fa' => '(TRIANGLE) مثلث - پایین تنه بزرگتر از بالا تنه',  
            'en' => '(TRIANGLE) Triangle - Lower body larger than upper body',  
        ],  
        'rectangle' => [  
            'fa' => '(RECTANGLE) مستطیل - بالا تنه و پایین تنه تقریبا یک اندازه',  
            'en' => '(RECTANGLE) Rectangle - Upper and lower body approximately the same size',  
        ],  
        'pear' => [  
            'fa' => '(PEAR) گلابی - پایین تنه بزرگتر از بالا تنه',  
            'en' => '(PEAR) Pear - Lower body larger than upper body',  
        ],  
        'hourglass' => [  
            'fa' => '(HOURGLASS) ساعت شنی - بالا تنه و پایین تنه تقریبا یک اندازه، کمر باریک',  
            'en' => '(HOURGLASS) Hourglass - Upper and lower body approximately the same size, narrow waist',  
        ],  
        'apple' => [  
            'fa' => '(APPLE) سیب - بالا تنه بزرگتر از پایین تنه',  
            'en' => '(APPLE) Apple - Upper body larger than lower body',  
        ],  
    ],  
];  

$selectedBodyType = $_POST['body_type'] ?? (isset($bodyTypes[$sex]) ? key($bodyTypes[$sex]) : null);  

$imagePath = ($sex === 'male') ? 'src/img/1.png' : 'src/img/2.webp'; // Set image path based on gender  
?>  

<!DOCTYPE html>  
<html lang="<?php echo $language; ?>">  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo $language === 'en' ? 'Select Your Body Type - Health App' : 'انتخاب نوع بدن خود - اپلیکیشن سلامت'; ?></title>  
    <link href="src/styles/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->  
    <link href="src/styles/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->   
    <link href="src/styles/css/body-type.css" rel="stylesheet"> <!-- Link to your custom CSS -->   
    <!-- Include jQuery -->  
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>  
    <script src="src/js/body-type.js"></script>

    <style>  
        body {  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>;  
        }

    </style>  
</head>  

<body>  
    <?php include 'D:\Wamp\www\health-app2\src\php\Includes\header.php'; ?> <!-- Include the header here -->  

    <div class="login-container">  
        <form id="bodyTypeForm" action="index.php?page=activity-level" method="POST" autocomplete="off" novalidate>  
            <img src="src/img/logo.png" alt="Health App Logo" class="logo">  
            <h1><?php echo $language === 'en' ? 'Select Your Body Type' : 'نوع بدن خود را انتخاب کنید'; ?></h1>  

            <div class="image-container">  
                <img src="<?php echo $imagePath; ?>" alt="<?php echo $language === 'en' ? 'Body Type Image' : 'تصویر نوع بدن'; ?>">  
            </div>  

            <div>  
                <select name="body_type" id="body_type" class="form-control" required>  
                    <option value=""><?php echo $language === 'en' ? 'Select your body type' : 'نوع بدن خود را انتخاب کنید'; ?></option>  
                    <?php foreach ($bodyTypes[$sex] as $value => $description): ?>  
                        <option value="<?php echo $value; ?>" <?php if ($selectedBodyType === $value) echo 'selected'; ?>>  
                            <?php echo $description[$language]; ?>  
                        </option>  
                    <?php endforeach; ?>  
                </select>  
                <div id="error-message" class="error-message">  
                    <?php echo $language === 'en' ? 'Please select a body type.' : 'لطفاً نوع بدن خود را انتخاب کنید.'; ?>  
                </div>  
            </div>  

            <button type="submit" class="btn-primary"><?php echo $language === 'en' ? 'Submit Data' : 'ارسال اطلاعات'; ?></button>  
        </form>  
    </div>   
    
    <script>  
        // Form submission event handler  
        document.getElementById('bodyTypeForm').addEventListener('submit', function(event) {  
            var bodyTypeSelect = document.getElementById('body_type');  
            var errorMessage = document.getElementById('error-message');  

            if (bodyTypeSelect.value === '') {  
                errorMessage.style.display = 'block'; // Show error message  
                event.preventDefault(); // Prevent form submission  
            } else {  
                errorMessage.style.display = 'none'; // Hide error message  
            }  
        });  
    </script>  
</body>  
</html>