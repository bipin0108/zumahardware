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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order Report
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-xs-12">
          <div class="box box-primary">
            <!-- /.box-header -->
              <div class="box-body">
                <form  method="post" action="<?php echo base_url('distributor/order-report'); ?>">
                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="required" for="from">Select User</label>
                              <select name="user_type" class="form-control" id="user_type" >
                                <option type="" value="">Select User</option>
                               <option value="dealer"  <?php echo (set_value('user_type')=='dealer')?'selected':'' ?> >
                                Dealer</option>
                                <option value="salesman"  <?php echo (set_value('user_type')=='salesman')?'selected':'' ?> >
                                Salesman</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="required">Select Name</label>
                              <select name="dealer_salesman" id="dealer_salesman" class="form-control">
                               
                              </select>
                              <?php echo form_error('dealer_salesman'); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="required" for="s_date">Start Date</label>
                            <input autocomplete="off" class="form-control date-picker" name="s_date" id="s_date" type="text" value="<?php echo set_value('s_date'); ?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="required" for="e_date">End Date</label>
                            <input autocomplete="off" class="form-control date-picker" name="e_date" id="e_date" type="text" value="<?php echo set_value('e_date'); ?>">
                            <?php echo form_error('e_date'); ?>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <label class="required"><br/></label>
                        <div class="form-group">
                            <button class="btn btn-primary"  data-s_date="<?php echo $row->s_date;?>"
                            data-e_date="<?php echo $row->e_date;?>" id="submit" name="weekdate" type="submit" value="Submit"> Submit</button>
                        </div>
                    </div>
                  </div>  
                </form>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <section class="content">
            <div class="row">
              <div class="col-xs-12">
               <div class="box box-primary">
                 <div class="box-body">
                    <table id="order_table" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Order Id</th>
                        <th>User Id</th>
                        <th>User Type</th>
                        <th>Order Status</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; ?>
                      <?php 
                        foreach($orders as $row) { 
                           if ($row->user_type == 'distributor') {
                            $user = $this->distributormodel->get_distributor_by_id($row->user_id);
                          }else{
                            $user = $this->usermodel->get_user_by_id($row->user_id);
                          }
                        if($orders != 'none'){  
                        ?>
                         <tr>
                            <td id="<?php echo $row->id; ?>" class="details-control"></td>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo date("d M, Y h:i A",strtotime($row->created_at)); ?></td>
                            <td><?php echo $row->order_id; ?></td>
                            <td><?php echo $user['first_name'].' '.$user['last_name']; ?></td>
                            <td><?php echo $row->user_type; ?></td>
                             <?php 
                               if($row->order_status == "pending" ){
                                    $order_status = '<span class="label label-warning">'.$row->order_status.'</span>';
                                  }else if($row->order_status == "confirmed" ){
                                    $order_status = '<span class="label label-info">'.$row->order_status.'</span>';
                                  }else if($row->order_status == "delivered" ){
                                    $order_status = '<span class="label label-primary">'.$row->order_status.'</span>';
                                    }else if($row->order_status == "completed" ){
                                    $order_status = '<span class="label label-success">'.$row->order_status.'</span>';
                                    }else if($row->order_status == "cancel" ){
                                    $order_status = '<span class="label label-danger">'.$row->order_status.'</span>';
                                  }else{
                                    $order_status = '<span class="label label-primary">'.$row->order_status.'</span>';
                                  }
                              ?>
                             <td><?php echo $order_status; ?></td>
                          </tr>
                          <?php } ?>
                          <?php } ?>  
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
        </section>
      <!-- /.row -->
      
    </section>
</div>

<script type="text/javascript">

  $(document).ready(function(){
  var user_type = '<?php echo set_value('user_type'); ?>';
   var dealer_salesman = '<?php echo set_value('dealer_salesman'); ?>';

    if(user_type != '')
    {
      $.ajax({
        url:"<?php echo base_url(); ?>distributor/user_type_dropdown_ajax",
        method:"POST",
        data:{user_type:user_type,dealer_salesman:dealer_salesman},
        success:function(data)
        {
          $('#dealer_salesman').html(data);
        }
      });
    }   
  $(document).on('change', '#user_type', function(){
    var user_type = $(this).val();
         $.ajax({
           url:"<?php echo base_url(); ?>distributor/user_type_dropdown_ajax",
           method:"POST",
           data:{user_type:user_type},
           success:function(data)
           {
           
             $('#dealer_salesman').html(data);
           }
         });
  });
});
</script>

<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('public')?>/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">

var table = $('#order_table').DataTable();

$('#order_table tbody').on('click', 'td.details-control', function () {

var order_id = $(this).attr('id');
var tr = $(this).closest('tr');
var row = table.row( tr );

if(row.child.isShown())
{
  row.child.hide();
  tr.removeClass('shown');
}
else
{
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
            <th>Product attribute</th>\
            <th>Attribute Name</th>\
            <th>Qty</th>\
            <th>Price</th>\
            <th>Total</th>\
          </tr>\
          </thead>\
          <tbody>';
        var grand_total=0;
        var data1 = data.items;
        for (var i = 0; i < data1.length; i++) {
            row_data += '<tr>\
            <td>'+data1[i].product_name+'</td>\
            <td>'+data1[i].product_att+'</td>\
            <td>'+data1[i].att_val+'</td>\
            <td>'+data1[i].qty+'</td>\
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
                      if(data.delivered_by != '' && data.lr_number != ''){
                          row_data +='\
                          <tr style="background:#f9f9f98c"><td colspan="6"><b>Shiping Information</b></td></tr>\
                          <tr>\
                             <td><b>Delevered By: </b>'+data.delivered_by+'</td>\
                             <td><b>Lr No: </b>'+data.lr_number+'</td>\
                             <td><b>Date: </b>'+data.date+'</td>\
                          </tr>';
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
<script type="text/javascript">
$(document).ready(function(){

//Date picker
$('.date-picker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd'
});
});
</script>