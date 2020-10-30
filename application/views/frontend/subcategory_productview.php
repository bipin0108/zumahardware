<?php 
    $obj=&get_instance(); 
    $cat_tree=$obj->homemodel->get_all_cat_tree();
    $cat_slug = $this->uri->segment(2);
    $cat_id = $obj->homemodel->get_catid_by_slug($cat_slug);
    $cat_name = $obj->homemodel->get_catname_by_slug($cat_slug);
    $subcat_name = $this->uri->segment(3);
    $subcat_id = $obj->homemodel->get_subcatid_by_name($subcat_name);
    $products = $obj->homemodel->get_product_by_subcat_id($subcat_id);
?>
 <!-- Breadcrumb Start -->
<div class="breadcrumb-area ptb-45 ptb-sm-30">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url('category/'.$cat_slug); ?>"><?php echo ucfirst($cat_name); ?></a></li>
                <li class="active"><a href="javascript:;">Products</a></li>
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
                            <div  style="margin-top: 16px;margin-left: 66px;">
                                <h2>categories</h2>
                            </div>
                        </div>
                            <?php foreach ($cat_tree as $idx => $cat) { ?>
                                <a style="<?php echo ($cat_id == $cat->id)?'color:#01A8DC;':''; ?>" href="#item<?php echo $idx; ?>" class="list-group-item" data-toggle="collapse">
                                <i class="fa fa-chevron-<?php echo ($cat_id == $cat->id)?'down':'right'; ?> "></i> <?php echo $cat->name; ?>
                                </a>

                                <div class="list-group collapse <?php echo ($cat_id == $cat->id)?'show':''; ?>" id="item<?php echo $idx; ?>">
                                    <?php if(count($cat->subs) > 0){ ?>
                                         <?php  foreach ($cat->subs as $sub) { ?>
                                            <a href="<?php echo base_url('product/'.$cat->slug.'/'.$sub['slug'].'/product-list/'); ?>" class="list-group-item <?php echo ($subcat_id == $sub['subcat_id'])?'active':''; ?>">
                                              <?php echo "&nbsp;".$sub['subcat_name'];?>
                                            </a>
                                          <?php } ?>
                                    <?php } ?>
                                  </div>
                            <?php } ?>
                    </div>
                  <!-- Single Banner Start -->
                    
                    <!-- Single Banner End -->
                </div>
            </div>
            <!-- Sidebar Shopping Option End -->   
            <div class="col-lg-9 order-lg-2">
                <!-- Grid & List View Start -->
                <div>
                    <div>
                       <h4><?php echo ucfirst($subcat_name); ?></h4><hr>
                    </div>
                </div>
                <!-- Grid & List View End -->
                <div class="main-categorie">
                    <!-- Grid & List Main Area End -->
                    <div class="tab-content fix">
                        <div id="grid-view" class="tab-pane active">
                            <div class="row">
                                <?php if(!empty($products)){ ?>
                                    <?php foreach ($products as $pro) { ?>
                                        <!-- Single Product Start --> 
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="single-product">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="<?php echo base_url('zuma-product/'.$cat_name.'/'.$subcat_name.'/'.$pro->slug) ?>">
                                                    <?php $img_arr = explode(',',$pro->product_image) ?>
                                                    <img class="primary-img pro-img" src="<?php echo  IMAGE_URL.'products/product_images/thumbnail/'.$img_arr[0];  ?>" alt="single-product">
                                                    <?php if(isset($img_arr[1])){ ?> 
                                                      <img class="secondary-img pro-img" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$img_arr[1];  ?>" alt="single-product">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <?php 
                                              $product_name = strip_tags($pro->name);
                                              if (strlen($product_name) > 30) {

                                                  // truncate string
                                                  $stringCut = substr($product_name, 0, 30);
                                                  $endPoint = strrpos($stringCut, ' ');

                                                  //if the string doesn't contain any space then it will cut without word basis.
                                                  $product_name = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                  $product_name .= '...';
                                              }
                                            ?>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4>
                                                    <a href="<?php echo base_url('zuma-product/'.$cat_name.'/'.$subcat_name.'/'.$pro->slug) ?>"><?php echo $pro->code; ?></a>
                                                    <br>
                                                    <a href="<?php echo base_url('zuma-product/'.$cat_name.'/'.$subcat_name.'/'.$pro->slug) ?>"><?php echo $product_name; ?></a>
                                                </h4>
                                                
                                                
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                    </div>
                                    <!-- Single Product End -->    
                                    <?php } ?>
                                <?php }else{ ?>
                                    <h4 style="margin-left: 25px;">Product not found.</h4>
                                <?php } ?>
                            </div>                                    
                        </div>
                    </div>
                    <!-- Grid & List Main Area End -->
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