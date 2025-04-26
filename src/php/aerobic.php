<?php  
// Check if the variables were set in the session; otherwise, default to 0  
$weight = isset($_SESSION['weight']) ? $_SESSION['weight'] : 0;  
$height = isset($_SESSION['height']) ? $_SESSION['height'] : 0;  
$sex = isset($_SESSION['sex']) ? $_SESSION['sex'] : 'male'; 
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'fa';  

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
?>  

<!DOCTYPE html>  
<html lang="<?php echo $language; ?>"> 

<head>  
<meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo $language === 'en' ? 'Aerobic' : 'هوازی'; ?></title>  
    <link href="src/styles/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->  
    <link href="src/styles/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->  
    <link href="src/styles/css/aerobic.css" rel="stylesheet"> <!-- Link to your custom CSS --> 
    <!-- Include jQuery -->  
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script src="src/js/aerobic.js"></script>

    <!-- Include Persian Datepicker -->  
    <script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>  

    <style>  
        .box: span {  
            display: block;  
            /* Show text on hover */  
        }  
    </style>  
</head>  

<body>  

    <?php include 'D:\Wamp\www\health-app2\src\php\Includes\header.php'; ?> <!-- Include the header here --> 
    <!-- particles.js container -->  
    <div id="particles-js"></div>  

    <!-- Toggle Sidebar Button -->  
    <button class="toggle-sidebar" id="toggle-btn" onclick="toggleSidebar()">☰</button>  

    <!-- Sidebar -->  
    <div class="sidebar" id="sidebar">  
        <h2>  
            <?php echo $language === 'en' ? 'Menu' : 'منو'; ?>  
        </h2>  
        <ul class="nav">  
            <li class="nav-item">  
                <a href="profile.php" class="nav-link">  
                    <img src="<?php echo 'src/styles/css/icons/icons/outline/user.svg'; ?>" alt="Profile Icon" width="24"  
                        height="24" class="icon-white">  
                    <?php echo $language === 'en' ? 'Profile' : 'پروفایل'; ?>  
                </a>  
            </li>  
            <li class="nav-item">  
                <a href="personal_data.php" class="nav-link">  
                    <img src="<?php echo 'src/styles/css/icons/icons/outline/id.svg'; ?>" alt="Personal Data Icon"  
                        width="24" height="24" class="icon-white">  
                    <?php echo $language === 'en' ? 'Personal Data' : 'اطلاعات شخصی'; ?>  
                </a>  
            </li>  
            <li class="nav-item">  
                <a href="settings.php" class="nav-link">  
                    <img src="<?php echo 'src/styles/css/icons/icons/outline/settings.svg'; ?>" alt="Settings Icon"  
                        width="24" height="24" class="icon-white">  
                    <?php echo $language === 'en' ? 'Settings' : 'تنظیمات'; ?>  
                </a>  
            </li>  
            <li class="nav-item">  
                <a href="support.php" class="nav-link">  
                    <img src="<?php echo 'src/styles/css/icons/icons/outline/phone-call.svg'; ?>" alt="Support Icon"  
                        width="24" height="24" class="icon-white">  
                    <?php echo $language === 'en' ? 'Support' : 'پشتیبانی'; ?>  
                </a>  
            </li>  
            <li class="nav-item">  
                <a href="about.php" class="nav-link">  
                    <img src="<?php echo 'src/styles/css/icons/icons/outline/users-group.svg'; ?>" alt="About Us Icon"  
                        width="24" height="24" class="icon-white">  
                    <?php echo $language === 'en' ? 'About Us' : 'درباره ما'; ?>  
                </a>  
            </li>  
        </ul>  
    </div>  

    <div class="boxes">  
        <!-- Center and layout for all boxes -->  
        <div class="box" onclick="startActivity('walking')">  
            <img src="src/styles/css/icons/icons/outline/walk.svg" alt="Walking Icon">  
            <span>  
                <?php echo $language === 'en' ? 'Walking' : 'پیاده‌روی'; ?>  
            </span>  
        </div>  
        <div class="box" onclick="startActivity('running')">  
            <img src="src/styles/css/icons/icons/outline/run.svg" alt="Running Icon">  
            <span>  
                <?php echo $language === 'en' ? 'Running' : 'دویدن'; ?>  
            </span>  
        </div>  
        <div class="box" onclick="startActivity('bike')">  
            <img src="src/styles/css/icons/icons/outline/bike.svg" alt="Bike Icon">  
            <span>  
                <?php echo $language === 'en' ? 'Bike' : 'دوچرخه سواری'; ?>  
            </span>  
        </div>  
        <div class="box" onclick="startActivity('mountain')">  
            <img src="src/styles/css/icons/icons/filled/mountain.svg" alt="Mountain Icon">  
            <span>  
                <?php echo $language === 'en' ? 'Mountain' : 'کوه‌نوردی'; ?>  
            </span>  
        </div>  
    </div>  

    <div class="bottom-menu">  
        <a href="home.php">  
            <img src="<?php echo 'src/styles/css/icons/icons/outline/home.svg'; ?>" alt="Home Icon" width="24"  
                height="24">  
            <span>  
                <?php echo $language === 'en' ? 'Home' : 'خانه'; ?>  
            </span>  
        </a>  
        <a href="diet_plan.php">  
            <img src="<?php echo 'src/styles/css/icons/icons/outline/tools-kitchen-3.svg'; ?>" alt="Diet Plan Icon"  
                width="24" height="24">  
            <span>  
                <?php echo $language === 'en' ? 'Diet Plan' : 'برنامه غذایی'; ?>  
            </span>  
        </a>  
        <a href="workout_plan.php">  
            <img src="<?php echo 'src/styles/css/icons/icons/outline/run.svg'; ?>" alt="Workout Plan Icon" width="24"  
                height="24">  
            <span>  
                <?php echo $language === 'en' ? 'Workout Plan' : 'برنامه ورزشی'; ?>  
            </span>  
        </a>  
        <a href="progress.php">  
            <img src="<?php echo 'src/styles/css/icons/icons/outline/trending-up.svg'; ?>" alt="Progress Icon"  
                width="24" height="24">  
            <span>  
                <?php echo $language === 'en' ? 'Progress' : 'پیشرفت'; ?>  
            </span>  
        </a>  
    </div>  
</body>
</html>