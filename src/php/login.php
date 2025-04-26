<!DOCTYPE html> 

<head>  
    <!-- Include your custom login CSS -->  
    <link href="src/styles/css/login.css" rel="stylesheet">  
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>   
</head>  

<style> 

        .input-box input {  
            text-align: <?php echo $language === 'fa' ? 'right' : 'left'; ?>; /* Adjust text alignment based on language */
        }  
</style>

<div class="container">  
    <div class="form-box login">  
        <form action="home.php" method="POST">  <!-- Changed from GET to POST -->  
            <h1><?php echo $language === 'en' ? 'Login' : 'ورود'; ?></h1>  
            <div class="input-box">  
                <input type="text" name="username" placeholder="<?php echo $language === 'en' ? 'Username' : 'نام کاربری'; ?>" required>  
                <i class='bx bxs-user'></i>  
            </div>  
            <div class="input-box">  
                <input type="tel" name="phone" placeholder="<?php echo $language === 'en' ? 'Phone Number' : 'شماره تلفن'; ?>" required>  
                <i class='bx bxs-phone'></i>  
            </div>  
            <div class="forgot-link">  
                <!-- Removed "Forgot Password?" link -->  
            </div>  
            <button type="submit" class="btn"><?php echo $language === 'en' ? 'Login' : 'ورود'; ?></button>  
            <select id="language-select" class="form-select language-select" onchange="switchLanguage(this.value)">  
                <option value="fa" <?php echo $language === 'fa' ? 'selected' : ''; ?>>فا</option>  
                <option value="en" <?php echo $language === 'en' ? 'selected' : ''; ?>>En</option>  
            </select>  
        </form>  
    </div>  

    <div class="form-box register">  
        <form action="index.php?page=introduction" method="POST">  <!-- Changed from GET to POST -->  
            <h1><?php echo $language === 'en' ? 'Registration' : 'ثبت نام'; ?></h1>  
            <div class="input-box">  
                <input type="text" name="username" placeholder="<?php echo $language === 'en' ? 'Username' : 'نام کاربری'; ?>" required>  
                <i class='bx bxs-user'></i>  
            </div>  
            <div class="input-box">  
                <input type="tel" name="phone" placeholder="<?php echo $language === 'en' ? 'Phone Number' : 'شماره تلفن'; ?>" required>  
                <i class='bx bxs-phone'></i>  
            </div>  
            <div class="input-box">  
                <input type="email" name="email" placeholder="<?php echo $language === 'en' ? 'Email' : 'ایمیل'; ?>" required>  
                <i class='bx bxs-envelope'></i>  
            </div>  
            <div class="input-box">  
                <p style="font-size: 14px;"><?php echo $language === 'en' ? 'By signing up, you accept our ' : 'با ثبت نام، شما شرایط '; ?>   
                <a href="#" style="color: #7494ec;"><?php echo $language === 'en' ? 'Privacy Policy' : 'سیاست حفظ حریم خصوصی'; ?></a>.</p>  
            </div>  
            <button type="submit" class="btn"><?php echo $language === 'en' ? 'Sign Up' : 'ثبت نام'; ?></button>  
        </form>  
    </div>  

    <div class="toggle-box">  
        <div class="toggle-panel toggle-left">  
            <h1><?php echo $language === 'en' ? 'Hello, Welcome!' : 'سلام، خوش آمدید!'; ?></h1>  
            <p><?php echo $language === 'en' ? "Don't have an account?" : "آیا حساب کاربری ندارید؟"; ?></p>  
            <button class="btn register-btn"><?php echo $language === 'en' ? 'Register' : 'ثبت نام'; ?></button>  
        </div>  

        <div class="toggle-panel toggle-right">  
            <h1><?php echo $language === 'en' ? 'Welcome Back!' : 'خوش آمدید!'; ?></h1>  
            <p><?php echo $language === 'en' ? 'Already have an account?' : 'قبلاً حساب کاربری دارید؟'; ?></p>  
            <button class="btn login-btn"><?php echo $language === 'en' ? 'Login' : 'ورود'; ?></button>  
        </div>  
    </div>  
</div>  

<script src="src/js/login.js"></script>  
<script>  
    const container = document.querySelector('.container');  
    const registerBtn = document.querySelector('.register-btn');  
    const loginBtn = document.querySelector('.login-btn');  

    registerBtn.addEventListener('click', () => {  
        container.classList.add('active');  
    });  

    loginBtn.addEventListener('click', () => {  
        container.classList.remove('active');  
    });  
</script>  