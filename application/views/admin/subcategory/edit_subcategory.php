<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Subcategory
       <div class="pull-right">
        <a href="<?=base_url('admin/subcategory-list/'.$cat_id)?>" class="btn m-b-xs btn-sm btn-info btn-addon"><i class="fa fa-backward"></i> Back</a>
      </div>
    </h1>
  </section>
  <!-- start add category form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit</h3>
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
          <!-- START add subcategory form -->
          <?php echo form_open_multipart('admin/update-subcategory'); ?>
            <div class="box-body">
              <div class="col-md-6">
                <input type="hidden" name="subcat_id" value="<?php echo $subcat_id; ?>" >
                <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" >
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="subcat_name" value="<?php echo $subcategory->subcat_name; ?>" class="form-control" placeholder="subcat_name" autocomplete="off">
                    <?php echo form_error('subcat_name'); ?>
                </div>
              </div> 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Update" class="btn btn-sm btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add subcategory form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add category form -->
</div>