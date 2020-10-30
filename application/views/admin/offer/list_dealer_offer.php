<?php 
$obj=&get_instance();
$offer=$obj->offermodel->get_offer_by_dealer();
?> 
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dealer Offers</h1>
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
              <span><a href="<?php echo base_url('admin/create-dealer-offer'); ?>" class="btn btn-primary pull-right">Add Dealer Offer</a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="offer_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Offer Name</th>
                  <th>Image</th>
                  <th>Actions</th>
                 
                </tr>
                </thead>
                <tbody>
                
                <?php if(isset($offer)){ $cnt=1; ?>  
                <?php foreach($offer as $row) { ?>
                  <tr>
                    <td><?php echo $cnt++; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td>
                      <img src="<?php echo UPLOAD_PATH."offer/dealer_offer/".$row->image; ?>" style="height: 40px;width: 40px;border-radius:40px; ">
                    </td>
                    <td style="display: inline-flex;">
                      <a class="btn btn-sm btn-info margin-5" href="<?php echo base_url('admin/edit-dealer-offer/'.$row->id); ?>"><i class="fa fa-edit"></i></a>
                      <button data-i="<?php echo $row->id; ?>" class="btn btn-sm btn-danger delete margin-5">
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
      <form method="post" action="<?php echo base_url('admin/trash-dealer-offer'); ?>" id="frmDel">
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
    $("#offer_table").DataTable();
  });
  $(document).ready(function(){
    $(document).on('click', '.delete', function(){
            var i = $(this).data('i');
            $("#frmDel input[name='id']").val(i);
            $("#modalDel").modal('show');
        });
    });
</script>
