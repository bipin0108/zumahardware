<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Category
       <div class="pull-right">
        <a href="<?=base_url('admin/category-list')?>" class="btn m-b-xs btn-sm btn-info btn-addon"><i class="fa fa-backward"></i> Back</a>
      </div>
    </h1>
  </section>
  <!-- start add category form -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
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
          <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/add-category') ?>">
            <div class="box-body">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Category Name">
                  <?php echo form_error('name'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label">Upload Image</label>
                    <input type="file" class="form-control" name="image" >
                    <?php if($this->session->flashdata('img_error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('img_error') ?></span>
                    </div>
                    <?php endif ?>
                        <?php echo form_error('image'); ?>
                </div> 
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-sm btn-primary">
            </div>
          </form>
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add category form -->
</div>