<?php $key=$this->uri->segment(2); ?>
<div class="main">
      <div class="container">
        <ul class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="active">Login</li>
        </ul>
        <?php if(!empty($this->session->flashdata('success'))): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
          <?php endif ?> 
         
          <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif ?>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          

          <!-- BEGIN CONTENT -->
          <div class="col-md-offset-3 col-md-9 col-sm-9">
            <h1>Reset your password</h1>
            <div class="content-form-page">
              <div class="row">
                <div class="col-md-7 col-sm-7">
                  <form class="form-horizontal form-without-legend" role="form" method="post" action="<?=base_url('reset-password/'.$key); ?>">
                    <div class="form-group">
                      <label for="temp_password" class="col-lg-4 control-label">Temp Password <span class="require">*</span></label>
                      <div class="col-lg-8">
                        <input type="password" name="temp_password" class="form-control" id="temp_password" value="<?php echo set_value('temp_password'); ?>">
                        <?php echo form_error('temp_password'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="new_password" class="col-lg-4 control-label">New Password <span class="require">*</span></label>
                      <div class="col-lg-8">
                        <input type="password" name="new_password" class="form-control" id="new_password" value="<?php echo set_value('new_password'); ?>">
                        <?php echo form_error('new_password'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="confirm_password" class="col-lg-4 control-label">Confirm Password <span class="require">*</span></label>
                      <div class="col-lg-8">
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>">
                        <?php echo form_error('confirm_password'); ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                        <button type="submit" class="btn btn-primary">Reset</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>