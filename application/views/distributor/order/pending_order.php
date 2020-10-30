<?php 
$obj=&get_instance();
$order=$obj->d_ordermodel->pending_order_list();
?> 
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/css/toggle_switch.css">
<style>
td.details-control {
background: url('<?php echo base_url().'public/dist/img/details_open.png' ?>') no-repeat center center;
cursor: pointer;
}
tr.shown td.details-control {
background: url('<?php echo base_url().'public/dist/img/details_close.png' ?>') no-repeat center center;
}
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Pending Order</h1>
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
              <table id="order_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Order Id</th>
                  <th>User</th>
                  <th>User Type</th>
                  <th>Order Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                <?php foreach($order as $row) { 
                  $user = $this->usermodel->get_user_by_id($row->user_id); 
                ?>
                 <tr>
                    <td id="<?php echo $row->id; ?>" class="details-control"></td>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("d M, Y h:i A",strtotime($row->created_at)); ?></td>
                    <td><?php echo $row->order_id; ?></td>
                    <td><?php echo $user['first_name'].' '.$user['last_name']; ?></td>
                    <td><?php echo $row->user_type; ?></td>
                    <?php 
                      $order_status = '<span class="label label-warning">'.$row->order_status.'</span>';
                    ?>
                    <td><?php echo $order_status; ?></td>
                    <td style="display: inline-flex;">
                        <button data-i="<?php echo $row->order_id;?>" class="btn btn-sm btn-info  change_status margin-5" data-orderstatus="<?php echo $row->order_status;?>" data-delivered="<?php echo $row->delivered_by;?>" data-lr="<?php echo $row->lr
                          ;?>" data-date="<?php echo $row->date;?>" data-paymentstatus="<?php echo $row
                          ->order_payment_status;?>">
                          <i class="fa fa-pencil"> Status</i>
                        </button>
                    </td>
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
 <!-- Modal -->
<!-- Order status -->
  <div class="modal fade" id="modalchange_status" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <form action="" method="post" id="frmChangeStatus">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Status</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Order</label>
                <select class="form-control" id="change_status" name="order_status">
                  <option value="pending" >Pending</option>
                  <option value="confirmed">Confirmed</option>
                  <option value="cancel">Cancel</option>
                </select>
            </div>
           </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="save" data-i="<?php echo $row->order_id;?>" data-delivered="<?php echo $row->delivered;?>" data-lr="<?php echo $row->lr;?>" data-date="<?php echo $row->date;?>" data-orderstatus="<?php echo $row->order_status;?>" data-paymentstatus="<?php echo $row->order_payment_status;?>" data-date="<?php echo $row->date;?>">Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  
  var order_id;
      // Change-Status
  $(".change_status").click(function(e){
    var row = $(this).data('i');
    order_id = row;
    var order_status = $(this).data('orderstatus');
    url = "<?php echo base_url();?>distributor/change-status/"+order_id;

    $("#frmChangeStatus").attr("action",url);
    $("#frmChangeStatus select[name='order_status']").val(order_status).prop("selected", true);
    $("#modalchange_status").modal('show');
   
  });
</script>
<script type="text/javascript">
    //Detail Control
    var table = $('#order_table').DataTable();

    $('#order_table tbody').on('click', 'td.details-control', function () {
      var order_id = $(this).attr('id');
      var tr = $(this).closest('tr');
      var row = table.row( tr );
        if (row.child.isShown() ) {
          row.child.hide();
          tr.removeClass('shown');
        }
        else{
    
          $.ajax({
          url:"<?php echo base_url(); ?>distributor/get_Item_byOrderId_ajax",
          method:"POST",
          data:{order_id:order_id},
            success:function(data)
            {
              var data = JSON.parse(data);
              var row_data = '';
              row_data += '<table class="table">\
                  <thead>\
                    <tr>\
                      <th>Product Name</th>\
                      <th>Qty</th>\
                      <th>Product attribute</th>\
                      <th>Attribute value</th>\
                      <th>Price</th>\
                      <th>Total</th>\
                    </tr>\
                  </thead>\
                  <tbody>';
                  var grand_total=0;
                  var data1 = data.items;
                  for (var i = 0; i < data1.length; i++) {
                    att_name = data1[i].product_name;
                    row_data += '<tr>\
                      <td>'+data1[i].product_name+'</td>\
                      <td>'+data1[i].qty+'</td>\
                      <td>'+data1[i].product_att+'</td>\
                      <td>'+data1[i].att_val+'</td>\
                      <td>'+data1[i].price+'</td>\
                      <td>'+data1[i].qty*data1[i].price+'</td>\
                      </tr>';
                  grand_total += parseInt(data1[i].qty*data1[i].price);
                  }
                    row_data += "<tr style='font-weight:600;'>";
                    if(data.salesman_name != 'none'){
                      row_data += "<td colspan='2'>Reference: "+data.salesman_name+"[salesman]</td><td colspan='2' style='text-align:right'>Grand Total</td><td>"+grand_total+"</td></tr>";
                    }
                    else
                    {
                      row_data += "<td colspan='5' style='text-align:right'>Grand Total</td><td>"+grand_total+"</td></tr>";  
                    }
                row_data += '</tbody>\
              </table>';
            row.child(row_data).show();
              tr.addClass('shown');
          }
        });
      }
    });
</script>
