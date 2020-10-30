<?php 
  $obj=&get_instance();
  $Distributor=$obj->distributormodel->get_all_distributor(); 
?> 
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style type="text/css">
  .margin-right{
    margin-right: 2px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>ALL Distributor</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
           <div class="box">
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
              <a href="<?php echo base_url('admin/create-distributor'); ?>" class="btn btn-primary pull-right" >Add Distributor</a>
          </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="distributor_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Mobile</th>
                  <th>Adress</th>
                  <th>Aadhar Number</th>
                  <th>Points</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($Distributor)){ 
                  $i = 1;
                ?>  
                <?php foreach($Distributor as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                      <img src="<?php echo UPLOAD_PATH."distributor/".$row->image; ?>" style="height: 35px;width: 35px;border-radius:40px; ">
                        </td>
                        <td> <?php echo $row->first_name." ".$row->last_name; ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->password; ?></td>
                        <td><?php echo $row->mobile_no; ?></td>
                        <td><?php echo $row->address; ?></td>
                        <td><?php echo $row->aadhar_no; ?></td>
                        <td><?php echo $row->point; ?></td>
                        <td style="display:inline-flex">
                          <a class="btn btn-sm btn-warning margin-5" href="<?php echo base_url('admin/edit-distributor?id='.$row->id); ?>">
                            <i class="fa fa-edit"></i>
                          </a>
                          <button data-i="<?php echo $row->id; ?>" class=" btn btn-sm btn btn-danger margin-5 delete">
                            <i class="fa fa-trash"></i>
                          </button>
                       
                          <a class="btn btn-sm btn-primary margin-5" href="<?php echo base_url('admin/dealer-list/'.$row->id); ?>">Dealer</a>
                          <a class="btn btn-sm btn-primary margin-5" href="<?php echo base_url('admin/carpenter-list/'.$row->id); ?>">Carpenter</a>
                          <a class="btn btn-sm btn-primary margin-5" href="<?php echo base_url('admin/salesman-list/'.$row->id); ?>">SalesMan</a></td>
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
      <form method="post" action="<?php echo base_url('admin/trash-distributor'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="">
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
    $("#distributor_table").DataTable();
  });
  $(document).ready(function(){
        $(document).on('click', '.delete', function(){
            var i = $(this).data('i');
            $("#frmDel input[name='id']").val(i);
            $("#modalDel").modal('show');
        });

         $("#type").change(function(){
          var type = $(this).val();
           window.location = "<?php echo base_url('admin/distributor-list/') ?>"+type;
        });
    });
</script>


