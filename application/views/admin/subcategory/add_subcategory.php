<?php
$cat_id = $this->uri->segment(3);
$obj=&get_instance();
$category=$obj->categorymodel->dropdowncate(); 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Subcategory
       <div class="pull-right">
        <a href="<?=base_url('admin/subcategory-list')?>" class="btn m-b-xs btn-sm btn-info btn-addon"><i class="fa fa-backward"></i> Back</a>
      </div>
    </h1>
  </section>
  <!-- start add category form -->
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
          <!-- START add Subcategory form -->
          <?php echo form_open_multipart('admin/add-subcategory'); ?>
            <div class="box-body">
              <input type="hidden" name="subcat_parentid" value="<?php echo $subcat_parentid; ?>">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="subcat_name" value="<?php echo set_value('subcat_name')?>" class="form-control" placeholder="Name" autocomplete="off">
                    <?php echo form_error('subcat_name'); ?>
                </div>
              </div> 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-sm btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add Subcategory form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add category form -->
</div>
