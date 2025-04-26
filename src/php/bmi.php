<?php  
if (session_status() == PHP_SESSION_NONE) {  
    session_start();  
}  

// Check if a language is set in the session, otherwise default to Persian  
if (isset($_SESSION['language'])) {  
    $language = $_SESSION['language'];  
} else {  
    $language = 'fa'; // Default language  
}  

// Check if the variables were set in the session; otherwise, default to 0  
$weight = isset($_SESSION['weight']) ? $_SESSION['weight'] : 0;  
$height = isset($_SESSION['height']) ? $_SESSION['height'] : 0;  
$sex = isset($_SESSION['sex']) ? $_SESSION['sex'] : 'male'; // Get sex from session  
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'fa';  
$bmi = 0;  
$bmiCategory = '';  
$explanation = '';  

function convertPersianNumbersToEnglish($input) {  
    $persianToEnglish = [  
        '۰' => '0',  
        '۱' => '1',  
        '۲' => '2',  
        '۳' => '3',  
        '۴' => '4',  
        '۵' => '5',  
        '۶' => '6',  
        '۷' => '7',  
        '۸' => '8',  
        '۹' => '9'  
    ];  
    return str_replace(array_keys($persianToEnglish), array_values($persianToEnglish), $input);  
}  

$classify = function($bmi, $lang) {  
    if ($lang === 'fa') {  
        if ($bmi < 16) return 'لاغری شدید';  
        if ($bmi >= 16.1 && $bmi < 17) return 'لاغری متوسط';  
        if ($bmi >= 17.1 && $bmi < 18.5) return 'کمبود وزن';  
        if ($bmi >= 18.6 && $bmi < 25) return 'وزن سلامت (نرمال)';  
        if ($bmi >= 25.1 && $bmi < 30) return 'اضافه وزن';  
        if ($bmi >= 30.1 && $bmi < 35) return 'چاقی';  
        return 'چاقی شدید';  
    } else {  
        if ($bmi < 16) return 'Severe Thinness';  
        if ($bmi >= 16.1 && $bmi < 17) return 'Moderate Thinness';  
        if ($bmi >= 17.1 && $bmi < 18.5) return 'Underweight';  
        if ($bmi >= 18.6 && $bmi < 25) return 'Normal Weight';  
        if ($bmi >= 25.1 && $bmi < 30) return 'Overweight';  
        if ($bmi >= 30.1 && $bmi < 35) return 'Obesity';  
        return 'Severe Obesity';  
    }  
};  

function getExplanation($bmi, $sex, $lang) {  
    if ($lang === 'fa') {  
        if ($sex === 'male') {  
            if ($bmi < 17) {  
                return '<h4 class="lifestyle-warning-title"> هشدار سبک زندگی</h4> <p>کمبود وزن و BMI پایین خطرات خاص خود را دارد که شامل کمبود ویتامین، کم خونی، افسردگی، خشکی پوست، بیماری‌های قلبی-عروقی، ریزش مو، سیستم ایمنی ضعیف، پوکی استخوان، سوء تغذیه.</p>';  
            }  
        } elseif ($sex === 'female') {  
            if ($bmi < 17) {  
                return '<h4 class="lifestyle-warning-title"> هشدار سبک زندگی</h4> <p>کمبود وزن و BMI پایین خطرات خاص خود را دارد که شامل بیماری‌های قلبی-عروقی، افسردگی، ریزش مو، مشکل در باردار شدن، اختلالات قاعدگی، سیستم ایمنی ضعیف، پوکی استخوان، سوء تغذیه.</p>';  
            }  
        }  
        if ($bmi >= 25 && $bmi < 30) {  
            return '<h4 class="lifestyle-warning-title"> هشدار سبک زندگی</h4> <p>اضافه وزن تاثیرات منفی زیادی بر روی سلامتی دارد که شامل افزایش فشار خون، افزایش ریسک ابتلا به دیابت نوع دو، کاهش سطح کلسترول خوب خون و افزایش سطح کلسترول بد خون، افزایش کارایی قلب، و بالا رفتن خطر بیماری‌های قلبی.</p>';  
        }  
        if ($bmi >= 30) {  
            return '<h4 class="lifestyle-warning-title"> هشدار سبک زندگی</h4> <p>چاقی خطرات جدی برای سلامتی دارد که شامل افزایش فشار خون، ریسک بالای دیابت نوع دو، کاهش سطح کلسترول خوب خون و بالا رفتن سطح کلسترول بد خون، افزایش احتمال سکته‌ها، آرتروز و مشکلات تنفسی مانند آپنه خواب.</p>';  
        }  
    } else {  
        if ($sex === 'male') {  
            if ($bmi < 17) {  
                return '<h4 class="lifestyle-warning-title"> Lifestyle Warning</h4> <p>Being underweight and having a low BMI has specific risks, including vitamin deficiency, anemia, depression, dry skin, cardiovascular diseases, hair loss, weak immune system, osteoporosis, malnutrition.</p>';  
            }  
        } elseif ($sex === 'female') {  
            if ($bmi < 17) {  
                return '<h4 class="lifestyle-warning-title"> Lifestyle Warning</h4> <p>Being underweight and having a low BMI has specific risks, including cardiovascular diseases, depression, hair loss, difficulty getting pregnant, menstrual disorders, weak immune system, osteoporosis, malnutrition.</p>';  
            }  
        }  
        if ($bmi >= 25 && $bmi < 30) {  
            return '<h4 class="lifestyle-warning-title"> Lifestyle Warning</h4> <p>Being overweight has many negative health impacts, including increased blood pressure, increased risk of type 2 diabetes, reduced HDL cholesterol levels, increased LDL cholesterol levels, increased workload on the heart, increased risk of cardiovascular diseases.</p>';  
        }  
        if ($bmi >= 30) {  
            return '<h4 class="lifestyle-warning-title"> Lifestyle Warning</h4> <p>Obesity has many negative health impacts including increased blood pressure, increased risk of type 2 diabetes, reduced HDL cholesterol levels, increased LDL cholesterol levels, increased risk of various heart and brain attacks, sleep apnea and respiratory problems, increased risk of gallbladder disease, increased cancer risk.</p>';  
        }  
    }  

    return '';  
}  

