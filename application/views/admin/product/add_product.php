<?php
  $obj=&get_instance();
  $category=$obj->categorymodel->dropdowncate(); 
  $subcategory=$obj->subcategorymodel->dropdownsubcate();
  $attribute=$obj->attributemodel->get_all_attribute();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Product
      <div class="pull-right">
         <a href="<?=base_url('admin/product-list')?>" class="btn m-b-xs btn-sm btn-info btn-addon">
         <i class="fa fa-backward">
         </i> Back
         </a>
      </div>
   </h1>
</section>
<!-- start add category form -->
<section class="content">
   <div class="row">
   <div class="col-xs-12">
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">Add
            </h3>
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
         <!-- START add product form -->
         <?php echo form_open_multipart('admin/add-product'); ?>
         <div class="box-body">
            <div class="col-md-6">
               <div class="form-group">
                  <label>Name
                  </label>
                  <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control" placeholder="Name" autocomplete="off">
                  <?php echo form_error('name'); ?>
               </div>
               <div class="form-group">
                  <label>Category
                  </label>
                  <select name="category" id="parent_category" class="form-control">
                    <option value=" ">Select Category</option>
                     <?php foreach ($category as $cat) { ?>
                     <option value="<?php echo $cat['id']; ?>"
                      <?php echo (set_value('category')==$cat['id'])?'selected':'' ?>
                      >
                        <?php echo $cat['name']; ?>
                     </option>
                     <?php }  ?>
                  </select>
                  <?php echo form_error('category'); ?>
               </div>
               <div class="form-group">
                  <label>Subcategory
                  </label>
                  <select name="subcategory" id="subcategory" class="form-control">
                     <option value=" ">Select Subcategory
                     </option>
                  </select>
                  <?php echo form_error('subcategory'); ?>
               </div>

                <div class="form-group">
                  <label>Product Code</label>
                  <textarea name="code" id="code" class="form-control" placeholder="Product Code" autocomplete="off"><?php echo set_value('code')?></textarea>
                  <?php echo form_error('code'); ?>
                </div>


               <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" id="product_desc" class="form-control" placeholder="Description" autocomplete="off"><?php echo set_value('description')?></textarea>
                  <?php echo form_error('description'); ?>
               </div>

                <div class="form-group">
                  <label>About Product</label>                               
                  <button type="button" id="about_product" class="btn btn-primary">Add</button>
                  <div id="a_product"></div>
               </div>                        
            </div>
            <div class="col-md-6">

                  <div class="form-group">
                   <label class="control-label">Upload Image
                   </label>
                   <input type="file" class="form-control" name="product_image[]" multiple="multiple">
                   <?php echo form_error('product_image'); ?>
                   <?php if($this->session->flashdata('img_error')): ?>
                   <div class="alert alert-danger">
                      <span>
                      <?php echo $this->session->flashdata('img_error') ?>
                      </span>
                   </div>
                   <?php endif ?>
                </div>
                <div class="form-group">
                    <label class="control-label">Installation Guide Images</label>
                     <input type="file" class="form-control" name="guide_files[]" multiple="multiple">
                     <?php if($this->session->flashdata('guide_files')): ?>
                     <div class="alert alert-danger">
                     <span><?php echo $this->session->flashdata('guide_files') ?></span>
                     </div>
                     <?php endif ?>
                </div>
                
                <div class="alert alert-warning" style="padding: 4px;">
                <span>Please select video types mp4 and webm. </span></div>
                <div class="form-group">
                  <label class="control-label">Installation Guide Video</label>
                  <input type="file" class="form-control" name="guide_video" >
                  <?php if($this->session->flashdata('guide_video')): ?>
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <span><?php echo $this->session->flashdata('video_error') ?></span>
                  </div>
                  <?php endif ?>
                </div> 
                <input type="hidden" name="attribute" value="" class="form-control">
                <input type="hidden" name="element_name" value="" class="form-control">
                <input type="hidden" name="element_price" value="" class="form-control">
                <div id="sethidden">
                </div> 

              <div id="attribute">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Attributes</label>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control att" name="select_attribute" id="select_attr" required>
                      <option value="">Select Attribute</option>
                        <?php foreach ($attribute as $att) { ?>
                     <option value="<?php echo $att->att_id; ?>">
                        <?php echo $att->att_name; ?>
                     </option>
                     <?php }  ?>
                    </select>
                    <?php echo form_error('select_attribute'); ?>
                  </div>  
                  <div class="col-md-6">
                    <button class="btn btn-sm btn-primary" type="button" id="addAttribute">New</button>
                  </div> 
                  <div class="clearfix"></div>
                  <?php echo form_error('element_name'); ?>
                </div>
              </div>
            </div>
         </div>
         <div class="box-footer">
            <input type="submit" id="submit" value="Save" class="btn btn-sm btn-primary">
         </div>
         <?php form_close();  ?>
      </div>
