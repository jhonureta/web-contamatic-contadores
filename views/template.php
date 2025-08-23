<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Contamatic - Plataforma del contador</title>

    <meta name="author" content="Systemwork S.A">     
    <meta name="description" content="Serenite is a Responsive HTML5 Template for SaaS, cryptocurrency, app and tech companies, as well as for digital studios.">
    <meta name="keywords" content="Serenite, themeforest template, app, app landing page, App Showcase, cryptocurrency, digital studio, saas, saas landing, saas theme, software, software company website, software startup, startup, startup landing page, startup wordpress, technology">

    <!-- Favicon -->    
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <!-- Plugin Style CSSS -->
    <link rel="stylesheet" href="assets/css/theme-plugins.min.css">
    <!-- Main Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Home Default CSS -->
    <link rel="stylesheet" href="assets/css/home-default.css">

    <link href="views/css/style.css?rel=<?php echo time()?>" rel="stylesheet">
</head>

<body>
       <!-- Page loader Start -->
    <div id="pageloader">
        <div class="loader-item">
            <img src="assets/images/contamatic1.1.gif" width="100" alt="">
        </div>
    </div>
     <div class="home-default">
    <?php 
            include "modules/pre-header.view.php";
            include "modules/header.view.php";
            include "modules/banner.view.php";
            include "modules/body.view.php";
            include "modules/footer.view.php";
           

        ?>
     </div>

         <a id="back-to-top" href="javascript:" class="back-to-top"><i class="bi bi-chevron-up"></i></a>
    <!-- Back to Top End -->

    <!-- Search Popup Start -->
    <div class="overlay overlay-hugeinc">    
        <form class="form-inline mt-2 mt-md-0">
            <div class="form-inner">
                <div class="form-inner-div hstack">
                    <i class="srn-search"></i> 
                    
                    <div class="w-100">
                        <input class="form-control form-light" type="text" placeholder="Search" aria-label="Search">
                    </div>
                    <a href="#" class="overlay-close link-oragne"><i class="bi bi-x"></i></a>
                </div>
            </div>
        </form>
    </div>
      <!-- Jquery Library JS -->
    <script src="assets/js/jquery-min.js"></script>
    <!-- Theme Plugin -->
    <script src="assets/js/theme-plugins.min.js"></script>
    <!-- Theme Custom -->
    <script src="assets/js/script.js"></script>
    <script src="views/js/contact.js"></script>
</body>
</html>