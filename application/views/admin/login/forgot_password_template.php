<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Zuma corporation | Forgot</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?=base_url('public')?>/components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url('public')?>/components/font-awesome/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="<?=base_url('public')?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=base_url('public')?>/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" href="<?=base_url('public')?>/images/favicon.png" type="image/png" >
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url('admin/login/'); ?>"><img src="<?php echo base_url('public/images/logo.png'); ?>"></a>
      </div>
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
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Forgot Your Password</p>
        <form action="<?=base_url('admin/i-forgot-my-password');?>" method="post" class="UpdateDetails" id="element_overlap">
          <div class="form-group has-feedback">
           <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
            
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <?php echo form_error('email'); ?>
          </div>
          
          <div class="row">
            <div class="col-xs-6">
              <a href="<?=base_url('admin/login');?>">Back to login</a><br>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Forgot Password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

     
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <script src="<?=base_url('public')?>/components/jquery/jquery.min.js"></script>
    <script src="<?=base_url('public')?>/components/bootstrap/js/bootstrap.min.js"></script> 
  </body>
</html>

