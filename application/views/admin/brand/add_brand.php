<div class="content-wrapper">
  <section class="content-header">
    <h1>
     Brand Image
      <div class="pull-right">
        <a href="<?=base_url('admin/brand-list')?>" class="btn m-b-xs btn-sm btn-info btn-addon"><i class="fa fa-backward"></i> Back</a>
      </div>
    </h1>
  </section>
  <!-- start add Slider form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add</h3>
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
          <!-- START add Slider form -->
          <?php echo form_open_multipart('admin/add-brand'); ?>
            <div class="box-body"> 
              <div class="col-md-6">
                <div class="alert alert-warning" style="padding: 4px;">
                  <span>Please select Brand image with width 132px and height 84px. </span>
                </div>
                <div class="form-group">
                  <label class="control-label">Upload Brand Image</label>
                  <input type="file" class="form-control" name="slider_image">
                  <?php echo form_error('slider_image'); ?>
                  <?php if($this->session->flashdata('img_error')): ?>
                  <div class="alert alert-danger">
                      <span><?php echo $this->session->flashdata('img_error') ?></span>
                  </div>
                  <?php endif ?>
                </div>
              </div> 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" name="add" value="Save" class="btn btn-sm btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add Slider form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add Slider form -->
</div>
