<?php
  $obj=&get_instance();
  $user=$obj->d_distributormodel->GetUserData();
?>
<aside class="main-sidebar">
  <section class="sidebar">
    <?php $uri=$this->uri->segment(2); ?>
    <ul class="sidebar-menu" data-widget="tree">
      <!-- Dashboard -->
        <li class="<?php if($uri=='dashboard'){echo'active';}?>">
          <a href="<?=base_url('distributor/dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
      <!-- Downline -->
      <!-- Start User -->
        <li class="treeview <?php if($uri=='dealer-list' || $uri=='create-dealer' || $uri=='add-dealer' || $uri=='edit-dealer'){ echo 'active'; }?>">
        <a href="#">
        <i class="fa fa-user"></i> <span>Dealer</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <li class="<?php if($uri=='create-dealer'|| $uri=='add-dealer' || $uri=='edit-dealer'){echo'active';}?>"><a href="<?=base_url('distributor/create-dealer');?>"><i class="fa fa-plus"></i> Create</a></li>
        <li class="<?php if($uri=='dealer-list'){ echo 'active';}?>"><a href="<?=base_url('distributor/dealer-list');?>"><i class="fa fa-list"></i>View</a></li>
        </ul> 
        </li>
        <!-- End User -->
        <li class="treeview <?php if($uri=='carpenter-list' || $uri=='add-carpenter'  || $uri=='edit-carpenter' || $uri=='create-carpenter'){ echo 'active'; }?>">
        <a href="#">
        <i class="fa fa-user"></i> <span>Carpenter</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <li class="<?php if($uri=='create-carpenter' || $uri=='add-carpenter' || $uri=='edit-carpenter'){echo'active';}?>"><a href="<?=base_url('distributor/create-carpenter');?>"><i class="fa fa-plus"></i> Create</a></li>
        <li class="<?php if($uri=='carpenter-list'){ echo 'active';}?>"><a href="<?=base_url('distributor/carpenter-list');?>"><i class="fa fa-list"></i>View</a></li>
        </ul> 
        </li>

        <li class="treeview <?php if($uri=='salesman-list' || $uri=='create-salesman' || $uri=='add-salesman'  || $uri=='edit-salesman'){ echo 'active'; }?>">
          <a href="#">
            <i class="fa fa-user"></i> <span>Salesman</span>
              <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='create-salesman' || $uri=='add-salesman' || $uri=='edit-salesman'){echo'active';}?>"><a href="<?=base_url('distributor/create-salesman');?>"><i class="fa fa-plus"></i> Create</a></li>
            <li class="<?php if($uri=='salesman-list'){ echo 'active';}?>"><a href="<?=base_url('distributor/salesman-list');?>"><i class="fa fa-list"></i>View</a></li>
          </ul> 
        </li>

        <!-- Place Order -->
      <li class="treeview <?php if($uri=='create-placeorder'){ echo 'active';}?>">
              <a href="#">
                <i class="fa fa-shopping-cart"></i> <span>Place Order</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='create-placeorder'){ echo 'active';}?>"><a href="<?=base_url('distributor/create-placeorder');?>"><i class="fa fa-list"></i>Create</a></li>
          </ul> 
      </li>

        <li class="treeview <?php if($uri=='order-list'||$uri=='my-order'||$uri=='pending-order'||$uri=='confirm-order'||$uri=='delivered-order' || $uri == 'completed-order'){ echo 'active';}?>">
              <a href="#">
                <i class="fa fa-shopping-cart"></i> <span>Order</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='my-order'){ echo 'active';}?>"><a href="<?=base_url('distributor/my-order');?>"><i class="fa fa-list"></i>My Order</a></li>
            <li class="<?php if($uri=='order-list'){ echo 'active';}?>"><a href="<?=base_url('distributor/order-list');?>"><i class="fa fa-list"></i>List Order</a></li>
            <li class="<?php if($uri=='pending-order'){ echo 'active';}?>"><a href="<?=base_url('distributor/pending-order');?>"><i class="fa fa-list"></i>Pending Order</a></li>
            <li class="<?php if($uri=='confirm-order'){ echo 'active';}?>"><a href="<?=base_url('distributor/confirm-order');?>"><i class="fa fa-list"></i>Confirm Order</a></li>
            <li class="<?php if($uri=='delivered-order'){ echo 'active';}?>"><a href="<?=base_url('distributor/delivered-order');?>"><i class="fa fa-list"></i>Delivered Order</a></li>
            <li class="<?php if($uri=='completed-order'){ echo 'active';}?>"><a href="<?=base_url('distributor/completed-order');?>"><i class="fa fa-list"></i>Completed Order</a></li> 
          </ul> 
      </li>

        <!-- complaints -->
       <li class="treeview <?php  if($uri=='pending-complaints'|| $uri == 'completed-complaints'){ echo 'active';}?>">
              <a href="#">
                <i class="fa fa-comment"></i> <span>complaints</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='pending-complaints'){ echo 'active';}?>"><a href="<?=base_url('distributor/pending-complaints');?>"><i class="fa fa-list"></i>Pending complaints</a></li>
            <li class="<?php if($uri=='completed-complaints'){ echo 'active';}?>"><a href="<?=base_url('distributor/completed-complaints');?>"><i class="fa fa-list"></i>Completed complaints</a></li> 
          </ul> 
      </li>

       <!-- Report -->
     <li class="<?php if($uri=='report'){ echo 'active';}?>">
       <li class="<?php if($uri=='report'){ echo 'active';}?>">
        <a href="<?=base_url('distributor/order-report');?>">
          <i class="fa fa-file"></i> <span>Report</span>
        </a>
      </li>

      <!-- Logout -->
      <li>
        <a href="<?=base_url('distributor/logout')?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
      </li>
    </ul>
  </section>
</aside>
<div class="clearfix"></div>