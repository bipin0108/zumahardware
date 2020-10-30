<?php
  $obj=&get_instance();
  $user=$obj->adminmodel->GetUserData();
  $uid = $_SESSION[SESSION_ADMIN]['id'];
?>
<aside class="main-sidebar">
  <section class="sidebar">
    <?php $uri=$this->uri->segment(2); ?>
    <ul class="sidebar-menu" data-widget="tree">
      <!-- Dashboard -->
      
        <li class="<?php if($uri=='dashboard'){echo'active';}?>">
          <a href="<?=base_url('admin/dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
      <!-- Downline -->
      <!-- Category -->
        <li class="treeview <?php if($uri=='category-list'||$uri=='create-category'||$uri=='add-category'||$uri=='edit-category'||$uri=='subcategory-list'||$uri=='create-subcategory'||$uri=='edit-subcategory'){ echo 'active';}?>">
        <a href="#">
          <i class="fa fa-list-alt"></i> <span>Category</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li class="<?php if($uri=='create-category'||$uri=='edit-category'||$uri=='add-category'){echo'active';}?>"><a href="<?=base_url('admin/create-category');?>"><i class="fa fa-plus"></i>Create</a></li>
            <li class="<?php if($uri=='category-list'||$uri=='add-category'||$uri=='subcategory-list'||$uri=='create-subcategory'||$uri=='edit-subcategory'){ echo 'active';}?>"><a href="<?=base_url('admin/category-list');?>"><i class="fa fa-list"></i>List</a></li>
         </ul> 
      </li>

      <!-- Attribute -->
        <li class="treeview <?php if($uri=='attribute-list'||$uri=='create-attribute'||$uri=='add-attribute'||$uri=='edit-attribute'){ echo 'active';}?>">
        <a href="#">
          <i class="fa fa-tag"></i> <span>Product Attribute</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
           <li class="<?php if($uri=='create-attribute'||$uri=='edit-attribute' ||$uri=='add-attribute'){echo'active';}?>"><a href="<?=base_url('admin/create-attribute');?>"><i class="fa fa-plus"></i>Create</a></li>
            <li class="<?php if($uri=='attribute-list'||$uri=='add-attribute'){ echo 'active';}?>"><a href="<?=base_url('admin/attribute-list');?>"><i class="fa fa-list"></i>List</a></li>
         </ul> 
      </li>

       <!-- Product -->
        <li class="treeview <?php  if($uri=='product-list'||$uri=='create-product' || $uri=='add-product'||$uri=='edit-product' ||$uri=='product-details'){ echo 'active';}?>">
              <a href="#">
                <i class="fa fa-product-hunt"></i> <span>Product</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='create-product'|| $uri=='add-product'||$uri=='edit-product'){echo'active';}?>"><a href="<?=base_url('admin/create-product');?>"><i class="fa fa-plus"></i>Create</a></li>
            <li class="<?php if($uri=='product-list'||$uri=='product-details'){ echo 'active';}?>"><a href="<?=base_url('admin/product-list');?>"><i class="fa fa-list"></i>List</a></li>
          </ul> 
      </li>

      <!-- Order -->
       <li class="treeview <?php  if($uri=='order-list'||$uri=='distributor-order'||$uri=='pending-order'||$uri=='confirm-order'||$uri=='delivered-order' || $uri == 'completed-order'){ echo 'active';}?>">
              <a href="#">
                <i class="fa fa-shopping-cart"></i> <span>Order</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='order-list'){ echo 'active';}?>"><a href="<?=base_url('admin/order-list');?>"><i class="fa fa-list"></i>List</a></li>
            <li class="<?php if($uri=='distributor-order'){ echo 'active';}?>"><a href="<?=base_url('admin/distributor-order');?>"><i class="fa fa-list"></i>Distributor Order</a></li>
            <li class="<?php if($uri=='pending-order'){ echo 'active';}?>"><a href="<?=base_url('admin/pending-order');?>"><i class="fa fa-list"></i>Pending Order</a></li>
            <li class="<?php if($uri=='confirm-order'){ echo 'active';}?>"><a href="<?=base_url('admin/confirm-order');?>"><i class="fa fa-list"></i>Confirm Order</a></li>
            <li class="<?php if($uri=='delivered-order'){ echo 'active';}?>"><a href="<?=base_url('admin/delivered-order');?>"><i class="fa fa-list"></i>Delivered Order</a></li>
            <li class="<?php if($uri=='completed-order'){ echo 'active';}?>"><a href="<?=base_url('admin/completed-order');?>"><i class="fa fa-list"></i>Completed Order</a></li> 
          </ul> 
      </li>


    <!-- Report -->
     <li class="<?php if($uri=='order-report'){ echo 'active';}?>">
       <li class="<?php if($uri=='order-report'){ echo 'active';}?>">
        <a href="<?=base_url('admin/order-report');?>">
          <i class="fa fa-file"></i> <span>Report</span>
        </a>
      </li>
       

      <!-- Slider -->
      <li class="treeview <?php if($uri=='slider-list'||$uri=='create-slider'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-sliders"></i> <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='create-slider'){echo'active';}?>"><a href="<?=base_url('admin/create-slider');?>"><i class="fa fa-plus"></i>Create</a></li>
            <li class="<?php if($uri=='slider-list'){ echo 'active';}?>"><a href="<?=base_url('admin/slider-list');?>"><i class="fa fa-list"></i>List</a></li>
           </ul> 
        </li>
       

        <!-- Brand -->
      <li class="treeview <?php if($uri=='brand-list'||$uri=='create-brand' || $uri=='add-brand'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-sliders"></i> <span>Brand</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='create-brand'|| $uri=='add-brand'){echo'active';}?>"><a href="<?=base_url('admin/create-brand');?>"><i class="fa fa-plus"></i>Create</a></li>
            <li class="<?php if($uri=='brand-list'){ echo 'active';}?>"><a href="<?=base_url('admin/brand-list');?>"><i class="fa fa-list"></i>List</a></li>
          </ul> 
        </li>
        
        <!-- Start User -->
        <li class="treeview <?php if($uri=='user-list' ||$uri=='edit-user' || $uri=='add-user' || $uri=='create-user'){ echo 'active'; }?>">
        <a href="#">
        <i class="fa fa-user"></i> <span>Salesman</span>
        <span class="pull-right-container"> 
        <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <li class="<?php if($uri=='create-user'|| $uri=='add-user'|| $uri=='edit-user'){echo'active';}?>"><a href="<?=base_url('admin/create-user');?>"><i class="fa fa-plus"></i> Create</a></li>
        <li class="<?php if($uri=='user-list'){ echo 'active';}?>"><a href="<?=base_url('admin/user-list/all');?>"><i class="fa fa-list"></i>View</a></li>
        </ul> 
        </li>
        <!-- End User -->

        <!-- Distributor -->
        <li class="treeview <?php if($uri=='distributor-list' || $uri=='add-distributor'|| $uri=='edit-distributor' || $uri=='create-distributor'){ echo 'active'; }?>">
        <a href="#">
        <i class="fa fa-users"></i> <span>Distributor</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <li class="<?php if($uri=='create-distributor'|| $uri=='add-distributor'|| $uri=='edit-distributor'){echo'active';}?>"><a href="<?=base_url('admin/create-distributor');?>"><i class="fa fa-plus"></i> Create</a></li>
        <li class="<?php if($uri=='distributor-list'){ echo 'active';}?>"><a href="<?=base_url('admin/distributor-list');?>"><i class="fa fa-list"></i>View</a></li>
        </ul> 
        </li>
        <!-- Distributor -->

         <!-- Distributor -->
        <li class="treeview <?php if($uri=='create-dealer-offer' || $uri=='create-carpenter-offer' || $uri=='dealer-offer' || $uri=='carpenter-offer' || $uri=='add-dealer-offer' || $uri=='add-carpenter-offer' || $uri=='edit-dealer-offer' || $uri=='edit-carpenter-offer'){ echo 'active'; }?>">
        <a href="#">
        <i class="fa fa-gift"></i> <span>Offers</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <li class="<?php if($uri=='create-dealer-offer'|| $uri=='dealer-offer' || $uri=='add-dealer-offer' || $uri=='edit-dealer-offer'){echo'active';}?>"><a href="<?=base_url('admin/dealer-offer');?>"><i class="fa fa-list"></i> Dealer Offer</a></li>
        <li class="<?php if($uri=='create-carpenter-offer' || $uri=='carpenter-offer' || $uri=='add-carpenter-offer' || $uri=='edit-carpenter-offer'){ echo 'active';}?>"><a href="<?=base_url('admin/carpenter-offer');?>"><i class="fa fa-list"></i>Carpenter Offer</a></li>
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
            <li class="<?php if($uri=='pending-complaints'){ echo 'active';}?>"><a href="<?=base_url('admin/pending-complaints');?>"><i class="fa fa-list"></i>Pending complaints</a></li>
            <li class="<?php if($uri=='completed-complaints'){ echo 'active';}?>"><a href="<?=base_url('admin/completed-complaints');?>"><i class="fa fa-list"></i>Completed complaints</a></li> 
          </ul> 
      </li>

        <!-- Distributor -->
        
        <!-- inquiry -->
        <li class="<?php if($uri=='contactus-list'){ echo 'active';}?>">
        <a href="<?=base_url('admin/contactus-list');?>">
        <i class="fa fa-envelope"></i> <span>Inquiry</span>
        </a>
        </li>

         <!-- Transaction -->
        <li class="<?php if($uri=='translation-history'){ echo 'active';}?>">
        <a href="<?=base_url('admin/translation-history');?>">
        <i class="fa fa-exchange"></i> <span>Transaction History</span>
        </a>
        </li>

      <!-- Settings -->
     <li class="<?php if($uri=='sendmail'){ echo 'active';}?>">
       <li class="<?php if($uri=='settings'){ echo 'active';}?>">
        <a href="<?=base_url('admin/settings');?>">
          <i class="fa fa-cogs"></i> <span>Settings</span>
        </a>
      </li>

       <!-- Notification -->
     <li class="<?php if($uri=='notification'){ echo 'active';}?>">
       <li class="<?php if($uri=='notification'){ echo 'active';}?>">
        <a href="<?=base_url('admin/notification');?>">
          <i class="fa fa-bell"></i> <span>Notification</span>
        </a>
      </li>
    
       <!-- Logout -->
      <li>
        <a href="<?=base_url('admin/logout')?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
      </li>
    </ul>
  </section>
</aside>