if ($height > 0 && $weight > 0) {  
    $heightInMeters = $height / 100;  
    $bmi = $weight / ($heightInMeters * $heightInMeters);  
    $bmiCategory = $classify($bmi, $language);  

    // Check if BMI is between 17 and 25  
    if ($bmi < 17 || $bmi > 25) {  
        $explanation = getExplanation($bmi, $sex, $language);  
    }  
    
    $_SESSION['bmi'] = $bmi;  
}  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $_SESSION['weight'] = convertPersianNumbersToEnglish($_POST['weight']);  
    $_SESSION['height'] = convertPersianNumbersToEnglish($_POST['height']);  
    $_SESSION['sex'] = $_POST['sex'];  
    header('Location: index.php?page=bmi');  
    exit;  
}  
?>  

<!DOCTYPE html>  
<html lang="<?php echo $language; ?>">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo $language === 'en' ? 'BMI Result' : 'BMI نتیجه'; ?></title>  
    <link href="src/styles/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->  
    <link href="src/styles/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->   
    <link href="src/styles/css/bmi.css" rel="stylesheet"> <!-- Link to your custom CSS -->   
    <!-- // -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script src="src/js/bmi.js"></script> 

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
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>;
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */     
        }  
    </style> 
</head>  

<body>  
    <div id="particles-js"></div> <!-- Particles.js container -->  
    <div class="content">  
        <h1><?php echo $language === 'en' ? 'BMI Result' : 'نتیجه BMI'; ?></h1>  
        <div class="result-container">  
            <?php if ($bmi > 0): ?>  
                <div class="bmi-bubble <?php echo empty($explanation) ? 'bmi-bubble-no-explanation' : ''; ?>">  
                    <?php echo $language === 'en' ? 'Your BMI: ' . number_format($bmi, 2) : 'BMI شما: ' . number_format($bmi, 2); ?>  
                    <div class="bmi-status">  
                        <h2><?php echo $language === 'en' ? 'Status: ' . $bmiCategory : 'وضعیت: ' . $bmiCategory; ?></h2>  
                    </div>  
                </div>  

                <!-- Explanation box placement based on language -->  
                <?php if ($explanation): ?>  
                    <div class="explanation-bubble" style="order: <?php echo ($language === 'fa') ? '1' : '0'; ?>"><?php echo $explanation; ?></div>  
                <?php endif; ?>  
            <?php else: ?>  
                <h2><?php echo $language === 'en' ? 'Please enter your weight and height.' : 'لطفاً اطلاعات وزن و قد خود را وارد کنید.'; ?></h2>  
            <?php endif; ?>  
        </div>  
    </div>   

    <div class="btn-container">  
        <button onclick="window.location.href='index.php?page=body-type';" class="btn"><?php echo $language === 'en' ? 'Proceed' : 'ادامه'; ?></button>  
    </div>  
</body>