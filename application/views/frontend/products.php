<?php 
    $obj=&get_instance();
    $cat_tree=$obj->homemodel->get_all_cat_tree();
    $subcate_id = explode('-', $this->uri->segment(2))[1];
    $cat_id = $obj->homemodel->getCategoryId($subcate_id);
?>
 <!-- Breadcrumb Start -->
<div class="breadcrumb-area ptb-45 ptb-sm-30">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
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
                                    <i class="fa fa-chevron-<?php echo ($cat_id == $cat->id)?'down':'right'; ?>"></i> <?php echo $cat->name; ?>
                                  </a>

                              <div class="list-group collapse <?php echo ($cat_id == $cat->id)?'show':''; ?>" id="item<?php echo $idx; ?>">
                                <?php if(count($cat->subs) > 0){ ?>
                                     <?php  foreach ($cat->subs as $sub) { ?>
                                        <a href="<?php echo base_url('products/').$sub['subcat_name']."-".$sub['subcat_id']; ?>" class="list-group-item <?php echo ($subcate_id == $sub['subcat_id'])?'active':''; ?>">
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
            <!-- Product Categorie List Start -->
            <div class="col-lg-9 order-lg-2">
                <!-- Grid & List View Start -->
                <div class="grid-list-top border-default universal-padding fix mb-30">
                    <div class="grid-list-view f-left">
                       <h4>Products</h4>
                    </div>
                    <div class="grid-list-view f-right">
                        <ul class="list-inline nav">
                            <li><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                            <li><a  data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                        </ul>
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
                                                <a href="<?php echo base_url('product_details/'.$pro['id']); ?>">
                                                    <img class="primary-img" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$pro['product_image'];  ?>" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="javascript:;"><?php echo $pro['name']; ?></a></h4>
                                                 <p><span class="description"><?php echo $pro['description']; ?></span></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                    </div>
                                    <!-- Single Product End -->    
                                    <?php } ?>
                                <?php }else{ ?>
                                    <h4>Product not found.</h4>
                                <?php } ?>
                            </div>                                    
                                 <!-- <?php echo $pagination; ?> -->
                        </div>
                        <!-- #grid view End -->
                        <div id="list-view" class="tab-pane ">
                            <?php if(!empty($products)){ ?>
                                <?php foreach ($products as $pro) { ?>
                                <!-- Single Product Start -->
                                <div class="single-product">
                                    <!-- Product Image Start -->
                                    <div class="pro-img">
                                        <a href="<?php echo base_url('product_details/'.$pro['id']); ?>">
                                            <img class="primary-img" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$pro['product_image'];  ?>" alt="single-product">
                                            <img class="secondary-img" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$pro['product_image'];  ?>" alt="single-product">
                                        </a>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="pro-content">
                                        <h4><a href="javascript:;"><?php echo $pro['name']; ?></a></h4>
                                        <p><span class="price"><i class="fa fa-rupee">&nbsp;
                                        </i><?php echo $pro['price']; ?></span></p>
                                         <p><span class="description"><?php echo $pro['description']; ?></span></p>
                                          <div class="actions-secondary">
                                          <a class="add-cart" href="<?php echo base_url('product_details/'.$pro['id']); ?>" >view details</a>
                                </div>
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                                <!-- Single Product Start -->
                                <?php } ?>
                            <?php }else{ ?>
                                <h4>Product not found.</h4>
                            <?php } ?>
                            <!-- <?php echo $pagination; ?> -->
                                  
                        </div>
                        <!-- #list view End -->
                    </div>
                    <!-- Grid & List Main Area End -->
                </div>
                <?php if(!empty($pagination)){ ?>
                    <!--Breadcrumb and Page Show Start -->
                    <div class="pagination-box fix">
                        <ul class="blog-pagination ">
                            <?php echo $pagination; ?>
                        </ul>
                        <div class="toolbar-sorter-footer">
                        </div>
                    </div>
                    <!--Breadcrumb and Page Show End -->
                <?php } ?>
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