<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('admin/include/header');?>
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper"> 
  <?php $this->load->view('admin/include/topbar');?>
  <?php $this->load->view('admin/include/sidebar');?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Profile Settings</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3" >
          <!-- Profile Image -->
          <div class="box box-primary" id="element_overlap">
            <div class="box-body box-profile">
            <?php
              $obj=&get_instance();
              $user=$obj->adminmodel->GetUserData();
            ?>
              <img class="profile-user-img img-responsive img-circle profileImgUrl"  style="height: 100px;" src="<?php echo base_url('uploads/profiles/'.$user['profile_image']); ?>" alt="<?=$user['id'];?>">
              <h3 class="profile-username text-center NameEdt"><?=$user['first_name']." ".$user['last_name'];?></h3>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom" id="element_overlap1">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">General Details</a></li>
               <li><a href="#pwd" data-toggle="tab">Change Password</a></li>
               <li><a href="#profileimage" data-toggle="tab">Change Profile Image</a></li>
            </ul>
            <div class="tab-content">
              <!-- update profile image -->
              <div class="tab-pane" id="profileimage">
                <?php if(!empty($this->session->flashdata('img_success'))): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <span> <?php echo $this->session->flashdata('img_success'); ?> </span>
                  </div>
                  <?php endif ?>
                  <?php if($this->session->flashdata('img_error')): ?>
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <span><?php echo $this->session->flashdata('img_error') ?></span>
                  </div>

                  <?php endif ?>
                  <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php  echo base_url('admin/upload-profile'); ?>">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <div class="row">
                      <div class="col-sm-offset-2 col-sm-10">
                          <?php 
                            $p_img = $user['profile_image'];
                            if($p_img != '' OR $p_img != null)
                            {
                              $img_src = base_url('uploads/profiles/').$p_img;
                            }
                            else
                            {
                              $img_src = base_url()."public/images/2.png";
                            }
                          ?>
                          <img class="img-responsive" style="max-height: 100px;" src="<?php echo $img_src; ?>" alt="<?=$user['id'];?>">
                      </div>
                      <div class="col-sm-12">
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Upload Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" name="avatar_img" >
                            </div>
                          </div>
                         <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-sm btn-primary">Update Image</button>
                              <a href="<?php echo base_url('admin/profile'); ?>" type=button class="btn btn-sm btn-default">Cancel</a>
                            </div>  
                          </div>
                      </div>
                    </div>
                  </form>
              </div>
              <!-- update data -->
              <div class="active tab-pane" id="activity">
                <?php if(!empty($this->session->flashdata('success'))): ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span> <?php echo $this->session->flashdata('success'); ?> </span>
                </div>
                <?php endif ?> 
               
                <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span><?php echo $this->session->flashdata('error') ?></span>
                </div>
                <?php endif ?>

                <!-- <form class="form-horizontal UpdateDetails"> -->
                <form role="form" class="form-horizontal" method="post" action="<?php  echo base_url('admin/profile-details-update'); ?>">
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">UserID</label>
                     <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$user['username']?>" disabled>
                      <input type="hidden" class="form-control" name="id" value="<?=$user['id']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Name</label>
                     <div class="col-sm-5">
                      <input type="text" class="form-control" name="first_name" value="<?=$user['first_name']?>" placeholder="First Name">
                      <?php echo form_error('first_name'); ?>
                    </div>
                    
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="last_name" value="<?=$user['last_name']?>" placeholder="Last Name">
                      <?php echo form_error('last_name'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                     <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" value="<?=$user['email']?>" placeholder="Email">
                      <?php echo form_error('email'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-sm-2">Gender</label>
                      <div class="col-sm-10">
                        <select name="gender" class="form-control">
                            <?php $gen = $user['gender']; ?>
                            <option value="Male" <?php if($gen == "Male"){echo "selected";} ?> >Male</option>
                            <option value="Female" <?php if($gen == "Female"){echo "selected";} ?> >Female</option>
                        </select>
                        <?php echo form_error('gender'); ?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Date of Birth</label>
                      <div class="col-sm-10">
                      <input type="date" class="form-control" name="dob" value="<?= $user['dob']; ?>" placeholder="Date of Birth">
                      <?php echo form_error('dob'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Mobile No.</label>
                     <div class="col-sm-10">
                      <input type="number" class="form-control" name="mobile_no" value="<?=$user['mobile_no']?>" placeholder="Mobile No.">
                      <?php echo form_error('mobile_no'); ?>
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="address" placeholder="Address"><?=$user['address']?></textarea>
                      <?php echo form_error('address'); ?>
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Pincode</label>
                     <div class="col-sm-10">
                      <input type="number" class="form-control" name="pincode" value="<?=$user['pincode']?>" placeholder="Pincode">
                      <?php echo form_error('pincode'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">City</label>
                     <div class="col-sm-10">
                      <input type="text" class="form-control" name="city" value="<?=$user['city']?>" placeholder="City">
                      <?php echo form_error('city'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">State</label>
                     <div class="col-sm-10">
                      <input type="text" class="form-control" name="state" value="<?=$user['state']?>" placeholder="State">
                      <?php echo form_error('state'); ?>
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-sm btn-primary">Update</button>
                      <a href="<?php echo base_url('admin/profile'); ?>" type=button class="btn btn-sm btn-default">Cancel</a>
                    </div>  
                  </div>
                </form>
              </div>
              <!-- CHANGE PASSWORD TAB -->
              <div class="tab-pane" id="pwd">
                <?php if(!empty($this->session->flashdata('pwd_success'))): ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span> <?php echo $this->session->flashdata('pwd_success'); ?> </span>
                </div>
                <?php endif ?>
                <?php if($this->session->flashdata('pwd_error')): ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span><?php echo $this->session->flashdata('pwd_error') ?></span>
                </div>
                <?php endif ?>
                <form role="form" class="form-horizontal" method="post" action="<?php  echo base_url('admin/update-password'); ?>">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Old Password</label>
                        <div class="col-sm-10">
                          <input name="old_pwd" type="password" class="form-control" placeholder="Old Password">
                          <?php echo form_error('old_pwd'); ?> 
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-10">
                          <input name="new_pwd" type="password" class="form-control" placeholder="New Password"> 
                          <?php echo form_error('new_pwd'); ?>
                        </div>  
                        
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input name="confirm_pwd" type="password" class="form-control" placeholder="Confirm Password">
                          <?php echo form_error('confirm_pwd'); ?>
                        </div> 
                        
                    </div>                                                                                                             
                   <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        <a href="<?php  echo base_url('admin/profile'); ?>" type=button class="btn btn-sm btn-default">Cancel</a>
                    </div>
                  </div>
                </form>
              </div>
              <!-- END CHANGE PASSWORD TAB -->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->
<?php $this->load->view('admin/include/footer');?>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay.min.js"></script>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
</body>
</html>
