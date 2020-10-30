<style type="text/css">

  .datepicker table tr td.active, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active:hover {
    background-color: #67bd3c;
    background-image: -moz-linear-gradient(to bottom,#67bd3c,#67bd3c);
    background-image: -ms-linear-gradient(to bottom,#67bd3c,#67bd3c);
    background-image: -webkit-gradient(linear,0 0,0 100%,from(#67bd3c),to(#04c));
    background-image: -webkit-linear-gradient(to bottom,#67bd3c,#67bd3c);
    background-image: -o-linear-gradient(to bottom,#67bd3c,#67bd3c);
    background-image: linear-gradient(to bottom,#67bd3c,#67bd3c);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#08c', endColorstr='#0044cc', GradientType=0);
    border-color: #67bd3c #67bd3c #67bd3c;
    border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) rgba(0,0,0,.25);
    filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
    color: #fff;
    text-shadow: 0 -1px 0 rgba(0,0,0,.25);
}
</style>
<div class="main">
      <div class="container">
        <ul class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="active">Register</li>
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
            <h1>Create an account</h1>
            <div class="content-form-page">
              <div class="row">
                <div class="col-md-7 col-sm-7">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('register'); ?>">
                    <fieldset>
                      <div class="form-group">
                        <label for="sponsor_id" class="col-lg-4 control-label">Sponser ID <span class="require">*</span></label>
                        <div class="col-lg-8">
                           <input name="sponsor_id" class="form-control" autocomplete="off" id="sponsor_id" value="<?php echo set_value('sponsor_id'); ?>">
                           <?php echo form_error('sponsor_id'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="jointype" class="col-lg-4 control-label">Select Auto/Manual <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <select name="jointype" class="form-control">
                            <option value="auto">Auto</option>
                            <option value="manually">Manually</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group spill_id" style="display: none;">
                        <label for="spill_id" class="col-lg-4 control-label">Spill ID <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="text" name="spill_id"  class="form-control" autocomplete="off" id="spill_id" value="<?php echo set_value('spill_id'); ?>">
                          <?php echo form_error('spill_id'); ?>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <legend>Your personal details</legend>
                      <div class="form-group">
                        <label for="first_name" class="col-lg-4 control-label">First Name <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo set_value('first_name'); ?>">
                          <?php echo form_error('first_name'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="last_name" class="col-lg-4 control-label">Last Name <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo set_value('last_name'); ?>">
                          <?php echo form_error('last_name'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="col-lg-4 control-label">Email <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="text" name="email" class="form-control" id="email" value="<?php echo set_value('email'); ?>">
                          <?php echo form_error('email'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="gender" class="col-lg-4 control-label">Gender <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <select name="gender" class="form-control" id="gender">
                            <option value="">Select Gender</option>
                            <option <?= ($gender == 'Male') ? 'selected' : '' ; ?> value="Male">Male</option>
                            <option <?= ($gender == 'Female') ? 'selected' : '' ; ?> value="Female">Female</option>
                          </select>
                          <?php echo form_error('gender'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="dob" class="col-lg-4 control-label">Date of Birth <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="text" class="form-control" name="dob" id="dob" value="<?php echo set_value('dob'); ?>">
                          <?php echo form_error('dob'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="mobile_no" class="col-lg-4 control-label">Mobile Number <span class="require">*</span></label>
                        <div class="col-lg-8">
                         <input type="number" name="mobile_no"  id="mobile_no" class="form-control" autocomplete="off" value="<?php echo set_value('mobile_no'); ?>">
                         <?php echo form_error('mobile_no'); ?>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <legend>Your password</legend>
                      <div class="form-group">
                        <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="password" name="password" class="form-control" id="password" value="<?php echo set_value('password'); ?>">
                          <?php echo form_error('password'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirm_password" class="col-lg-4 control-label">Confirm password <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="password" name="confirm_password" class="form-control" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>">
                          <?php echo form_error('confirm_password'); ?>
                        </div>
                      </div>
                    </fieldset>
                     <fieldset>
                      <legend>Your Address</legend>
                      <div class="form-group">
                        <label for="address" class="col-lg-4 control-label">Address <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <textarea class="form-control"  name="address" rows="2" id="address"><?php echo set_value('address'); ?></textarea>
                          <?php echo form_error('address'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pincode" class="col-lg-4 control-label">Pincode <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="text" name="pincode" class="form-control" autocomplete="off" id="pincode" value="<?php echo set_value('pincode'); ?>">
                          <?php echo form_error('pincode'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="state" class="col-lg-4 control-label">State <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="text" name="state" class="form-control" autocomplete="off" id="state" value="<?php echo set_value('state'); ?>">
                          <?php echo form_error('state'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="city" class="col-lg-4 control-label">City <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="text" name="city" class="form-control" autocomplete="off" id="city" value="<?php echo set_value('city'); ?>">
                          <?php echo form_error('city'); ?>
                        </div>
                      </div>
                    </fieldset>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                        <button type="submit" class="btn btn-primary">Create an account</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2><em>Important</em> Information</h2>
                    <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip  commodo quat.</p>

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
    <script type="text/javascript">
      $(document).ready(function(){
        var jointype = "<?= $jointype; ?>";
        if(jointype == 'manually'){
          setTimeout(function(){$("select[name='jointype']").val(jointype).prop("selected",true).trigger('change'); }, 500);
        }
        $("select[name='jointype']").change(function(){
          var check_val = $(this).children("option:selected").val();
          if(check_val == 'manually')
          {
              $(".spill_id").css("display","block");
          }
          if(check_val == 'auto')
          {
              $(".spill_id").css("display","none");
          }
        });
      });
    </script>
    <script type="text/javascript">
      $(function(){
        
      
        //Date picker
        $('#dob').datepicker({
          autoclose: true
        })

      });
    </script>