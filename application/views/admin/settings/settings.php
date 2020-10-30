<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Settings
    </h1>
  </section>
  <!-- start add category form -->
  <section class="content">
    <div class="row">

        <div class="col-md-12">
          
          <div class="nav-tabs-custom" id="element_overlap1">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#general" data-toggle="tab">General Setting</a></li>
            <li ><a href="#social" data-toggle="tab">Social Setting</a></li>
            <li ><a href="#privacy_policy" data-toggle="tab">Privacy Policy</a></li>
            </ul>
            <div class="tab-content">
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
              <div class="active tab-pane" class="tab-pane" id="general">
                <form action="<?=base_url('admin/update-general-settings');?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo $this->m_general->getSetting('name'); ?>" class="form-control" autocomplete="off" placeholder="Name">
                        <?php echo form_error('name'); ?>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo $this->m_general->getSetting('email'); ?>" class="form-control" autocomplete="off" placeholder="Email">
                        <?php echo form_error('email'); ?>
                      </div>
                      <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="mobile_no" value="<?php echo $this->m_general->getSetting('mobile_no'); ?>" class="form-control" autocomplete="off" placeholder="Mobile">
                        <?php echo form_error('mobile_no'); ?>
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <textarea  name="address" class="form-control" placeholder="Address"><?php echo $this->m_general->getSetting('address'); ?></textarea>
                        <?php echo form_error('address'); ?>
                      </div>
                      <div class="form-group">
                        <label>Embed Map</label>
                        <textarea  name="embed_map" class="form-control" placeholder="Embed Map"><?php echo $this->m_general->getSetting('embed_map'); ?></textarea>
                        <?php echo form_error('embed_map'); ?>
                      </div>
                    </div> 
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <input type="submit" value="Update" class="btn btn-sm btn-primary">
                  </div>
                </form>
                <!-- END add Gallery form -->
              </div>
              <div class="tab-pane" id="social">
                <form action="<?=base_url('admin/social-settings');?>" method="post">
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" name="social_facebook" value="<?php echo $this->m_general->getSetting('social_facebook'); ?>" class="form-control" autocomplete="off" placeholder="Facebook">
                      </div>
                      <div class="form-group">
                        <label>Google Plus</label>
                        <input type="text" name="social_google_plus" value="<?php echo $this->m_general->getSetting('social_google_plus'); ?>" class="form-control" autocomplete="off" placeholder="Google Plus">
                      </div>
                      <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" name="social_twitter" value="<?php echo $this->m_general->getSetting('social_twitter'); ?>" class="form-control" autocomplete="off" placeholder="Twitter">
                      </div>
                      <div class="form-group">
                        <label>Youtube</label>
                        <input type="text" name="social_youtube" value="<?php echo $this->m_general->getSetting('social_youtube'); ?>" class="form-control" autocomplete="off" placeholder="Youtube">
                      </div>
                    </div> 
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <input type="submit" value="Update" class="btn btn-sm btn-primary">
                  </div>
                </form>
                <!-- END add Gallery form -->
              </div>
              <!-- /.tab-pane -->
               <div class="tab-pane" id="privacy_policy">
                <form action="<?=base_url('admin/privacy-policy');?>" method="post">
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Message</label>
                          <textarea name="privacy_policy" id="product_desc" class="form-control" placeholder="Privacy Policy" autocomplete="off"><?php echo $this->m_general->getSetting('privacy_policy'); ?></textarea>
                      </div>
                    </div> 
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <input type="submit" value="Update" class="btn btn-sm btn-primary">
                  </div>
                </form>
                <!-- END add Gallery form -->
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
  </section>    
  <!-- end add category form -->
</div>
<script src="<?=base_url('public');?>/components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    CKEDITOR.replace('product_desc');
      var date = new Date();
      date.setDate(date.getDate());
    });
</script>