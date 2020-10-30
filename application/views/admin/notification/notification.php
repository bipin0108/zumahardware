<link rel="stylesheet" href="<?=base_url('public')?>/components/bootstrap-multiselect/css/bootstrap-multiselect.css" type="text/css">
<style>
.btn-default {
background-color: #f4f4f4;
color: #444;
border: 1px solid;
border-color: #ddd;
font-weight: normal;
}
</style> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Notification
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
            <h3 class="box-title">Send</h3>
          </div>
          <?php if(!empty($this->session->flashdata('success'))): ?>
           <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span><?php echo $this->session->flashdata('success'); ?></span>
           </div>
           <?php endif ?> 
           <?php if($this->session->flashdata('error')): ?>
           <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span><?php echo $this->session->flashdata('error') ?></span>
           </div>
         <?php endif ?>
          <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/send-notification') ?>">
            <div class="box-body">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Message</label>
                  <textarea  name="message" class="form-control" placeholder="message"><?php echo set_value('message') ?></textarea>
                  <?php echo form_error('message'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label">User type</label>
                    <select id="user_type" multiple="multiple" name="user_type[]" class="form-control">
                    <option <?php echo set_select('user_type[]','distributor', ( !empty($data) && $data == 'distributor' ? TRUE : FALSE )); ?> 
                    value="distributor">Distributor</option>
                    <option <?php echo set_select('user_type[]','dealer', ( !empty($data) && $data == 'dealer' ? TRUE : FALSE )); ?> 
                    value="dealer">Dealer</option>
                    <option <?php echo set_select('user_type[]','carpenter', ( !empty($data) && $data == 'carpenter' ? TRUE : FALSE )); ?> 
                    value="carpenter">Carpenter</option>
                    <option <?php echo set_select('user_type[]','salesman', ( !empty($data) && $data == 'salesman' ? TRUE : FALSE )); ?> 
                    value="salesman">Salesman</option>
                    </select>
                    <?php echo form_error('user_type[]'); ?>
                </div> 
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Send" class="btn btn-sm btn-primary">
            </div>
          </form>
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add category form -->
</div>
<!--   -->
<script type="text/javascript" src="<?=base_url('public')?>/components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#user_type').multiselect({
      includeSelectAllOption: true,
      buttonWidth: '100%',
      //enableCaseInsensitiveFiltering: true,
      //enableFiltering: true
    });
  });
</script>