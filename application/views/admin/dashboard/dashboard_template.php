<style>
.info-box-content {
    padding: 5px 10px;
    margin-left: 0px;
}
</style>

<div class="content-wrapper">
	  <!-- Main content -->
	<section class="content-header">
		<h1>
		  Dashboard
		  <small>Control panel</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $this->a_dashboardmodel->pending_orders(); ?></h3>
						<h4>Pending Orders</h4>
					</div>
					<div class="icon" style="margin-top:16px;">
						<i class="ion ion-bag"></i>
					</div>
					<a href="#" class="small-box-footer"></a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo $this->a_dashboardmodel->confirm_orders(); ?></h3>
						<h4>Confirmed Orders</h4>
					</div>
					<div class="icon"  style="margin-top:16px;">
						<i class="ion ion-bag"></i>
					</div>
					<a href="#" class="small-box-footer"></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $this->a_dashboardmodel->delivered_orders(); ?></h3>
						<h4>Delivered Order</h4>
					</div>
					<div class="icon"  style="margin-top:16px;">
						<i class="ion ion-bag"></i>
					</div>
					 <a href="#" class="small-box-footer"></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $this->a_dashboardmodel->completed_orders(); ?></h3>
						<h4>Completed Order</h4>
					</div>
					<div class="icon"  style="margin-top:16px;">
						<i class="ion ion-bag"></i>
					</div>
					<a href="#" class="small-box-footer"></a>
				</div>
			</div>
		</div>
		<hr>
		<h4>Distributor Order</h4>
		<!-- distributor order -->
		<div class="row">
			<div class="col-md-4">
				<div class="small-box bg-blue">
					<div class="inner">
						<h4>Pending Orders
						<span class="pull-right" style="font-size:22px;">
							<b><?php echo $this->a_dashboardmodel->pending_orders_dis(); ?></b>
						</span>
						</h4>
					</div>
					<a href="<?php echo base_url('admin/pending-order'); ?>" class="small-box-footer">Pending Orders<i class="fa fa-arrow-circle-right"></i></a>
				</div>
				<!-- end box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h4>Confirmed Orders
						<span class="pull-right" style="font-size:22px;">
							<b><?php echo $this->a_dashboardmodel->confirm_orders_dis(); ?></b>
						</span>
						</h4>
					</div>
					<a href="<?php echo base_url('admin/confirm-order'); ?>" class="small-box-footer">Confirmed Orders<i class="fa fa-arrow-circle-right"></i></a>
				</div>
		         <!-- end box -->
		         <div class="small-box bg-red">
					<div class="inner">
						<h4>Delivered  Orders
						<span class="pull-right" style="font-size:22px;">
							<b><?php echo $this->a_dashboardmodel->delivered_orders_dis(); ?></b>
						</span>
						</h4>
					</div>
					<a href="<?php echo base_url('admin/delivered-order'); ?>" class="small-box-footer">Delivered  Orders<i class="fa fa-arrow-circle-right"></i></a>
				</div>
		         <!-- end box -->
		         <div class="small-box bg-green">
					<div class="inner">
						<h4>Completed  Orders
						<span class="pull-right" style="font-size:22px;">
							<b><?php echo $this->a_dashboardmodel->completed_orders_dis(); ?></b>
						</span>
						</h4>
					</div>
					<a href="<?php echo base_url('admin/completed-order'); ?>" class="small-box-footer">Completed  Orders<i class="fa fa-arrow-circle-right"></i></a>
				</div>
		         <!-- end box -->
			</div>
			<div class="col-md-8">
			</div>
		</div>	
		<!-- end -->
	</section>
</div>
