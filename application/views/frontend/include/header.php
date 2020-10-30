<?php 
$obj=&get_instance();
$cat_tree=$obj->homemodel->get_all_cat_tree();
?>
<!doctype html>
<html class="no-js" lang="en-US">
<head>
   <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo ucfirst($page)." | ".$this->m_general->getSetting('name'); ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL; ?>img/icon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lily+Script+One" rel="stylesheet"> 
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/meanmenu.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/animate.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/nivo-slider.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/owl.carousel.min.css">
     <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/slick.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/jquery.fancybox.css">      -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/default.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/responsive.css">
    <script src="<?php echo SITE_URL; ?>js/vendor/modernizr-2.8.3.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Wrapper Start -->
    <div class="wrapper homepage">
        <!-- Header Area Start -->
        <header>
            <!-- Header Bottom Start -->
            <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-2 col-sm-5 col-5">
                            <div class="logo">
                                <a href="<?php echo base_url() ?>"><img src="<?php echo SITE_URL; ?>img/logo/zuma-logo.png" alt="logo-image"></a>
                            </div>
                        </div>
                        <!-- Primary Vertical-Menu End -->
                        <!-- Search Box Start -->
                        <div class="col-xl-6 col-lg-7 d-none d-lg-block">
                            <div class="middle-menu pull-right">
                                <nav>
                                    <ul class="middle-menu-list">
                                        <li><a class="<?php echo($page == 'home')? 'active':''; ?>" href="<?php echo base_url(); ?>">Home</a></li>
                                        <li><a class="<?php echo($page == 'about')? 'active':''; ?>" href="<?php echo base_url('about-us'); ?>">About us</a></li>
                                        <li><a href="<?php echo base_url('category'); ?>" class="<?php echo($page == 'products')? 'active':''; ?>">Product</a>
                                        </li>
                                        <li><a class="<?php echo($page == 'contact')? 'active':''; ?>" href="<?php echo base_url('contact-us'); ?>">contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Cartt Box Start -->
                        <div class="col-lg-3 col-sm-7 col-7" style="margin-top: -4px;">
                            <div class="cart-box text-right">
                                <ul>
                                    <li>
                                       <a href="#">  
                                            <div class="search-box-view" >
                                                <form action="<?php echo base_url('search-product') ?>">
                                                    <div class="cart-actions">
                                                        <input type="text" class="email" placeholder="Search Your Product" name="product" autocomplete="off">
                                                        <button type="submit" class="submit"></button>
                                                    </div>
                                                </form>
                                            </div>
                                       </a>
                                    </li> 
                                 </ul>
                            </div>
                        </div>
                        <!-- Cartt Box End -->
                        <div class="col-sm-12 d-lg-none">
                            <div class="mobile-menu">
                                <nav>
                                    <ul>
                                        <li><a href="<?php echo base_url(); ?>">home</a>
                                        </li>
                                        <li><a href="<?php echo base_url('category'); ?>" class="<?php echo($page == 'products')? 'active':''; ?>">Product</a>
                                        </li>
                                        <!-- Mobile Menu Dropdown End -->
                                        <li><a href="<?php echo base_url('about-us'); ?>">about us</a></li>
                                        <li><a href="<?php echo base_url('contact-us'); ?>">contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Mobile Menu  End -->                        
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Header Bottom End -->
        </header>
        <!-- Header Area End -->