<?php 
    $obj=&get_instance(); 
    $all_slider=$obj->homemodel->all_slider(); 
?>
<div class="slider-area pb-60">
    <div class="slider-wrapper theme-default  nivo2">
        <!-- Slider Background  Image Start-->
        <div id="slider" class="nivoSlider">
             <?php foreach ($all_slider as $idx => $slider){ ?>
            <a href="javascript:;"> <img src="<?php echo IMAGE_URL.'slider/'.$slider['slider_image']; ?>" alt="slider-banner"></a>
            <?php } ?>
        </div>
    </div>
</div>
