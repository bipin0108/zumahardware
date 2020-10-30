<?php
$obj=&get_instance();
$id=$this->uri->segment(3);
$product = $this->productmodel->get_product_by_id($id);
$category=$obj->categorymodel->dropdowncate(); 
$subcategory=$obj->subcategorymodel->dropdownsubcate();
$pro_attribute=$obj->productattributemodel->get_productattribute_by_product_id($id);
$attribute=$obj->attributemodel->get_attributname_by_att_id($product['attribute']);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Product
            <div class="pull-right">
                <a href="<?=base_url('admin/product-list')?>" class="btn m-b-xs btn-sm btn-info btn-addon"><i class="fa fa-backward"></i> Back</a>
            </div>
        </h1>
    </section>
    <!-- start add category form -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit</h3>
                    </div>
                    <?php if(!empty($this->session->flashdata('success'))): ?>
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span> <?php echo $this->session->flashdata('success'); ?> </span>
                    </div>
                    <?php endif ?>
                    <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>   
                    <span><?php echo $this->session->flashdata('error') ?></span>
                    </div>
                    <?php endif ?>
                    <!-- START add product form -->
                        <div class="box-body">
                        <?php echo form_open_multipart('admin/update-product'); ?>
                            <div class="col-md-6">
                                <!-- //<form method="post" action="<?php //echo base_url('admin/update-product'); ?>" enctype="multipart/form-data"> -->
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php echo $product['name']; ?>" class="form-control" placeholder="Name" autocomplete="off">
                                    <?php echo form_error('name'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Category
                                     </label>
                                 <select name="category" id="parent_category" class="form-control">
                                     <option value="">Select Category</option>
                                     <?php foreach ($category as $cat) { ?>
                                     <option value="<?php echo $cat['id']; ?>" <?php if($product['category'] == $cat['id']){ echo 'selected';} ?>>
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
                                     <option value="">Select Subcategory
                                     </option>
                                  </select>
                                    <?php echo form_error('subcategory'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <textarea placeholder="Product Code" name="code" id="code" class="form-control" autocomplete="off"><?php echo $product['code']; ?></textarea>
                                    <?php echo form_error('code'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea placeholder="Description" name="description" id="product_desc" class="form-control" autocomplete="off"><?php echo $product['description']; ?></textarea>
                                    <?php echo form_error('description'); ?>
                                </div>
                                
                                <div class="form-group">
                                    <label>About Product</label> 
                                    <div class="col-md-12">
                                        <?php $i = -1; ?>
                                        <?php 
                                        $about_product = json_decode($product['about_product'],true); ?>
                                        <?php foreach ($about_product as $key => $value) { $i++ ;?>
                                            <div class="col-md-5">
                                                <input class="form-control" type="text" name="title[]" value="<?php echo $key; ?>" style="margin-top: 10px;margin-bottom: 10px;">
                                            </div>
                                                     
                                            <div class="col-md-5">
                                                <input class="form-control" type="text" name="value[]" value="<?php echo $value; ?>" style="margin-top: 10px;margin-bottom: 10px;">
                                            </div>
                                             <div class="col-md-2">
                                                <td style="display: inline-flex;">
                                                    <button type="button" data-i="<?php echo $i; ?>"  data-key="<?php echo $key;
                                                     ?>"  data-value="<?php echo $value ?>" class="btn btn-sm btn-danger delete about_product_delete" style="margin-top: 16px;"> <i class="fa fa-trash"></i></button>
                                                </td>
                                            </div>
                                        <?php  } ?>
                                    </div>
                                    
                                    <button type="button" id="about_product" class="btn btn-primary">Add</button>
                                    <div id="a_product"></div>
                                </div>   
                            </div>
                            <!-- End form edit -->
                            <div class="col-md-6">
                                 <div id="Installation_Guide_Images">
                                <div class="pull-left">
                                    <h4><b>Product Images</b></h4>
                                 </div>   
                                <div class="pull-right">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productimage_modal" >Add</button>
                                    </div>
                                </div>   
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                            $i=1; 
                                            $j=0;
                                        ?>
                                        <tbody>
                                            <?php if($product['product_image'] != ''){ ?>
                                            <?php $product_image = explode(',', $product['product_image']); ?>
                                            <?php  $count = count($product_image);  ?>
                                            <?php if(count($product_image) > 0){ ?> 
                                            <?php foreach ($product_image as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><img src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$value; ?>" alt="product" id="imagePreview" style="width: 35px;"></td>
                                                <?php if($count > 1){?>
                                                <td style="display: inline-flex;">
                                                    <button  data-i="<?php echo $j++; ?>" data-imgname="<?php echo $value ?>" class="btn btn-sm btn-danger delete productimg_delete">
                                                    <i class="fa fa-trash"></i></button>
                                                </td>
                                                 <?php } ?>
                                            </tr>    
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } ?> 
                                        </tbody>
                                    </table>
                                </div>
                                <br/>
                                <hr>      
                                <div id="Installation_Guide_Images">
                                <div class="pull-left">
                                    <h4><b>Installation Guide Images</b></h4>
                                 </div>   
                                <div class="pull-right">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >Add</button>
                                    </div>
                                </div>   
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                            $i=1; 
                                            $j=0;
                                        ?>
                                        <tbody>
                                            <?php if($product['installation_guide_images'] != ''){ ?>
                                            <?php $guide_images = explode(',', $product['installation_guide_images']); ?>
                                            <?php if(count($guide_images) > 0){ ?> 
                                            <?php foreach ($guide_images as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><img src="<?php echo IMAGE_URL.'products/products_multiple/thumbnail/'.$value; ?>" alt="product" id="imagePreview" style="width: 35px;"></td>
                                                <td style="display: inline-flex;">
                                                    <button data-i="<?php echo $j++; ?>" data-imgname="<?php echo $value ?>" class="btn btn-sm btn-danger delete img_delete">
                                                    <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>    
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } ?> 
                                        </tbody>
                                    </table>
                                </div>
                                <br/>
                                <hr>  
                                 <div class="form-group">
                                    <label class="control-label">Installation Guide Video</label>
                                    <input type="file" class="form-control" name="guide_video">
                                    <?php if($this->session->flashdata('guide_video')): ?>

                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <span><?php echo $this->session->flashdata('guide_video') ?></span>
                                    </div>
                                    <?php endif ?>
                                     
                                   
                                    <?php
                                        if($product['installation_guide_videos'] != ''){ 
                                        $videos=explode(',', $product['installation_guide_videos']);     $i=1; 
                                        if(count($videos) > 0){ 
                                        foreach ($videos as $key => $values) { 
                                    ?> 
                                    <video width="320" height="240" controls>
                                      <source src="<?php echo IMAGE_URL.'products/product_video/'.$values; ?>" type="video/WebM">
                                      Sorry, your browser doesn't support the video element.
                                    </video>
                                    <?php } } } ?>
                                </div>
                                <hr>        
                                <div id="attribute">
                                    <div class="pull-left">
                                        <h4><b><?php foreach ($attribute as $value) {
                                            echo $value; } ?></b></h4>
                                    </div> 
                                    <?php if (!empty($pro_attribute)) { ?>
                                   
                                    <div class="pull-right">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" id="addAttribute">New</button>
                                        </div>
                                    </div>   
                                    <br> 
                                        <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Attribute</th>
                                                <th>Price</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1; 
                                            $count = count($pro_attribute);
                                            foreach ($pro_attribute as $val) { 
                                                 $attr=$obj->attributemodel->get_attribute_by_id($val->att_id);
                                                 $attribute_name = $obj->attributemodel->get_attributname_by_att_id($attr->att_id);
                                            ?>
                                            <?php if(!empty($val->att_name)) {?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td>
                                                    <input type="text" class="form-control" value="<?php echo $val->att_name; ?>" id="<?php echo 'name_'.$val->id; ?>" disabled>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control"  value="<?php echo $val->att_value; ?>"  id="price_<?php echo $val->id; ?>" disabled>
                                                </td>
                                                <td style="display: inline-flex;">
                                                    <button class="btn btn-sm btn-info margin-5 edit" id="<?php echo $val->id; ?>">
                                                    <i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-info margin-5 update" id="<?php echo $val->id.'_update'; ?>" style="display:none">
                                                    <i class="fa fa-check"></i></button>
                                                    <?php if($count != 1){?>
                                                        <button class="btn btn-sm btn-danger delete" id="<?php echo $val->id.'_rm'; ?>">
                                                        <i class="fa fa-trash"></i></button>
                                                     <?php } ?>
                                                </td>
                                            </tr>   
                                             <?php } ?> 
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                   <?php  }  ?>
                                    
                                   <table class="table table-bordered table-striped">
                                        <tbody id="attr">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update" class="btn btn-sm btn-primary">
                            </div> 
                        <?php form_close();  ?>
                        </div>    
                        <!-- End image edit -->
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <!-- END add product form -->
        </div>
</div>
</div>
</section>
    <!-- end add category form -->
</div>
<!-- Modal -->
<div class="modal fade" id="productimage_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="<?php echo base_url('admin/add-product-image'); ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Product images</h4>
                </div>
                <div class="modal-body">
                    <p> <input type="file" class="form-control" name="new_product_files" multiple="multiple">
                    </p>
                </div>
                <div class="modal-footer">

                    <input type="submit" name="fileSubmit" value="Save" class="btn btn-sm btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end -->   
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="<?php echo base_url('admin/add-image'); ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Installation Guide images</h4>
                </div>
                <div class="modal-body">
                    <p> <input type="file" class="form-control" name="new_guide_files" multiple="multiple">
                    </p>
                </div>
                <div class="modal-footer">

                    <input type="submit" name="fileSubmit" value="Save" class="btn btn-sm btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end -->
<script type="text/javascript">
$(document).ready(function(){
    var cat_id = '<?php echo $product['category']; ?>';
    var subcat_id = '<?php echo $product['subcategory']; ?>';
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

var att_id;
var att_name = "<?php echo $attribute_name->att_name; ?>";
var i=0;
    $(document).ready(function(){
        $("#at_name").append(att_name);
        var i=1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">X</button></td></tr>');
            });
      
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id"); 
            $('#row'+button_id+'').remove();
        });

        $('#submit').click(function(){    
            $.ajax({
                url:"name.php",
                method:"POST",
                data:$('#add_name').serialize(),
                success:function(data)
                {
                   $('#add_name')[0].reset();
                }
            });
        });

        //image delete
         $(document).on('click', '.img_delete', function(){
            var img_index = $(this).data('i');
            var product_id="<?php echo $id; ?>";
            var imgname = $(this).data('imgname');
            $.ajax({
                url:"<?php echo base_url(); ?>admin/trash-image",
                method:"POST",
                data:{img_index:img_index,product_id:product_id,img_name:imgname},
                success:function(data)
                {
                    if(data == 1){
                        location.reload(true);
                    }
                }
            });
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
                           <button class="btn btn-sm btn-danger pro_remove" type="button"  id="'+i+'p_btn"><i class="fa fa-trash"></i></button>\
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

        $(document).on('click', '.productimg_delete', function(){
            var productimg_index = $(this).data('i');
            var product_id="<?php echo $id; ?>";
            var productimg_name = $(this).data('imgname');
            $.ajax({
               url:"<?php echo base_url(); ?>admin/trash-product-image",
               method:"POST",
               data:{productimg_index:productimg_index,product_id:product_id,productimg_name:productimg_name},
                success:function(data)
                {
                    if(data == 1){
                        location.reload(true);
                    }
                }
            });
        });

        $(document).on('click', '.about_product_delete', function(){
            var about_product_index = $(this).data('i');
            var product_id="<?php echo $id; ?>";
            var value = $(this).data('value');
            var key = $(this).data('key');
            $.ajax({
               url:"<?php echo base_url(); ?>admin/trash-about-product",
               method:"POST",
               data:{about_product_index:about_product_index,product_id:product_id,value:value,key:key},
                success:function(data)
                {
                    if(data == 1){
                        location.reload(true);
                    }
                }
            });
        });

        /******** edit product attribute **********/
        $(document).on('click', '#addAttribute', function(){
            var htnl = '<tr id='+i+'><td>'+i+'</td>\
                    <input name="<?php echo $att->att_name; ?>" type="">\
                    <td>\
                        <input type="text" class="form-control" id="att_val_'+i+'"  value="" autocomplete="off">\
                    </td>\
                    <td>\
                        <input type="number" id="pri_val_'+i+'" value="" class="form-control" autocomplete="off"></td>\
                    <td>\
                        <button class="btn btn-sm btn-primary add_attr_val " type="button" id="'+i+'_add">\
                        <i class="fa fa-plus"></i>\
                        </button>\
                        <button class="btn btn-sm btn-danger remove" id="'+i+'_remove">\
                            <i class="fa fa-trash"> </i>\
                        </button>\
                    </td></tr>';
          $("#attr").append(htnl);
           i++;
        });

        $(document).on('click', '.edit', function(){
            id = this.id;
            $('#name_'+id).prop("disabled", false);
            $("#price_"+id).prop("disabled", false);
            $(this).css("display","none");
            $('#'+id+'_update').css( "display", "block" );
        });

         $(document).on('click', '.update', function(){
            id = (this.id).slice(0,-7);
            var name = $('#name_'+id).val();
            var price = $('#price_'+id).val();
             if(name == '' || price == '')
            {
                alert("Please Enter Attribut Name & Price!!");
            }
            else
            {
            $.ajax({
                   url:"<?php echo base_url(); ?>admin/update-product-att",
                   method:"POST",
                   data:{id:id,name:name,price:price},
                   success:function(data)
                   {
                        location.reload("#attribute");
                   }
                });
            }
            $(this).css("display","none");
            $('#'+id).css( "display", "block" );
        });

        $(document).on("click",'.remove', function(e){
        var id = $(this).attr('id').slice(0,-7);
          $(this).closest('#'+id).remove();
          
        });

        /*add product attribute */
        $(document).on('click', '.add_attr_val', function(){
            var id =(this.id).slice(0,-4);
            var attribute_val = $('#att_val_'+id).val();
            var price_val = $('#pri_val_'+id).val();

            if(attribute_val == '' || price_val == '')
            {
                alert("Please Enter Attribut Name & Price!!");
            }
            else
            {
                var product_id="<?php echo $id; ?>";
                var att_id = "<?php echo $attr->att_id; ?>";
                $.ajax({
                   url:"<?php echo base_url(); ?>admin/add-product-att",
                   method:"POST",
                   data:{attribute_val:attribute_val,price_val:price_val,product_id:product_id,att_id:att_id},
                   success:function(data)
                   {
                        location.reload("#attribute");
                   }
                });
            }
        });

        /*delete product attribute */
       
        $(document).on('click', '.delete', function(){
            var id =(this.id).slice(0,-3);
            var product_id="<?php echo $id; ?>";
            if(id == 0)
             {
                
             }
             else
             {
                $.ajax({
                   url:"<?php echo base_url(); ?>admin/trash-product-attribute",
                   method:"POST",
                   data:{id:id,product_id:product_id},
                   success:function(data)
                   {
                    location.reload("#attribute");
                   }
                });
            }
        });
       
    });
</script>

<script>
   $(document).ready(function(){
     $(document).on('click', '#select_attr', function(){
        
       var att_id = $(this).val();
       var product_id="<?php echo $id; ?>";

       if(att_id != '')
       {
         $.ajax({
           url:"<?php echo base_url(); ?>admin/add-att",
           method:"POST",
           data:{
             att_id:att_id,product_id:product_id}
           ,
           success:function(data)
           {
            location.reload("#addAttribute");
           }
         });
       }
     });
   });
</script>