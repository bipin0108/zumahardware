<div class="content-wrapper">
	  <!-- Main content -->
	  <!-- /.content -->
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
							<h3><?php echo $this->d_dashboardmodel->pending_orders(); ?></h3>
							<h4>Pending Orders</h4>
						</div>
						
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						 <a href="<?php echo base_url('distributor/pending-order'); ?>" class="small-box-footer">Pending Orders<i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo $this->d_dashboardmodel->confirmed_orders(); ?></h3>
					<h4>Confirm Orders</h4>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
					 <a href="<?php echo base_url('distributor/confirm-order'); ?>" class="small-box-footer">Confirm Orders<i class="fa fa-arrow-circle-right"></i></a>
			</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $this->d_dashboardmodel->delivered_orders(); ?></h3>
						<h4>Delivered Order</h4>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					 <a href="<?php echo base_url('distributor/delivered-order'); ?>" class="small-box-footer">Delivered Orders<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $this->d_dashboardmodel->completed_orders(); ?></h3>
						<h4>Complete Order</h4>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
						 <a href="<?php echo base_url('distributor/order-list'); ?>" class="small-box-footer">Complete Orders<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</section>
</div>
