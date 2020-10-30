<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/css/toggle_switch.css">
<?php 
$obj=&get_instance();
$product=$obj->productmodel->get_all_product();
$qrcode = $this->qrmodel->get_qr_by_id($id);

?>
<style>
td.details-control {
background: url('<?php echo base_url().'public/dist/img/details_open.png' ?>') no-repeat center center;
cursor: pointer;
}
tr.shown td.details-control {
background: url('<?php echo base_url().'public/dist/img/details_close.png' ?>') no-repeat center center;
}
</style> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Products</h1>
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
              <span><a href="<?php echo base_url('admin/create-product/'); ?>" class="btn btn-sm btn-primary pull-right">Add Product</a></span>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="product_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Product Code</th>
                  <th>Category</th>
                  <th>Subcategory</th>
                  <th>Is-Hot</th>
                  <th>Actions</th>               
                </tr>
                </thead>
                <tbody>
                <?php if(isset($product)){ ?>  
                  <?php $i=1; ?>
                    <?php foreach($product as $row) { ?>
                      <tr>
                        <td id="<?php echo $row->id; ?>" class="details-control"></td>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->code; ?></td>
                        <td><?php echo $row->category; ?></td>
                        <td><?php echo $row->subcategory; ?></td>
                        <td><label class="switch">
                        <?php 
                          if($row->is_hot == '1'){
                            $checked = 'checked';
                          }else{
                            $checked = '';
                          } 
                         ?> 
                        <input type="checkbox"  <?php echo $checked; ?> class="active_deactive" 
                        data-is_value="<?php echo $row->is_hot; ?>" data-i="<?php echo $row->id ?>"  >
                        <span class="slider round"></span>
                      </label></td>
                        <td style="display: inline-flex;">
                          <a class="btn btn-sm btn-info margin-5" href="<?php echo base_url('admin/edit-product/'.$row->id); ?>"><i class="fa fa-edit"></i></a>
                          <button data-i="<?php echo $row->id; ?>" class="btn btn-sm btn-danger delete margin-5">
                            <i class="fa fa-trash"></i></button>
                          <button type="button" data-i="<?php echo $row->id; ?>" class="btn btn-sm qr_code margin-5">
                            <i class="fa fa-qrcode"></i>
                          </button>
                          <a class="btn btn-sm btn-primary margin-5" href="<?php echo base_url('admin/product-details/'.$row->id); ?>"><i class="fa fa-eye"></i></a>
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
  $(document).ready(function(){
    $(document).on('click', '.delete', function(){
        var i = $(this).data('i');
        $("#frmDel input[name='product_id']").val(i);
        $("#modalDel").modal('show');
    });

    $(document).on('click', '.qr_code', function(){
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
          var product_id = data;
          $("#frmQrCode input[name='qr_id']").val(0);
          $("#frmQrCode input[name='count']").val('');
          $("#frmQrCode input[name='point']").val('');
          $("#myModal").modal('hide');
         
          var linkHref = "<?php echo base_url('admin/save-pdf/') ?>"+product_id;
          window.open(linkHref, '_blank');
        }
      });
    });

     $(document).on('click', '.active_deactive', function(){
          var id = $(this).data('i');
          var is_value = $(this).data('is_value');

            $.ajax({
                 url:"<?php echo base_url(); ?>admin/hot-active-deactive-ajax",
                 method:"POST",
                 data:{id:id,is_value:is_value},
                 success:function(data)
                 {
                     console.log(data);
                     if(data == 1)
                     {
                        $('#product_table').load(document.URL + ' #product_table');
                     }
                 }
            });
        });

  });
</script>

<script type="text/javascript">

   var table = $('#product_table').DataTable();
      $('#product_table tbody').on('click', 'td.details-control', function () {
        var product_id = $(this).attr('id');
        var tr = $(this).closest('tr');
        var row = table.row( tr );

          if (row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
            }
            else {
        
            $.ajax({
            url:"<?php echo base_url(); ?>admin/get_qr_by_productId_ajax",
            method:"POST",
            data:{product_id:product_id},
              success:function(data)
              {
                var data1 = JSON.parse(data);
                qrcount = data1.qrcount;
                data1 = data1.res;
                var row_data = '';
               
               if(data1.length > 0)
               {
                row_data += '<table class="table">\
                  <thead>\
                  <tr>\
                    <th>Date</th>\
                    <th>Image</th>\
                    <th>Name</th>\
                    <th>Point</th>\
                    </tr>\
                  </thead>\
                  <tbody>';
                  var grand_total=0;
                  var used_point=0;
                  for (var i = 0; i < data1.length; i++) {
                      row_data += '<tr>\
                      <td>'+data1[i].scan_date+'</td>\
                      <td><img src="<?php echo base_url().'uploads/qr_image/' ?>'+data1[i].qr_image+'"style="width:25px;"></td>\
                      <td>'+data1[i].first_name+' '+data1[i].last_name+'</td>\
                      <td>'+data1[i].point+'</td>\
                    </tr>';
                  used_point += parseInt(data1[i].point);
                  
                  }

                  row_data += "<tr style='font-weight:600;'>\
                  <td colspan='2'></td>\
                  <td>Total Point: "+qrcount+"</td>\
                  <td style='text-align:left'>Used Point: "+used_point+"</td>\
                  </tr>";
           
                  grand_total = parseInt(qrcount-used_point);
                  row_data += "<tr style='font-weight:600;'>\
                  <td colspan='3'></td>\
                  <td style='color:green;font-size:15px;font-weight:bold;'>Remaining Point: "+grand_total+"</td></tr>";
                  row_data += '</tbody>\
                  </table>';

                  
                }else{
                  row_data += '<table class="table">\
                  <tr>\
                  <td style="border-top: 1px solid #fff"><b>Total Point : </b>'+qrcount+'</td>\
                  </tr>\
                  </table>';
                }  
                row.child(row_data).show();
                  tr.addClass('shown');
              }
            });
          }
   });
</script>
