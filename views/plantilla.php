<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contamatic</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="vista/img/perfil1.png" title="Favicon" sizes="16x16" />

    <!-- ====== bootstrap icons cdn ====== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <!-- ====== font family ====== -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="vista/css/lib/all.min.css" />
    <link rel="stylesheet" href="vista/css/lib/animate.css" />
    <link rel="stylesheet" href="vista/css/lib/jquery.fancybox.css" />
    <link rel="stylesheet" href="vista/css/lib/lity.css" />
    <link rel="stylesheet" href="vista/css/lib/swiper.min.css" />
    <!-- ====== global style ====== -->
    <link rel="stylesheet" href="vista/css/style.css" />

    
    
    <link href="vista/css/style-modal.css?rel=<?php echo time()?>" rel="stylesheet">
    <link href="vista/css/style-box.css?rel=<?php echo time()?>" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>


</head>
<body>
 
    <!-- ====== start loading page ====== -->
    <div id="preloader">
    </div>
    <!-- ====== end loading page ====== -->

    <!-- Wathsapp-->
    
    <a href="https://api.whatsapp.com/send?phone=+5930999097984&text=Hola,%20vengo%20del%20sitio%20web%20de%20Contamatic,%20y%20tengo%20inter%C3%A9s%20en%20conocer%20sobre%20facturaci%C3%B3n%20electr%C3%B3nica%20para%20mi%20empresa." class="whatsapp" target="_blank"> <i class="bi bi-whatsapp"></i></a>

    <!--End Whatsapp-->

    
   <?php 
   if (isset($_GET["ruta"]) && $_GET["ruta"]=="privacidad"){
    include "modulos/menuPrivacidad.php" ;
   }else{
    include "modulos/menuPrincipal.php" ;
   }
    ?> 
   
   

<!-- ====== start header ====== -->


<!-- ====== end header ====== -->
<main>

<?php 
   /*if (isset($_GET["ruta"]) && $_GET["ruta"]=="privacidad"){
    include "modulos/privacidad.php" ;
   }else{
    include "modulos/inicio.php" ;
   }*/
   if (isset($_GET["ruta"])){
    if(is_file("vista/modulos/".$_GET["ruta"].".php")){
        include "modulos/".$_GET["ruta"].".php" ;
    }else{
        include "modulos/inicio.php" ;
    }
   }else{
    include "modulos/inicio.php" ;
   }


    ?> 
   



</main>

 
 

    <!-- ====== request ====== -->
    <script src="vista/js/lib/jquery-3.0.0.min.js"></script>
    <script src="vista/js/lib/jquery-migrate-3.0.0.min.js"></script>
    <script src="vista/js/lib/bootstrap.bundle.min.js"></script>
    <script src="vista/js/lib/wow.min.js"></script>
    <script src="vista/js/lib/jquery.fancybox.js"></script>
    <script src="vista/js/lib/lity.js"></script>
    <script src="vista/js/lib/swiper.min.js"></script>
    <script src="vista/js/lib/jquery.waypoints.min.js"></script>
    <script src="vista/js/lib/jquery.counterup.js"></script>
    <script src="vista/js/lib/pace.js"></script>
    <script src="vista/js/lib/scrollIt.min.js"></script>
    <script src="vista/js/main.js"></script>
    <script src="vista/js/main2.js"></script>


   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    
    
    <link href="vista/vendor/remixicon/remixicon.css" rel="stylesheet">

        <!-- Vendor JS Files -->
    <!--script src="vista/vendor/purecounter/purecounter.js"></script-->
    <script src="vista/vendor/aos/aos.js"></script>
    <script src="vista/vendor/glightbox/js/glightbox.min.js"></script>
    <!--script src="vista/vendor/isotope-layout/isotope.pkgd.min.js"></script-->
    <script src="vista/vendor/swiper/swiper-bundle.min.js"></script>


    <!-- Template Main JS File -->
    <script src="vista/js/main.js"></script>

    <!-- Contacto JS File -->
    <script src="vista/js/contacto.js?ath=<?php echo time();?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.js.map"></script>
</body>
</html>