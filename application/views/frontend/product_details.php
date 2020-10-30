<?php 
 $obj=&get_instance();
 $product_name=$this->uri->segment(4);
 $product_id=$obj->homemodel->get_productid_by_slug($product_name);
 $products=$obj->homemodel->get_product_by_id($product_id);

 $attribute = $obj->homemodel->get_att_by_productid($product_id);
 $category_slug = $this->uri->segment(2);
 $category_name = $obj->homemodel->get_catname_slug($category_slug);

 $subcategory_slug = $this->uri->segment(3);
 $subcategory_name = $obj->homemodel->get_subcatname_slug($subcategory_slug);
?>
<!-- <link rel='stylesheet' href='<?php echo SITE_URL; ?>css/main.css'> -->
<link rel="stylesheet" href="<?=base_url('public');?>/dist/css/jquery.magnify.css">
<link rel="stylesheet" href="<?=base_url('public');?>/dist/css/zoom.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #01a8dc;
  color: white;
}
</style>
<style>

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/
.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */
.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

</style>
<style type="text/css">
  .pro-img{
    width:400px;
    height:100px;
  }
</style>
<div class="breadcrumb-area ptb-45 ptb-sm-30">
  <div class="container">
      <div class="breadcrumb">
          <ul>
              <li><a href="<?php echo base_url(); ?>">Home</a></li>
              <li><a href="<?php echo base_url('product/'.$category_slug.'/'.$subcategory_slug.'/product-list/'); ?>"> <?php echo $subcategory_name; ?> </a></li>
              <li class="active"><a href="javascript:;"> <?php echo ucfirst($products['name']); ?> </a></li>
          </ul>
      </div>
  </div>
  <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<div class="main-product-thumbnail pb-60" >
  <div class="container">
    <div class="row">
        <!-- Main Thumbnail Image Start -->
        <div class="col-lg-5">
          <div class="col-lg-12">
              <!-- Thumbnail Large Image start -->
              <div class="row tab-content">
                  <?php $images=explode(',', $products['product_image']); 
                      ?>
                  <?php foreach ($images as $key => $values) { ?>
                  <div id="thumb<?php echo $key; ?>" class="tab-pane <?php echo($key == 0)?'active':'';?>">
                    <div class="tiles">
                       <a data-magnify="gallery" data-caption=" " href="<?php echo IMAGE_URL.'products/product_images/original/'.$values; ?>"> 
                        <img style="width: 100%;height: 350px;" data-scale="2.4" src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$values; ?>" >
                      </a>
                    </div>
                  </div>
                  <?php } ?>
              </div>
              <br>
            <!-- Thumbnail Large Image End -->
          </div>
          <div class="product-thumbnail">
            <div class="thumb-menu nav">
                <?php $images=explode(',', $products['product_image']); 
                ?>
                <?php foreach ($images as $key => $values) { ?>
                  <a class="<?php echo($key == 0)?'active':'';?>" data-toggle="tab" href="#thumb<?php echo $key; ?>"> <img src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$values; ?>"   alt="product-thumbnail" onclick="openModal();currentSlide(1)" class="hover-shadow cursor pro-img"></a>
                <?php } ?>
            </div>
          </div>
        </div>
      <!-- Main Thumbnail Image End -->
      <!-- Thumbnail Description Start -->
      <div class="col-lg-7">
        <div class="thubnail-desc fix mb-10">
          <h2 class="product-header" style="color: #01a8dc;"><?php echo $products['name']; ?></h2>
        </div>
        <div class="pro-ref mb-5">
          <p>
            <span class="in-stock">Product Code : </span><span class="sku"><?php echo $products['code']; ?></span>
          </p>
        </div>
        <div class="pro-ref mb-5">
          <p>
            <span class="in-stock">Category : </span><span class="sku"><?php echo $category_name; ?></span>
          </p>
        </div>
        <div class="pro-ref mb-5">
          <p>
            <span class="in-stock">Sub category : </span><span class="sku"><?php echo $subcategory_name; ?></span>
          </p>
        </div>
        <div class="product-link"></div>
        <div class="pro-ref mb-5">
          <div class="group-title" style="height: 34px;">
            <div>
                <h2 style="margin-left: -20px;">Description</h2>
            </div>
          </div>
        </div>
        <div class=" col-lg-12">
          <p class="ptb-20" style="white-space: pre-wrap;">
           <?php echo trim($products['description']);?>
          </p>
        </div><br>

        <?php if (!empty($products['about_product'])) {?>
        <!--  <div class="pro-ref mb-5">
          <div class="group-title" style="height: 34px;">
            <div>
                <h2 style="margin-left: -20px;">About Product</h2>
            </div>
          </div>
        </div> -->
        <div class=" col-lg-12">
         <table border="1" id="customers">        
            <?php $about_product = json_decode($products['about_product'],true);  ?>

            <?php foreach ($about_product as $key => $value) { ?>
                <tr>
                  <td><?php echo $key; ?></td> 
                  <td><?php echo $value; ?></td>
                </tr>
            <?php } ?>
         </table>
        </div><br>
      <?php } ?>
      </div>
      <!-- Thumbnail Description End -->
    </div>
    <div class="product-link"></div>
    <!-- Row End -->
  </div>
  <!-- Container End -->
</div>
<!-- Product Thumbnail End -->
        
