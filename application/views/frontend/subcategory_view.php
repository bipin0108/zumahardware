<?php 
    $obj=&get_instance(); 
    $slug=$this->uri->segment(2);
    $all_cat=$obj->homemodel->all_category();
    $cat_id = $obj->homemodel->get_catid_by_slug($slug);
    $cat_name = $obj->homemodel->get_catname_by_slug($slug);
    $subcat = $obj->homemodel->get_products_by_id($cat_id);
?>

 <!-- Breadcrumb Start -->
<div class="breadcrumb-area ptb-45 ptb-sm-30">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url('category'); ?>"><?php echo $cat_name; ?></a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Shop Page Start -->
<div class="main-shop-page pb-60">
    <div class="container">
        <!-- Row End -->
        <div class="row">
             <!-- Sidebar Shopping Option Start -->
            <div class="col-lg-3  order-2">
                <div class="sidebar white-bg">
                    <div class="single-sidebar">
                        <div class="group-title">
                            <div>
                                <h2>categories</h2>
                            </div>
                        </div>
                            <?php foreach ($all_cat as $idx => $cat) { ?>
                                

                                <a style="<?php echo ($cat_id == $cat->id)?'color:#01A8DC;':''; ?>" href="<?php echo base_url('category/'.$cat->slug) ?>" class="list-group-item" >
                                <i class="fa fa-chevron-<?php echo ($cat_id == $cat->id)?'down':'right'; ?> "></i> <?php echo $cat->name; ?>
                                </a>
                            <?php } ?>
                    </div>
                  <!-- Single Banner Start -->
                    
                    <!-- Single Banner End -->
                </div>
            </div>
            <!-- Sidebar Shopping Option End -->
            <!-- Product Categorie List Start -->
            <div class="col-lg-9 order-lg-2">
                <!-- Grid & List View Start -->
                <?php if(!empty($subcat)){ ?>
                <?php foreach ($subcat as $cat) { ?>
                <?php if(!empty($cat['product'])){ ?>
                    <div class="grid-list-top border-default universal-padding fix mb-30">
                        <div class="grid-list-view f-left">
                            <label style="font-size:23px;"><?php echo $cat['sub_cat_name']; ?></label>
                        </div>
                        <div class="f-right">
                         <a href="<?php echo base_url('product/'.$slug.'/'.$cat['slug'].'/product-list/'); ?>" class="add-cart">View More <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a>
                        </div> 
                    </div>
                    <div class="main-categorie">
                        <div class="tab-content fix">
                            <div id="grid-view" class="tab-pane active">
                                <div class="row">
                                    <?php if(!empty($cat['product'])){ ?>
                                     <?php foreach ($cat['product'] as $product) { ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="single-product">
                                            <div class="pro-img">
                                                <a href="<?php echo base_url('zuma-product/'.$slug.'/'.$cat['slug'].'/'.$product->slug) ?>">
                                                <?php $img_arr = explode(',',$product->product_image) ?>
                                                <img class="primary-img pro-img" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$img_arr[0];  ?>" alt="single-product" >
                                                 <?php if(isset($img_arr[1])){ ?> 
                                                  <img class="secondary-img pro-img" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$img_arr[1];  ?>" alt="single-product" >
                                                <?php } ?>
                                                </a>
                                            </div>
                                            <?php 
                                              $product_name = strip_tags($product->name);
                                              if (strlen($product_name) > 30) {

                                                  // truncate string
                                                  $stringCut = substr($product_name, 0, 30);
                                                  $endPoint = strrpos($stringCut, ' ');

                                                  //if the string doesn't contain any space then it will cut without word basis.
                                                  $product_name = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                  $product_name .= '...';
                                              }
                                            ?>
                                            <div class="pro-content">
                                                <h4>    
                                                <a href="<?php echo base_url('zuma-product/'.$slug.'/'.$cat['slug'].'/'.$product->slug) ?>"><?php echo $product->code; ?></a>
                                                <br>
                                                <a href="<?php echo base_url('zuma-product/'.$slug.'/'.$cat['slug'].'/'.$product->slug) ?>"><?php echo $product_name; ?></a>
                                                </h4>
                                            </div> 
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php } else{ ?>
                                        <h4 style="margin-left: 25px;">Product not found.</h4>
                                    <?php } ?>  
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>  
                <?php } ?>
                <?php } else{ ?>
                    <h4>Product not found.</h4>
                <?php } ?>
                 
            </div>
        </div>
            <!-- product Categorie List End -->
     </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Shop Page End -->

<script type="text/javascript">
$(function() {
        
  $('.list-group-item').on('click', function() {
    $('.fa', this)
      .toggleClass('fa-chevron-right')
      .toggleClass('fa-chevron-down');
  });

});
</script>
<style type="text/css">
  .pro-img{
    width:240px;
    height:200px;
  }
</style>
<style type="text/css">
    .just-padding {
    padding: 15px;
}

.list-group.list-group-root {
    padding: 0;
    overflow: hidden;
}

.list-group.list-group-root .list-group {
    margin-bottom: 0;
}

.list-group.list-group-root .list-group-item {
    border-radius: 0;
    border-width: 1px 0 0 0;
}

.list-group.list-group-root > .list-group-item:first-child {
    border-top-width: 0;
}

.list-group.list-group-root > .list-group > .list-group-item {
    padding-left: 30px;
}

.list-group.list-group-root > .list-group > .list-group > .list-group-item {
    padding-left: 45px;
}

.list-group-item .glyphicon {
    margin-right: 5px;
}
</style>
