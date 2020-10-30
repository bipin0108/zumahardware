<?php 
$obj=&get_instance();
$complaints=$obj->complaintsmodel->compeleted_complaints_list();
?> 
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Pending Complaints</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box box-primary">
            <div class="box-header" style="display:<?php echo ( !empty($this->session->flashdata('add_success')) || !empty($this->session->flashdata('update_success')) || !empty($this->session->flashdata('del_success')) ) ? 'block;' : 'none;' ; ?>">
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="complaints_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>User</th>
                  <th>User Type</th>
                  <th>Product</th>
                  <th>Mobile Number</th>
                  <th>Address</th>
                  <th>Message</th>
                  <th>Status</th>
                 
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                <?php foreach($complaints as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("d M, Y h:i A",strtotime($row->created_at)); ?></td>
                    <td><?php echo $row->first_name." ".$row->last_name; ?></td>
                    <td><?php echo $row->type; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->mobile_no; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td><?php echo $row->message; ?></td>
                     <?php 
                       if($row->status == "pending" ){
                            $status = '<span class="label label-warning">'.$row->status.'</span>';
                         
                            }else if($row->status == "completed" ){
                            $status = '<span class="label label-success">'.$row->status.'</span>';
                          
                            }else{
                            $status = '<span class="label label-primary">'.$row->status.'</span>';
                          }
                      ?>
                    <td><?php echo $status; ?></td>
                   
                  </tr>
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
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#complaints_table").DataTable();
  });
  $(document).ready(function(){
    $(document).on('click', '.delete', function(){
            var i = $(this).data('i');
            $("#frmDel input[name='id']").val(i);
            $("#modalDel").modal('show');
        });
    });
</script>
