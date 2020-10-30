<?php 
  $obj=&get_instance();
  $id=$this->uri->segment(3);
  $product = $obj->subcategorymodel->get_product_by_subcat_id($id);
  $subcat = $obj->subcategorymodel->get_subcategory_by_id($id);
  $cat = $obj->categorymodel->get_catname_by_id($subcat->subcat_parentid);
?> 
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Products</h1>
      <h4>Category: <?php echo $cat; ?></h4> 
      <h4>Subcategory: <?php echo $subcat->subcat_name; ?></h4> 
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
              <table id="product_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Subcategory</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($product)){ ?>  
                  <?php $i=1; ?>
                    <?php foreach($product as $row) { ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $cat; ?></td>
                        <td><?php echo $subcat->subcat_name; ?></td>
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
      <form method="post" action="<?php echo base_url('admin/trash-product'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="product_id" value="">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <input type="submit" class="btn btn-primary btnclass" value="Yes Delete!">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Qrcode</h4>
      </div>
      <form action="javascript:;" method="post" id="frmQrCode">
        <!-- Modal body -->
        <div class="modal-body">
          <input type="hidden" name="qr_id">
          <div class="form-group">
              <label>Count</label>
              <input type="number" name="count" value="" class="form-control" placeholder="Count" autocomplete="off" required="required"><?php echo form_error('count'); ?>
          </div>
          <div class="form-group">
              <label>Point</label>
              <input type="number" name="point" value="" class="form-control" placeholder="Point" autocomplete="off" required="required"><?php echo form_error('point'); ?>
          </div>
          <div id="qrcode"></div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary submit">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#product_table").DataTable();
  });
  $(document).ready(function(){
    $(document).on('click', '.delete', function(){
        var i = $(this).data('i');
        $("#frmDel input[name='product_id']").val(i);
        $("#modalDel").modal('show');
    });

    $(".qr_code").click(function(){
        var i = $(this).data('i');
        $("#frmQrCode input[name='qr_id']").val(i);
        $("#myModal").modal('show');
    });

    $(".submit").click(function(e) {
      e.stopPropagation();
        $.ajax({
        type: "POST",
        url: "Qrimages/index",
        data: $("#frmQrCode").serialize(),
        success: function(data) {
          $("#frmQrCode input[name='qr_id']").val(0);
          $("#frmQrCode input[name='count']").val('');
          $("#frmQrCode input[name='point']").val('');
          $("#myModal").modal('hide');
        }
      });
    });
  });
</script>
