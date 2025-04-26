<?php  
session_start(); // Ensure session is started  

$basePath = '/health-app2/';

// Include the header file  
include 'D:\Wamp\www\health-app2\src\php\Includes\header.php';

?>  

<!DOCTYPE html>  
<head>  
    <base href="<?php echo $basePath; ?>"> 
    <title>Health-app</title>  
</head>  

<?php  
// Get the requested page, defaulting to 'login'  
$page = isset($_GET['page']) ? $_GET['page'] : 'login';  

// Include the requested page  
switch ($page) {  
    case 'login':  
        include 'src/php/login.php';  
        break;  
    case 'home':  
        include 'src/php/home.php';  
        break;  
    case 'introduction':  
        include 'src/php/introduction.php';  
        break;  
    case 'personal-data':  
        include 'src/php/personal-data.php';  
        break;  
    case 'bmi':  
        include 'src/php/bmi.php';  
        break;  
    case 'body-type':  
        include 'src/php/body-type.php';  
        break;  
    case 'activity-level':  
        include 'src/php/activity-level.php';  
        break;  
    case 'aerobic':  
        include 'src/php/aerobic.php';  
        break;  
    case 'Loader1':  
        include 'src/php/Loader1.php';  
        break;  
    case 'Loader2':  
        include 'src/php/Loader2.php';  
        break;  
    case 'Pedometer':  
        include 'src/php/Pedometer.php';  
        break;  
    case 'suggestion1':  
        include 'src/php/suggestion1.php';  
        break;  
    case 'suggestion2':  
        include 'src/php/suggestion2.php';  
        break;  
    case 'suggestion3':  
        include 'src/php/suggestion3.php';  
        break;  
    case 'workout':  
        include 'src/php/workout.php';  
        break;  
    case 'forgot-password':  
        include 'src/php/forgot-password.php';  
        break;  
    case 'test':  
        include 'src/php/test.html';  
        break;  
    default:  
        include 'src/php/login.php';  
        break;  
}  
?>  

</body>  
</html>  