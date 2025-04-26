<!DOCTYPE html>  
<html lang="<?php echo $language; ?>"> <!-- Set language dynamically -->  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo $language === 'en' ? 'Introduction - Health App' : 'معرفی - اپلیکیشن سلامت'; ?></title>  

    <!-- Include your custom login CSS -->  
    <link href="src/styles/css/intro.css" rel="stylesheet">
     <!-- Tabler CSS -->  
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet"> 
</head>  

<body onload="document.body.classList.add('fade-in');">  
    <div class="page">  
        <div class="container">  
            <div class="card">  
                <div id="carousel-example" class="carousel slide" data-bs-ride="carousel">  
                    <!-- Slides -->  
                    <div class="carousel-inner">  
                        <!-- Slide 1 -->  
                        <div class="carousel-item active" style="background-image: url('src/img/slide1.png');">  
                            <div class="carousel-caption">  
                                <h1><?php echo $language === 'en' ? 'In the Name of God' : 'بنام خداوند جان و خرد'; ?></h1>  
                                <p>  
                                    <?php echo $language === 'en'  
                                        ? 'Using this app helps individuals evaluate their abilities and improve themselves without external judgment. This is crucial for personal growth and should be encouraged.'  
                                        : 'استفاده از (اسم نرم افزار) کمک می کند که افراد بتوانند بدون حضور دیگران به قضاوت در مورد لیاقت و توانایی های خودشان بپردازند و امکان رشد فردی و افزایش توانایی ها تا حد کمال مطلوب را برای خود فراهم کنند و این حالت بسیار با اهمیت است و باید توسعه یابد'; ?>  
                                </p>  
                                <div class="button-container">  
                                    <div class="carousel-indicators">  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="0" class="active"  
                                            aria-current="true" aria-label="Slide 1"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="1"  
                                            aria-label="Slide 2"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="2"  
                                            aria-label="Slide 3"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="3"  
                                            aria-label="Slide 4"></button>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  

                        <!-- Slide 2 -->  
                        <div class="carousel-item" style="background-image: url('src/img/slide2.png');">  
                            <div class="carousel-caption">  
                                <h1><?php echo $language === 'en' ? 'Artificial Intelligence' : 'هوش مصنوعی'; ?></h1>  
                                <p>  
                                    <?php echo $language === 'en'  
                                        ? 'Artificial Intelligence (AI) is a technology that has the ability to think. The combination of the expertise and skills of the (name of software group) with AI reduces the error rate and provides a better understanding of your training conditions. Humans are different from each other; they vary in body size, shape, speed, strength, and many other aspects. Measurement determines the extent of a specific trait present in each individual. Initially.'  
                                        : ' هوش مصنوعی یا AI در واقع تکنولوژی است که به نحوی قابلیت تفکر دارد ، تلفیق تخصص و مهارت گروه ( اسم کارگروه نرم افزار ) با هوش مصنوعی موجب کاهش ضریب خطا و درک صحیح تری از شرایط تمرینی شما خواهد شد . انسان ها با هم فرق دارند . انان از نظر اندازه بدن ، شکل ، سرعت ، قدرت و بسیاری از جنبه های دیگر با هم اختلاف دارند . اندازه گیری ، میزان خصوصیت معین موجود در هر فرد را مشخص می کند. '; ?>  
                                </p>  
                                <div class="button-container">  
                                    <div class="carousel-indicators">  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="0"  
                                            aria-label="Slide 1"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="1"  
                                            class="active" aria-current="true" aria-label="Slide 2"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="2"  
                                            aria-label="Slide 3"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="3"  
                                            aria-label="Slide 4"></button>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  

                        <!-- Slide 3 -->  
                        <div class="carousel-item" style="background-image: url('src/img/slide3.png');">  
                            <div class="carousel-caption">  
                                <h1><?php echo $language === 'en' ? 'Start Your Fitness Journey' : 'شروع ورزش'; ?></h1>  
                                <p>  
                                    <?php echo $language === 'en'  
                                        ? 'The key to starting fitness is self-awareness, goal-setting, and knowledge. Regular exercise is one of the best things you can do for your health. If you are considering starting to exercise but do not know where to begin, we can help you set goals, maintain discipline, and create a fitness plan. If you are already exercising but lack a structured approach and schedule, you can join us.'  
                                        : 'کلید شروع ورزش ، خودآگاهی -انتخاب هدف -دانش روز است . یکی از بهترین کارهایی که می توانید برای حفظ سلامتی خود انجام دهید ، ورزش منظم است . اگر به شروع ورزش فکر می کنید ولی نمیدانید از کجا شروع کنید ما به شما کمک می کنیم ، هدف - نظم و برنامه ورزشی داشته باشید . چناچه هم ورزش انجام می دهید اما نظم و برنامه مشخصی ندارید می توانید با ما همراه باشید.'; ?>  
                                </p>  
                                <div class="button-container">  
                                    <div class="carousel-indicators">  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="0"  
                                            aria-label="Slide 1"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="1"  
                                            aria-label="Slide 2"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="2"  
                                            class="active" aria-current="true" aria-label="Slide 3"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="3"  
                                            aria-label="Slide 4"></button>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  

                        <!-- Slide 4 -->  
                        <div class="carousel-item" style="background-image: url('src/img/slide4.png');">  
                            <div class="carousel-caption">  
                                <h1><?php echo $language === 'en' ? 'Join Us' : 'به ما بپیوندید'; ?></h1>  
                                <p>  
                                    <?php echo $language === 'en'  
                                        ? 'If you are passionate about fitness and AI, take the first step into this exciting world with us today.'  
                                        : 'اگر شما هم جزو علاقه مندان به ورزش و هوش مصنوعی هستید ، از همین حالا می توانید قدم اول برای ورود به این دنیای شگفت انگیز را همراه با ما بردارید'; ?>  
                                </p>  
                                <form action="index.php?page=personal-data" method="POST"> <!-- Ensure this points correctly -->  
                                     <button type="submit" class="btn btn-primary">  
                                        <?php echo $language === 'en' ? 'Get Started' : 'شروع کنید'; ?>  
                                    </button>  
                                </form> 
                                <div class="button-container">  
                                    <div class="carousel-indicators">  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="0"  
                                            aria-label="Slide 1"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="1"  
                                            aria-label="Slide 2"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="2"  
                                            aria-label="Slide 3"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="3"  
                                            class="active" aria-current="true" aria-label="Slide 4"></button>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  
                    </div>  

                    <!-- Controls -->  
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-example"  
                        data-bs-slide="prev">  
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>  
                        <span class="visually-hidden">Previous</span>  
                    </button>  
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-example"  
                        data-bs-slide="next">  
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>  
                        <span class="visually-hidden">Next</span>  
                    </button>  
                </div>  
            </div>  
        </div>  
    </div>  

    <!-- Tabler JS -->  
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>  
    <!-- Bootstrap JS (required for carousel) -->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
</body>  

</html>