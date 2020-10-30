<?php 
    $obj=&get_instance(); 
    $brandslider=$obj->homemodel->all_brand(); 
?>

        
        <!-- Brand Logo Start -->
        <div class="brand-area pb-60">
            <div class="container">
                <!-- Brand Banner Start -->
                <div class="brand-banner owl-carousel">
                    <?php foreach ($brandslider as $idx => $brand) {?>
                    <div class="single-brand">
                        <a href="#"><img class="img" src="<?php echo IMAGE_URL.'brand/'.$brand['brand_img']; ?>" alt="<?php echo $brand['brand_img']; ?>"></a>
                    </div>
                    <?php } ?> 
                </div>
                <!-- Brand Banner End -->                
            </div>
        </div>
        <!-- Brand Logo End -->

        <footer class="off-white-bg">
            <!-- Footer Top Start -->
            <div class="footer-top pt-50 pb-60">
                <div class="container">
                    <div class="row">
                        <!-- Information -->
                        <div class="col-lg-3 col-md-4 col-sm-6 footer-full">
                            <div class="single-footer">
                                <h3 class="footer-title">INFORMATION</h3>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                        <li><a href="<?php echo base_url('about-us'); ?>">About Us</a></li>
                                        <li><a href="<?php echo base_url('category'); ?>">Product</a></li>
                                        <li><a href="<?php echo base_url('contact-us'); ?>">Conatct Us</a></li>
                                        <li><a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Contact us -->
                        <div class="col-lg-7 col-md-4 col-sm-6">
                            <div class="single-footer">
                                <h3>CONTACT US</h3>
                                <div class="footer-content">
                                    <div class="loc-address">
                                        <?php if(!empty($this->m_general->getSetting('address'))){ ?>
                                            <span>
                                                <i class="fa fa-map-marker"></i>
                                                <?php echo $this->m_general->getSetting('address'); ?>
                                            </span>
                                        <?php } ?>
                                        <?php if(!empty($this->m_general->getSetting('email'))){ ?>
                                        <span><i class="fa fa-envelope-o"></i>Mail Us : <?php echo $this->m_general->getSetting('email'); ?></span>
                                        <?php } ?>
                                        <?php if(!empty($this->m_general->getSetting('mobile_no'))){ ?>
                                        <span><i class="fa fa-phone"></i>Phone: <?php echo $this->m_general->getSetting('mobile_no'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- connect with us -->
                        <div class="col-lg-2 col-md-4 col-sm-6 footer-full">
                            <div class="single-footer">
                                <h3 class="footer-title">CONNECT WITH US</h3>
                                <div class="footer-content">
                                        <div class="footer-social-content">
                                            <ul class="social-content-list">
                                                <?php if(!empty($this->m_general->getSetting('social_twitter'))){ ?>
                                                    <li><a href="<?php echo $this->m_general->getSetting('social_twitter'); ?>" target='_blank'><i class="fa fa-twitter"></i></a></li>
                                                <?php } ?>
                                                <?php if(!empty($this->m_general->getSetting('social_google_plus'))){ ?>
                                                    <li><a href="<?php echo $this->m_general->getSetting('social_google_plus'); ?>" target='_blank'><i class="fa fa-google-plus"></i></a></li>
                                                <?php } ?>
                                                <?php if(!empty($this->m_general->getSetting('social_facebook'))){ ?>
                                                    <li><a href="<?php echo $this->m_general->getSetting('social_facebook'); ?>" target='_blank'><i class="fa fa-facebook"></i></a></li>
                                                <?php } ?>
                                                <?php if(!empty($this->m_general->getSetting('social_youtube'))){ ?>
                                                    <li><a href="<?php echo $this->m_general->getSetting('social_youtube'); ?>" target='_blank'><i class="fa fa-youtube"></i></a></li>
                                                <?php } ?>

                                            </ul>
                                            <ul class="social-content-list">
                                                <li>
                                                     <a href="<?php echo base_url() ?>"><img src="<?php echo SITE_URL; ?>img/logo/play_store.png" style="height: 35px;" alt="logo-image"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- connect with us -->
                       
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Footer Top End -->
            <!-- Footer Bottom Start -->
                        
                        
            <div class="footer-bottom off-white-bg2" >
             <div class="group-title" style="height: 50px;margin-bottom: -10px;color: white; ">
                <div class="container">
                    <div class="footer-bottom-content">
                        <p class="copy-right-text">Copyright © <a  href="#" style="color: white;"><?php echo $this->m_general->getSetting('name'); ?></a> All Rights Reserved.</p>
                    </div>
                </div>
                <!-- Container End -->
            </div>
            </div>
            <!-- Footer Bottom End -->
        </footer>
        <!--- Footer End -->
    </div>
    <!-- Wrapper End -->
    <!-- jquery 3.12.4 -->
    <script src="<?php echo SITE_URL; ?>js/vendor/jquery-1.12.4.min.js"></script>
    <!-- mobile menu js  -->
    <script src="<?php echo SITE_URL; ?>js/jquery.meanmenu.min.js"></script>
    <!-- scroll-up js -->
    <script src="<?php echo SITE_URL; ?>js/jquery.scrollUp.js"></script>
    <!-- owl-carousel js -->
    <script src="<?php echo SITE_URL; ?>js/owl.carousel.min.js"></script>
    <!-- slick js -->
    <!-- <script src="<?php echo SITE_URL; ?>js/slick.min.js"></script> -->
    <!-- wow js -->
    <script src="<?php echo SITE_URL; ?>js/wow.min.js"></script>
    <!-- price slider js -->
    <script src="<?php echo SITE_URL; ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo SITE_URL; ?>js/jquery.countdown.min.js"></script>
    <!-- nivo slider js -->
    <script src="<?php echo SITE_URL; ?>js/jquery.nivo.slider.js"></script>
    <!-- fancybox js -->
    <script src="<?php echo SITE_URL; ?>js/jquery.fancybox.min.js"></script>
    <!-- bootstrap -->
    <script src="<?php echo SITE_URL; ?>js/bootstrap.min.js"></script>
    <!-- popper -->
    <script src="<?php echo SITE_URL; ?>js/popper.js"></script>
    <!-- plugins -->
    <script src="<?php echo SITE_URL; ?>js/plugins.js"></script>
    <!-- main js -->
    <script src="<?php echo SITE_URL; ?>js/main.js"></script>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>
</body>

</html>