<div class="thumnail-desc pb-60">
  <div class="container">       
	<?php if( (!empty($products['installation_guide_images'])) OR (!empty($products['installation_guide_videos'])) ) {  ?>  
    <div class="row" >
          <!-- Product Thumbnail Description Start -->
        <div class="col-sm-12">
           <div class="group-title">
              <div >
                  <h2>Installation Guide</h2>
              </div>
            </div>
          <br>
            <ul class="main-thumb-desc nav">
                <?php if(!empty($products['installation_guide_images'])){ ?>
                <li><a class="active" data-toggle="tab" href="#dtail">Guide Images</a></li>
                <?php } ?> 
                  <?php if(!empty($products['installation_guide_videos'])){ ?>     
                    <li><a data-toggle="tab" href="#review">Guide Videos</a></li>
                  <?php } ?>
            </ul>
            <!-- Product Thumbnail Tab Content Start -->
            <?php if(!empty($products['installation_guide_images'])){ ?>
            <div class="tab-content thumb-content border-default" style="background-color: white;">
                <div id="dtail" class="tab-pane in active">
                  <!-- start -->
                  <div id="grid-view" class="tab-pane active">
                    <div class="row">
                    <?php $images=explode(',', $products['installation_guide_images']); 
                    ?>
                    <?php foreach ($images as $key => $values) { ?>
                      <div >                    
                        <div class="single-product" >
                          <a data-magnify="gallery" data-caption=" " href="<?php echo IMAGE_URL.'products/products_multiple/original/'.$values; ?>"> 
                            <img src="<?php echo IMAGE_URL.'products/products_multiple/thumbnail/'.$values; ?>" style="width: 145px;height: 145px;">
                          </a>
                        </div>
                      </div>
                    <?php } ?> 
                   </div>
                  </div>
                  <!-- END -->
                </div>
                <?php } ?> 
                <?php if(!empty($products['installation_guide_videos'])){ ?>
                  <div id="review" class="tab-pane" style="background-color: white;">
                    <!-- Reviews Start -->
                    <video width="320" height="240" controls>
                      <source src="<?php echo IMAGE_URL.'products/product_video/'.$products['installation_guide_videos']; ?>" type="video/mp4">
                      Sorry, your browser doesn't support the video element.
                    </video>
                    <div>
                        <a href="<?php echo IMAGE_URL.'products/product_video/'.$products['installation_guide_videos']; ?>" class="btn btn-sm btn-primary" target="_blank">Play</a>
                    </div>
                    <!-- Reviews End -->
                  </div>
                <?php } ?> 
            </div>
            <!-- Product Thumbnail Tab Content End -->
        </div>
    </div>
	<?php } ?>
	<br> 
	<div class="group-title">
		<div>
			<h2>Give Your Valuable Review</h2>
		</div>
	</div>
	<?php if(!empty($this->session->flashdata('success'))): ?>
	  <div class="alert alert-success">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <span> <?php echo $this->session->flashdata('success'); ?> </span>
	  </div>
	<?php endif ?> 
	<?php if(!empty($this->session->flashdata('error'))): ?>
	  <div class="alert alert-danger">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <span> <?php echo $this->session->flashdata('error'); ?> </span>
	  </div>
	<?php endif ?> 
       <form class="rating col-md-12" id="contact-form" class="contact-form" action="<?php echo base_url('give-rate');?>" method="post">
          <div class="form-group row">
            <div class="col-md-2">
              <h6>Give Rating</h6>
            </div>
            <?php 
              $category = $this->uri->segment('2');
              $subcategory = $this->uri->segment('3');
              $products = $this->uri->segment('4');
            ?>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" value="<?php echo $category; ?>" name="category">
            <input type="hidden" value="<?php echo $subcategory; ?>" name="subcategory">
            <input type="hidden" value="<?php echo $products; ?>" name="products">
            <div class="col-md-6">
                <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                </fieldset>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6>Your Name </h6>
            </div>
            <div class="col-md-6">
              <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control" placeholder="Name">
			  <?php echo form_error('name'); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6>Designation </h6>
            </div>
            <div class="col-md-6">
             <!--  <input type="text" name="designation" class="form-control" placeholder="Designation"> -->
             <select class="form-control" name="designation">
				<option value="">Select Designation</option>
                <option value="dealer">Dealer</option>
                <option value="carpenter">Carpenter</option>
                <option value="architect">Architect</option>
                <option value="consumer">Consumer</option>
                <option value="contractor">Contractor</option>
             </select>
			 <?php echo form_error('designation'); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6>City</h6>
            </div>
            <div class="col-md-6">
              <input type="text" name="city" value="<?php echo set_value('city')?>" class="form-control" placeholder="City">
			  <?php echo form_error('city'); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6>Your Review</h6>
            </div>
            <div class="col-md-6">
              <textarea name="review" class="form-control" placeholder="Your Review"><?php echo set_value('review')?></textarea>
			  <?php echo form_error('review'); ?>
            </div>
          </div>
          <div class="form-group row">
			  <div class="col-md-2" ></div>
			  <div class="col-md-6">
				<div class="send-email">
					<input type="submit" value="Submit" class="submit">
				</div>
			  </div> 
			</div>
      </form> 
  </div>
  <!-- Container End -->
</div>
<div class="clearfix"></div>

 <script src="<?=base_url('public');?>/dist/js/jquery.magnify.js"></script>
  <script>
    $('[data-magnify]').magnify({
      headToolbar: [
        'close'
      ],
      initMaximized: true
    });
  </script>