<!DOCTYPE html>  
<html lang="<?php echo $language; ?>"> <!-- Set language dynamically -->  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo $language === 'en' ? 'Personal Data - Health App' : 'اطلاعات شخصی - اپلیکیشن سلامت'; ?></title>  
    <link href="src/styles/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->  
    <link href="src/styles/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->  
    <link href="src/styles/css/personal-data.css" rel="stylesheet"> <!-- Link to your custom CSS --> 

    <!-- Include jQuery -->  
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>  
    <script src="src/js/personal-data.js"></script>

    <!-- Include Persian Datepicker -->  
    <script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">  

    <style> 

        body {  
            text-align: <?php echo $language === 'fa' ? 'right' : 'center'; ?>;  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>;  
        }   

        .error-message {  
            <?php echo $language === 'fa' ? 'right: 0;' : 'left: 0;'; ?>  
        }  

    </style>  

    <script>  

        function validateForm() {  
            const dob = document.querySelector('input[name="dob"]');   
            const sex = document.querySelector('select[name="sex"]');  
            const weight = document.querySelector('input[name="weight"]');  
            const height = document.querySelector('input[name="height"]');  

            // Clear any previous error messages  
            document.querySelectorAll('.error-message').forEach(error => {  
                error.textContent = '';  
                error.style.display = 'none';  
            });  

            let isValid = true;   

            if (!dob.value) {  
                document.getElementById('dob-error').textContent = '<?php echo $language === 'en' ? "Date of birth is required." : "تاریخ تولد الزامی است."; ?>';  
                document.getElementById('dob-error').style.display = 'block';  
                isValid = false;  
            }  
            if (!sex.value) {  
                document.getElementById('sex-error').textContent = '<?php echo $language === 'en' ? "Sex is required." : "جنسیت الزامی است."; ?>';  
                document.getElementById('sex-error').style.display = 'block';  
                isValid = false;  
            }  
            if (!weight.value) {  
                document.getElementById('weight-error').textContent = '<?php echo $language === 'en' ? "Weight is required." : "وزن الزامی است."; ?>';  
                document.getElementById('weight-error').style.display = 'block';  
                isValid = false;  
            }  
            if (!height.value) {  
                document.getElementById('height-error').textContent = '<?php echo $language === 'en' ? "Height is required." : "قد الزامی است."; ?>';  
                document.getElementById('height-error').style.display = 'block';  
                isValid = false;  
            }  

            if (isValid) {  
                let isPersian = (<?php echo $language === 'fa' ? 'true' : 'false'; ?>);  
                let age = calculateAge(dob.value, isPersian);  

                if (isNaN(age)) {  
                    document.getElementById('dob-error').textContent = '<?php echo $language === 'en' ? "Invalid date format." : "فرمت تاریخ نامعتبر است."; ?>';  
                    document.getElementById('dob-error').style.display = 'block';  
                    return false; // Prevent form submission  
                }  

                document.getElementById('personalDataForm').action = age < 17 ? 'index.php?page=body-type' : 'index.php?page=bmi';  
            }  
            return isValid;   
        }  
    </script>  
</head>  

<body>  

    <?php include 'D:\Wamp\www\health-app2\src\php\Includes\header.php'; ?> <!-- Include the header here --> 
    <div class="login-container">  
        <form id="personalDataForm" method="POST" onsubmit="return validateForm();" autocomplete="off" novalidate>   
            <img src="src/img/logo.png" alt="Health App Logo" class="logo">   
            <h1>  
                <?php echo $language === 'en' ? 'Personal Data' : 'اطلاعات شخصی'; ?>  
            </h1>  
            <p>  
                <?php echo $language === 'en'  
                    ? 'Please enter your personal data to continue.'  
                    : 'لطفاً اطلاعات شخصی خود را وارد کنید.'; ?>  
            </p>  

            <!-- Date of Birth Input -->  
            <div class="input-container">  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Date of Birth' : 'تاریخ تولد'; ?> <span style="color: red;">*</span>  
                </label>  
                <?php if ($language === 'fa'): ?>  
                    <input type="text" id="dob" name="dob" class="form-control"  
                        placeholder="تاریخ تولد خود را وارد کنید (YYYY/MM/DD)" required>  
                <?php else: ?>  
                    <input type="date" id="dob" name="dob" class="form-control"  
                        required>  
                <?php endif; ?>  
                <div id="dob-error" class="error-message"></div>  
            </div>  

            <!-- Sex Input -->  
            <div class="input-container">  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Sex' : 'جنسیت'; ?> <span style="color: red;">*</span>  
                </label>  
                <select id="sex" name="sex" class="form-control" required>  
                    <option value=""><?php echo $language === 'en' ? 'Select your sex' : 'جنسیت خود را انتخاب کنید'; ?></option>  
                    <option value="male"><?php echo $language === 'en' ? 'Male' : 'مرد'; ?></option>  
                    <option value="female"><?php echo $language === 'en' ? 'Female' : 'زن'; ?></option>  
                </select>  
                <div id="sex-error" class="error-message"></div>  
            </div>  

            <!-- Weight Input -->  
            <div class="input-container">  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Weight (kg)' : 'وزن (کیلوگرم)'; ?> <span style="color: red;">*</span>  
                </label>  
                <input type="number" id="weight" name="weight" class="form-control"  
                    placeholder="<?php echo $language === 'en' ? 'Enter your weight (kg)' : 'وزن خود را وارد کنید (کیلوگرم)'; ?>"  
                    min="0" max="300" required>  
                <div id="weight-error" class="error-message"></div>  
            </div>  

            <!-- Height Input -->  
            <div class="input-container">  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Height (cm)' : 'قد (سانتی‌متر)'; ?> <span style="color: red;">*</span>  
                </label>  
                <input type="number" id="height" name="height" class="form-control"  
                    placeholder="<?php echo $language === 'en' ? 'Enter your height (cm)' : 'قد خود را وارد کنید (سانتی‌متر)'; ?>"  
                    min="0" max="250" required>  
                <div id="height-error" class="error-message"></div>  
            </div>  

            <!-- Submit Button -->  
            <button type="submit" class="btn-primary">  
                <?php echo $language === 'en' ? 'Submit Data' : 'ارسال اطلاعات'; ?>  
            </button>  
        </form>  
    </div>  

    <?php if ($language === 'fa'): ?>  
        <script>  
            // Initialize Persian Date Picker  
            $(document).ready(function () {  
                $('#dob').persianDatepicker({  
                    format: 'YYYY/MM/DD', // Ensure this matches your expected format  
                    initialValue: false,  
                    autoClose: true,  
                });  
            });  
        </script>  
    <?php endif; ?>  
</body>  

</html>