<style type="text/css">
  .input_qty, .table_td{
    width:35px;
  }
</style>
<?php 
$obj=&get_instance();
$id = $this->session->userdata[SESSION_USER]['id'];
$product=$obj->productmodel->get_all_product(); 
$pro_attribute=$obj->productattributemodel->get_all_productattribute()
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Create Place Order</h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12 col-md-5 col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">&nbsp;</h3>
          </div>
            <button class="btn btn-primary" id="add_item" style="margin-left: 340px;">Add Item</button>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="product_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
              </tr>
              </thead>
              <tbody>
              <?php if(isset($product)){ ?>  
                 <?php $i=1; ?>
              <?php 
                  foreach($product as $row) { 
               ?>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" value="<?php echo $row->id; ?>" >
                  </td>
                  <td>
                    <input type="hidden" id="name_<?php echo $row->id; ?>"  value="<?php echo $row->name; ?>">
                    <?php echo $row->name; ?>
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
      <!-- end table -->
      <div class="col-sm-12 col-md-7 col-xs-12">
        <div class="box">
          <div class="box-header">
            <h2 class="box-title">Order Items</h2>
            <hr>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="items_div">
              
            </div>  
          </div>
              <div class="box-footer">
                <input type="hidden" name="order">
                <button class="btn btn-primary" id="place_order" disabled>Place Order</button>
              </div>
   <!-- end -->
        </div>
      </div>
      <!-- END -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  $(function(){
    $("#product_table").DataTable({
      ordering: false,
    });
  });
  var product_arr = [];
  //place prder
  $(document).ready(function(){
    $(document).on('click', '.checkbox', function(){
      var product_id = $(this).val(); 
        if($(this).prop("checked") == true)
        {
          product_arr.push(product_id);
        }
        else{
          product_arr.splice($.inArray(product_id, product_arr),1);
        }
    });
    var k=0;
    //add item

    $(document).on('click', '#add_item', function(){
      $('#order_items').remove();
          $.ajax({
              url:"<?php echo base_url(); ?>distributor/get_product_attribute_ajax",
              method:"POST",
              data:{product_arr:product_arr.toString()},
              success:function(data)
              {
                var data = JSON.parse(data);
                var html ='';
                html += '<div id="order_items">';
                $.each(data, function(i, item) {
                    html += '<div id=div_'+data[i].product_id+'>';
                    html += '<button id="'+data[i].product_id+'_div" class="btn btn-sm remove-btn btn-danger pull-right remove">Remove</button>';
                    html += '<h3>'+data[i].product_name+'</h3>';
                    html += '<h4>'+data[i].att_name+'</h4>';
                    var attr = data[i].item;
                    html += '<table>\
                              <tbody>';
                    $.each(attr, function(j, item) {
                      k++;
                      html += '<tr id="rm_'+attr[j].att_name+''+k+'">\
                                <td><input type="text" id="'+attr[j].att_name+'"  class="form-control" name="att" value="'+attr[j].att_name+'"   disabled></td>\
                                <td><input type="text"  id="'+attr[j].att_value+'" class="form-control" name="price" value="'+attr[j].att_value+'" disabled></td>\
                                <td><input type="number" class="form-control" id="'+data[i].product_id+'proqty_'+j+'" min="1"  value="0" data-att_name="'+attr[j].att_name+'" data-att_value="'+attr[j].att_value+'" data-pro_att="'+data[i].att_name+'"></td>\
                                 <td>&nbsp;<button class="btn btn-sm btn-danger att_remove"  id="'+attr[j].att_name+''+k+'_btn"><i class="fa fa-trash"></i></button></td>\
                                </tr>\
                              ';
                      });
                    html += '</tbody>\
                              </table>';
                    html += '</div>'          
                    //end
                });
                html += '</div>';
                //end    
                $('#items_div').append(html);
                $("#place_order").prop("disabled", false);
              }
          });
        });
    var result = [];     
    $(document).on('click', '#place_order', function(){
      $.each(product_arr, function(i, pro_item) {
        var arr = [];
        $('input[id^="'+pro_item+'proqty_"]').each(function(){
          if ($(this).val() != 0 && $(this).val() !='') {
            arr.push({qty :  $(this).val(),att_name :  $(this).data('att_name'),att_value :  $(this).data('att_value'),pro_att :  $(this).data('pro_att'),product_id:pro_item});
          }
        });  
        result.push({attr:arr});
      });

      var res = JSON.stringify(result);
      var id = '<?php echo $id; ?>';
      $.post("<?php echo base_url(); ?>distributor/place_order_ajax",{res:res,id:id},function(data){
           window.location.href = "<?php echo base_url('distributor/my-order/'); ?>";
      }); 
    });

    $(document).on("click",'.remove', function(e){
      e.preventDefault();
      var id = $(this).attr('id').slice(0,-4);
      $(this).closest('#div_'+id).remove();
    });
    $(document).on("click",'.att_remove', function(e){
      e.preventDefault(); 
      var id = $(this).attr('id').slice(0,-4);
      $(this).closest('#rm_'+id).remove();
    });
  });
</script>

