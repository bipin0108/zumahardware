<?php
$obj=&get_instance();
$products=$this->homemodel->get_all_pro();
$hot_products=$this->homemodel->get_all_hot_products();
?>
<?php $this->load->view('frontend/include/slider'); ?>
<style type="text/css">
  .pro-img{
    width:240px;
    height:200px;
  }
</style>
 <!-- Banner Start -->
<div class="upper-banner banner pb-60">
    <div class="container">
        <h3>FROM THE DESK OF CHAIRMAN</h3>
        <br/>
        <div class="about-content">
          <p>The Journey has started few years ago with beginning at Surat, Gujarat.
            <br/>
            <br/>
            ZUMA CORPORATION The Supplier & Creators of “ZUMA brand which 
          reflects the meaning of Professional, Quality, Services and Satisfactions.
          I take this opportunity to thank our valued customers, whose continued 
          patronage and confidence in our products inspires us to extend the best 
          of services and enables us to provide value for their money.</p><br/>

          <p>We are committed to total customer satisfaction by identifying their 
          specific needs, translating them into Quality products and providing 
          dependable after-sales-services. This commitment is the corner stone of 
          our Quality Policy and we strive to achieve it by putting into place 
          a Quality System,</p><br/>

          <p>Yes, We are one of the leading supplier in the field of premium quality
          hardware products, mainly we focus on Drawer Channel, Tandem 
          System, Kitchen solution, Hydraulic lifter, Glass Fittings, Door Closer,
          Sliding Fitting, Aluminum profiles, Lockbody, Cylinder, Mortice Handle,
          Auto Hinges, Cabinet Handle, etc “ZUMA” furniture fitting are available
          in many size, many ranges and many patterns to cater the needs of Our
          valuable clients and consumers. After gaining vast experience and 
          knowledge we have learned to take the change as a challenge with 
          new concept, new spirit and fresh new approach</p><br/>

         <p> ZUMA CORPORATION the owner of “ZUMA” brand supported by strong
          marketing networks, is on its way to conquer the national and inter-
          national markets.
         </p>
        </div>
    </div>
    <!-- Container End -->
</div>                                
<!-- Banner End -->
<!-- Best Products Start -->
<div class="best-seller-product">
    <div class="container">
        <div class="group-title">
            <h2>NEW ARRIVALS</h2>
        </div>
        <!-- Best Product Activation Start -->
        <div class="hand-tool-active owl-carousel">
            <!-- Single Product Start -->
        <?php foreach ($products as $pro) { 
          $category = $this->homemodel->get_category_by_id($pro->category);
          $subcategory = $this->homemodel->get_subcategory_by_id($pro->subcategory);
        ?>
            <div class="single-product">
                <!-- Product Image Start -->
               <div class="pro-img">
                    <a href="<?php echo base_url('zuma-product/'.$category['slug'].'/'.$subcategory->slug.'/'.$pro->slug); ?>">
                      <?php $img_arr = explode(',',$pro->product_image) ?>
                      <img class="primary-img pro-img" src="<?php echo  IMAGE_URL.'products/product_images/thumbnail/'.$img_arr[0];  ?>" alt="single-product">
                      <?php if(isset($img_arr[1])){ ?> 
                        <img class="secondary-img pro-img" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$img_arr[1];  ?>" alt="single-product">
                      <?php } ?>
                   </a>
                </div>
                <!-- Product Image End -->
                <!-- Product Content Start -->
                <?php 
                  $pro_name = strip_tags($pro->name);
                  if (strlen($pro_name) > 30) {

                      // truncate string
                      $stringCut = substr($pro_name, 0, 30);
                      $endPoint = strrpos($stringCut, ' ');

                      //if the string doesn't contain any space then it will cut without word basis.
                      $pro_name = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                      $pro_name .= '...';
                  }
                ?>
                <div class="pro-content">
                  <h4>
                     <a href="<?php echo base_url('zuma-product/'.$category['slug'].'/'.$subcategory->slug.'/'.$pro->slug); ?>" ><b><?php echo $pro->code; ?></b></a><br>
                   <a href="<?php echo base_url('zuma-product/'.$category['slug'].'/'.$subcategory->slug.'/'.$pro->slug); ?>"><?php echo $pro_name; ?></a>
                 </h4>
                </div>
                <!-- Product Content End -->
            </div> 
            <?php } ?> 
        <!-- Best Product Activation End -->
    </div>
    <!-- Container End -->
</div><br>
<!-- Best Product End -->  
<div class="best-seller-product">
  <div class="container">
      <div class="group-title">
          <h2>HOT PRODUCTS</h2>
      </div>
      <!-- Best Product Activation Start -->
      <div class="hand-tool-active owl-carousel">
      <!-- Single Product Start -->
      <?php foreach ($hot_products as $products) { 
          $category = $this->homemodel->get_category_by_id($products->category);
          $subcategory = $this->homemodel->get_subcategory_by_id($products->subcategory);
      ?>
        <div class="single-product">
            <!-- Product Image Start -->
           <div class="pro-img">
                <a href="<?php echo base_url('zuma-product/'.$category['slug'].'/'.$subcategory->slug.'/'.$products->slug); ?>">
                    <?php $img_arr = explode(',',$products->product_image) ?>
                    <img class="primary-img pro-img" src="<?php echo  IMAGE_URL.'products/product_images/thumbnail/'.$img_arr[0];  ?>" alt="single-product">
                    <?php if(isset($img_arr[1])){ ?> 
                      <img class="secondary-img pro-img" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$img_arr[1];  ?>" alt="single-product">
                    <?php } ?>
               </a>
            </div>
            <!-- Product Image End -->
            <!-- Product Content Start -->
            <?php 
              $products_name = strip_tags($products->name);
              if (strlen($products_name) > 30) {

                  // truncate string
                  $stringCut = substr($products_name, 0, 30);
                  $endPoint = strrpos($stringCut, ' ');

                  //if the string doesn't contain any space then it will cut without word basis.
                  $products_name = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                  $products_name .= '...';
              }
            ?>
            <div class="pro-content">
               <h4>
                 <a href="<?php echo base_url('zuma-product/'.$category['slug'].'/'.$subcategory->slug.'/'.$products->slug); ?>" ><b ><?php echo $products->code; ?></b></a><br>
                <a href="<?php echo base_url('zuma-product/'.$category['slug'].'/'.$subcategory->slug.'/'.$products->slug); ?>"><?php echo $products_name; ?></a>
                </h4>
            </div>
            <!-- Product Content End -->
        </div> 
      <?php } ?> 
      <!-- Best Product Activation End -->
  </div><br>
  <!-- Container End -->
</div>
      
