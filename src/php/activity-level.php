<?php  
// Check if a language is set in the session, otherwise default to Persian  
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'fa';  

// Assume BMI value is set in a session variable or calculated previously  
$bmi = isset($_SESSION['bmi']) ? $_SESSION['bmi'] : 0; // Replace with actual BMI calculation logic  
?>  

<!DOCTYPE html>  
<html lang="<?php echo $language; ?>"> <!-- Set language dynamically -->  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo $language === 'en' ? 'Activity Level - Health App' : 'سطح فعالیت - اپلیکیشن سلامت'; ?></title>  
    <link href="src/styles/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->  
    <link href="src/styles/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->   
    <link href="src/styles/css/activity-level.css" rel="stylesheet"> <!-- Link to your custom CSS -->   
    <!-- Include jQuery -->  
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>  
    <script src="src/js/activity-level.js"></script>  

    <style>  
        body {  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>;    */  
        }  
    </style>  
</head>  

<body> 
    
    <?php include 'D:\Wamp\www\health-app2\src\php\Includes\header.php'; ?> <!-- Include the header here --> 
    <div class="login-container">   
        <form onsubmit="handleActivityLevelSubmit(event)" autocomplete="off" novalidate>  
            <img src="src/img/logo.png" alt="Health App Logo" class="logo">  
            <h1>  
                <?php echo $language === 'en' ? 'Activity Level' : 'سطح فعالیت'; ?>  
            </h1>  
            <p>  
                <?php echo $language === 'en'  
                    ? 'Please select your level of physical activity.'  
                    : 'لطفاً سطح فعالیت بدنی خود را انتخاب کنید.'; ?>  
            </p>  

            <!-- Activity Level Options -->  
            <div>  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Select Activity Level' : 'سطح فعالیت خود را انتخاب کنید'; ?>  
                </label>  
                <select name="activity_level" class="form-control" required>  
                    <option value=""><?php echo $language === 'en' ? 'Choose an option' : 'یک گزینه را انتخاب کنید'; ?></option>  
                    <option value="sedentary">  
                        <?php echo $language === 'en' ? 'Sedentary (little or no exercise)' : 'کم تحرک (بدون ورزش یا فعالیت کم)'; ?>  
                    </option>  
                    <option value="light">  
                        <?php echo $language === 'en' ? 'Lightly active (light exercise/sports 1-3 days a week)' : 'فعالیت سبک (ورزش سبک ۱-۳ روز در هفته)'; ?>  
                    </option>  
                    <option value="moderate">  
                        <?php echo $language === 'en' ? 'Moderately active (moderate exercise/sports 3-5 days a week)' : 'فعالیت متوسط (ورزش متوسط ۳-۵ روز در هفته)'; ?>  
                    </option>  
                    <option value="active">  
                        <?php echo $language === 'en' ? 'Active (intense exercise/sports 6-7 days a week)' : 'فعال (ورزش شدید ۶-۷ روز در هفته)'; ?>  
                    </option>  
                    <option value="very_active">  
                        <?php echo $language === 'en' ? 'Very active (very intense exercise or physical job)' : 'بسیار فعال (ورزش بسیار شدید یا شغل فیزیکی)'; ?>  
                    </option>  
                </select>  
            </div>  

            <!-- Error Message Display -->  
            <div id="error-message" class="error"></div>  

            <!-- Submit Button -->  
            <button type="submit" class="btn-primary">  
                <?php echo $language === 'en' ? 'Submit Activity Level' : 'ارسال سطح فعالیت'; ?>  
            </button>  
        </form>  
        <a href="http://localhost/health-app2/index.php?page=body-type" class="signup-button">  
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">  
                <path fill="none" d="M0 0h24v24H0z" />  
                <path  
                    d="M7 12l5-5v3h4v4h-4v3zM20 4v16a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1z" />  
            </svg>  
            <?php echo $language === 'en' ? 'Back to body-type' : 'بازگشت به نوع بدن'; ?>  
        </a>  
    </div>  

    <script>  
    // Function to handle the "Submit" button click  
    function handleActivityLevelSubmit(event) {  
        event.preventDefault(); // Prevent the default form submission  

        var activityLevel = document.querySelector('select[name="activity_level"]').value; // Get the selected activity level  
        var errorMsg = document.getElementById('error-message'); // Get the error message element  

        // Clear previous error message  
        errorMsg.textContent = '';  
        errorMsg.style.display = 'none'; // Hide error message initially  

        // Check if an activity level is selected  
        if (!activityLevel) {  
            errorMsg.textContent = '<?php echo $language === 'en' ? "Please select your activity level." : "لطفاً سطح فعالیت خود را انتخاب کنید."; ?>';  
            errorMsg.style.display = 'block'; // Show error message  
            return; // Stop further processing if no selection is made  
        }  

        var bmi = <?php echo $bmi; ?>; // Get the BMI value from PHP  

        if (bmi > 25) {  
            // Redirect to suggestion.php if BMI is above 25  
            window.location.href = 'index.php?page=suggestion1';  
        } else if (bmi <= 18.5) {  
            // Redirect to suggestion3.php if BMI is less than or equal to 18.5  
            window.location.href = 'index.php?page=suggestion3';  
        } else {  
            // Redirect to suggestion2.php if BMI is between 18.5 and 25 (including 25)  
            window.location.href = 'index.php?page=suggestion2';  
        }  
    }  
</script>  
</body>  
</html>