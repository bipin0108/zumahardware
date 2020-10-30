<?php 
$obj=&get_instance();
$slider=$obj->brandmodel->get_all_brand(); 
?> 
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Brand Images</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box box-primary">
            <div class="box-header">
              <?php if(!empty($this->session->flashdata('add_success'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('add_success'); ?> </span>
              </div>
              <?php endif ?>
              <?php if(!empty($this->session->flashdata('update_success'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('update_success'); ?> </span>
              </div>
              <?php endif ?>
              <?php if(!empty($this->session->flashdata('del_success'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('del_success'); ?> </span>
              </div>
              <?php endif ?>
              <span><a href="<?php echo base_url('admin/create-brand/'); ?>" class="btn btn-sm btn-primary pull-right">Add Brand</a></span>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="brand_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Brand Image</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($slider)){ ?>  
                    <?php $i=1; ?>
                <?php foreach($slider as $row) { ?>
                  <tr>
                      <td><?php echo $i++; ?></td>
                      <td>
                        <img style="height:65px;" alt="" src="<?php echo IMAGE_URL.'brand/'.$row->brand_img; ?>" class="img-responsive">
                      </td>
                      <td style="display: inline-flex;">
                        <button data-i="<?php echo $row->brand_id;?>" class="btn btn-sm btn-danger margin-5 delete">
                          <i class="fa fa-trash"></i></button>
                      </td>
                  </tr>                  
                <?php } ?>    
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade in" id="modalDel">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <form method="post" action="<?php echo base_url('admin/trash-brand'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="brand_id" value="">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <input type="submit" class="btn btn-primary btnclass" value="Yes Delete!">
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#brand_table").DataTable();
  });
  $(document).ready(function(){
        $(document).on('click', '.delete', function(){
            var i = $(this).data('i');
            $("#frmDel input[name='brand_id']").val(i);
            $("#modalDel").modal('show');
        });
    });
</script>
