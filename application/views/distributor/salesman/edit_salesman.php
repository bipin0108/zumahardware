<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Salesman
    </h1>
  </section>
  <!-- start add shop form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Salesman</h3>
          </div>
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
          <!-- START add shop form -->
          <?php echo form_open_multipart('distributor/update-salesman'); 
           $distributor_id = $this->session->userdata[SESSION_USER]['id'];
          ?>
            <div class="box-body">
              <input type="hidden" name="distributor_id" value="<?php echo $distributor_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>" >
                 <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?php echo $user['first_name'] ?>" class="form-control" placeholder="Firstname" autocomplete="off">
                    <?php echo form_error('first_name'); ?>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $user['last_name'] ?>" class="form-control" placeholder="Lastname" autocomplete="off">
                    <?php echo form_error('last_name'); ?>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $user['email'] ?>" class="form-control" placeholder="Email" autocomplete="off">
                    <?php echo form_error('email'); ?>
                </div>
                 <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" value="<?php echo $user['password'] ?>" class="form-control" placeholder="Password" autocomplete="off">
                    <?php echo form_error('password'); ?>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile_no" value="<?php echo $user['mobile_no'] ?>" class="form-control" placeholder="Mobile Number" autocomplete="off"><?php echo form_error('mobile_no'); ?>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" autocomplete="off" ><?php echo $user['address'] ?></textarea>
                    <?php echo form_error('address'); ?>
                </div>
                <div class="form-group">
                    <label>Aadhar Number</label>
                    <input type="text" name="aadhar_no" value="<?php echo $user['aadhar_no'] ?>" class="form-control" placeholder="Aadhar Number" autocomplete="off"><?php echo form_error('aadhar_no'); ?>
                </div>
                <div class="form-group">
                  <label class="control-label">Upload Image</label>
                  <input type="file" class="form-control" name="image" >
                  <?php if($this->session->flashdata('img_error')){ ?>
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <span><?php echo $this->session->flashdata('img_error') ?></span>
                  </div>
                  <?php } ?>
                  <img src="<?php echo UPLOAD_PATH."user/".$user['image']; ?>" style="height:70px;"/>
                </div>   
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Update" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add shop form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add shop form -->
</div>