</section>
<!-- end add category form -->
</div>
<script>
$(document).ready(function(){
 var cat_id = '<?php echo set_value('category'); ?>';
 var subcat_id = '<?php echo set_value('subcategory'); ?>';
  if(cat_id != '')
  {
    $.ajax({
      url:"<?php echo base_url(); ?>admin/get-dynamic-subcat",
      method:"POST",
      data:{cat_id:cat_id,subcat_id:subcat_id},
      success:function(data)
      {
        $('#subcategory').html(data);
      }
    });
  }
  $(document).on('change', '#parent_category', function(){
    var cat_id = $(this).val();
    if(cat_id != '')
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/get-dynamic-subcat",
        method:"POST",
        data:{cat_id:cat_id},
        success:function(data)
        {
          $('#subcategory').html(data);
        }
      });
    }
  });
});
</script>
<script>
   $(document).ready(function(){
     $(document).on('change', '#parent_category', function(){
       var cat_id = $(this).val();
       if(cat_id != '')
       {
         $.ajax({
           url:"<?php echo base_url(); ?>admin/get-dynamic-subcat",
           method:"POST",
           data:{
             cat_id:cat_id}
           ,
           success:function(data)
           {
             $('#subcategory').html(data);
           }
         });
       }
     });
   });
</script>
<script type="text/javascript">
  var att_name;
  var attribute = [];
  var att_val = [];
  var element_name;
  var price;
  var test;
  var i = 0;
  $(document).ready(function(){
    //add attribute div
     $(document).on('click', '#addAttribute', function(){
      att_name = $("select.att").children("option:selected").val();
      test = att_name;
      if (test != '' && test != null) {
        $("#select_attr").prop("disabled", true);
        if(att_name){
        if(attribute.length < 1){
        if(!attribute.includes(att_name)){
          attribute.push(att_name);
          var htnl = '<div class="col-md-12" >\
                        <div id="div_'+att_name+'">\
                                <button class="btn btn-sm btn-primary add_attr_val " type="button" id="'+att_name+'" >Add</button>\
                                <button class="btn btn-sm btn-primary remove" id="'+att_name+'">Remove</button>\
                              <div class="clearfix"></div>\
                        </div>\
                      </div>';
          $("#attribute").append(htnl);
          }
         }
        } 
      }
    });

     //About Product
      $(document).on('click', '#about_product', function(){    
        i++;
          var htnl = '<div class="col-md-12"  style="margin-top:10px;margin-bottom:10px;" id="div_'+i+'">\
                        <div>\
                          <div class="col-md-5">\
                            <input type="text" name="title[]" class="form-control" placeholder="Title" required>\
                          </div>\
                          <div class="col-md-5">\
                            <input type="text" name="value[]" class="form-control" placeholder="Value" required>\
                          </div>\
                          <div class="col-md-2">\
                           <button class="btn btn-sm btn-primary pro_remove"  id="'+i+'p_btn"><i class="fa fa-fw fa-remove"></i></button>\
                          </div>\
                        </div>\
                      </div>';
          $("#a_product").append(htnl);
      });

    $(document).on("click",'.pro_remove', function(e){
      e.preventDefault(); 
      var id = $(this).attr('id').slice(0,-5);
      $(this).closest('#div_'+id).remove();
    });

    //remove attr full div  
    $(document).on("click",".remove", function(e){
        var attr_name = $(this).attr('id');
        var index = attribute.indexOf(attr_name);
        attribute.splice(index, 1);
         $("#select_attr").prop("disabled", false);
        $('#div_'+attr_name).remove();
    });
   //add attr val
    $(document).on('click', '.add_attr_val', function(){ 
      i++;
      var attr_name = $(this).attr('id');
      var htnl1 = '<div name="div" class="form-inline">\
                    <div id="rm_'+attr_name+'" style="margin-top: 10px;">\
                        <div class="form-group">\
                            <input type="text" id="val_'+attr_name+'_'+i+'" name="attr_val_'+attr_name+'[]" value="" class="form-control" autocomplete="off" required>\
                              <?php echo form_error('attr_val_'); ?>
                            <input type="number" id="val_Price_'+i+'" name="price_'+attr_name+'[]" value="" class="form-control" autocomplete="off" required>\
                             <button class="btn btn-sm btn-primary att_remove"  id="'+attr_name+i+'_btn"><i class="fa fa-fw fa-remove"></i></button>\
                          <div class="clearfix"></div>\
                      </div>\
                    </div>\
                  </div>';
      $('#div_'+attr_name).append(htnl1);
      someFunction();
   });
   //remove attribute and price row field
   $(document).on("click",'.att_remove', function(e){
        e.preventDefault(); 
        var id = $(this).attr('id').slice(0,-5);
        $(this).closest('#rm_'+id).remove();
        someFunction();
    });

    function someFunction() {
      var att_element = [];
      var att_price = [];
      $("input[id^='val_"+test+"_']").each(function(){
        var val = $('#'+this.id).val();
        if(val){
         att_element.push(val); 
         }
      });

      $("input[id^='val_Price_']").each(function(){
        var val = $('#'+this.id).val();
        if(val){
         att_price.push(val); 
         }
      });
      element_name = att_element.toString();
      price = att_price.toString();

      $("input[name='attribute']").val(test);
      $("input[name='element_name']").val(element_name);
      $("input[name='element_price']").val(price);
    }
      $(document).on('click', '#submit', function(){
      someFunction();
     });
});
</script>
