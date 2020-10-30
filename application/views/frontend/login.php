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
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="<?php echo ($page == 'login')? 'active' : '' ; ?> list-group-item clearfix"><a href="<?php echo base_url(); ?>login/"><i class="fa fa-angle-right"></i> Login</a></li>
              <li class="<?php echo ($page == 'register')? 'active' : '' ; ?> list-group-item clearfix"><a href="<?php echo base_url(); ?>register/"><i class="fa fa-angle-right"></i> Register</a></li>
              <li class="<?php echo ($page == 'forgot')? 'active' : '' ; ?> list-group-item clearfix"><a href="<?php echo base_url(); ?>forgot-password/"><i class="fa fa-angle-right"></i> Forgot Password</a></li>
            </ul>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
            <h1>Login</h1>
            <div class="content-form-page">
              <div class="row">
                <div class="col-md-7 col-sm-7">
                  <form class="form-horizontal form-without-legend" role="form" method="post" action="<?=base_url('login/')?>">
                    <div class="form-group">
                      <label for="username" class="col-lg-4 control-label">Username <span class="require">*</span></label>
                      <div class="col-lg-8">
                        <input type="text" name="username" class="form-control" id="username" value="<?php echo set_value('username'); ?>">
                        <?php echo form_error('username'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                      <div class="col-lg-8">
                        <input type="password" name="password" class="form-control" id="password" value="<?php echo set_value('password'); ?>">
                        <?php echo form_error('password'); ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0">
                        <a href="<?=base_url('forgot-password/')?>">Forget Password?</a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                        <button type="submit" class="btn btn-primary">Login</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2><em>Important</em> Information</h2>
                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

                    <button type="button" class="btn btn-default">More details</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>