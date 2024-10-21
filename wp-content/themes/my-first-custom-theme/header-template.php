<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="">

  <title> 
    <?php
      bloginfo('name');
      wp_title();
      if(is_front_page()) {
        echo "|";
        bloginfo('description');
      }
    ?> 
  </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory'); ?>/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="<?php echo bloginfo('template_directory'); ?>/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="<?php echo bloginfo('template_directory'); ?>/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="<?php echo bloginfo('template_directory'); ?>/css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero-bg.png" alt="">
      </div>
    </div>

    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="<?php echo site_url(); ?>/index.php">
          <span>
              <?php
                $logoImg = get_header_image();
              ?>
              <a href="<?php echo site_url(); ?>"><img src="<?php echo $logoImg; ?>" alt="" style="width: 150px; height: 100px;"></a>
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php 
              wp_nav_menu(
                array(
                  'theme_location' => 'primary-menu',
                  'menu_class' => 'mynav'
                )
              ); 
            ?>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>