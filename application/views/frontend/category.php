<?php 
$obj=&get_instance();
$Category = $obj->homemodel->all_category();
?>
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
<style type="text/css">
  .pro-img{
    width:240px;
    height:200px;
  }
</style>
<!-- Breadcrumb Start -->
<div class="breadcrumb-area ptb-45 ptb-sm-30">
	<div class="container">
		<div class="breadcrumb">
			<ul>
				<li><a href="<?php echo base_url(); ?>">Home</a></li>
				<li class="active"><a href="javascript:;">Category</a></li>
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
			<div class="col-lg-12 order-lg-2">
				<div class="main-categorie">
					<!-- Grid & List Main Area End -->
					<div class="tab-content fix">
						<div id="grid-view" class="tab-pane active">
							<div class="row">
							<?php if(!empty($Category)){ ?>
								<?php foreach ($Category as $cat) {  ?>
								<div class="col-lg-3 col-sm-6" style="top: -20px;">
									<div class="single-product">								
										<div class="pro-img">
											<a href="<?php echo base_url('category/'.$cat->slug); ?>">
												<img class="primary-img pro-img" src="<?php echo IMAGE_URL.'categories/'.$cat->image; ?>" alt="single-product" style="height: 210px;">
											</a>
										</div>
										<?php 
											$cat_name = strip_tags($cat->name);
											if (strlen($cat_name) > 30) {

											    // truncate string
											    $stringCut = substr($cat_name, 0, 30);
											    $endPoint = strrpos($stringCut, ' ');

											    //if the string doesn't contain any space then it will cut without word basis.
											    $cat_name = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
											    $cat_name .= '...';
											}
										?>
										<div class="pro-content" style="margin-left: 1px;">
											<h4 style="margin-top: 20px;"><a href="javascript:;"><?php echo $cat_name; ?></a></h4>
										</div>
									</div>
								</div>
								<!-- Single Product End --> 
								<?php } ?>
								<?php }else{ ?>
								<h4>Product not found.</h4>
								<?php } ?>
							</div> 
						</div>
					</div>
				</div>
				<?php if(!empty($pagination)){ ?>
					<div class="pagination-box fix">
						<ul class="blog-pagination ">
							<?php echo $pagination; ?>
						</ul>
						<div class="toolbar-sorter-footer">
						</div>
					</div>
				<?php } ?>
			</div>
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
