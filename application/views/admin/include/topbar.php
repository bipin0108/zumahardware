<?php
  $obj=&get_instance();
  $user=$obj->adminmodel->GetUserData();
?>
<header class="main-header">
  <a href="<?=base_url()?>" class="logo">
    <!-- <span class="logo-mini"><img width="48px" src="<?=base_url('public')?>/images/white_favicon.png">Admin</span> -->
    <span class="logo-mini"><img style="margin-top: 20px;" width="48px" src="<?=base_url('public')?>/images/white_favicon.png" ></span>
    <span class="logo-lg">Admin</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li><a href="<?= base_url(); ?>" target="_blank">Home</a></li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url('uploads/profiles/'.$user['profile_image']); ?>" class="user-image profileImgUrl" alt="User Image">
            <span class="hidden-xs NameEdt"><?= $user['first_name']." ".$user['last_name']; ?></span>
          </a>
          <ul class="dropdown-menu">  
            <li class="user-header">
              <img src="<?php echo base_url('uploads/profiles/'.$user['profile_image']); ?>" class="img-circle profileImgUrl" alt="User Image">
              <p>
                <span class="NameEdt"><?= $user['first_name']." ".$user['last_name'];?></span> 
                <br>
                <span>Admin</span>
              </p>
            </li>
            <!-- Menu Footer -->
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?=base_url('admin/profile');?>" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?=base_url('admin/logout');?>" class="btn btn-default btn-flat">Logout</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>