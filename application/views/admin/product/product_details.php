<style type="text/css">
  .content_box{
    padding: 10px 9px;
    background: #eeeeee;
  }
</style>

<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php 
  $id=$this->uri->segment(3);
  $product=$this->productmodel->get_product_by_id($id);
  $this->db->where("product_id",$id);
  $qry=$this->db->get('qrcode');
  $qrcode=$qry->result_array();

  $this->db->where("product_id",$id);
  $qry1=$this->db->get('rating');
  $ratings=$qry1->result_array();
?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Product Details</h1>
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
           <!-- Main content -->
           <br>
          <section class="content">
              <div class="row">
                <div class="col-md-3">
                    <div class="box-body">
                      <?php $img_arr = explode(',',$product['product_image']) ?>
                      <img style="height:200px;width: 500px;" alt="" src="<?php echo IMAGE_URL.'products/product_images/original/'.$img_arr[0]; ?>" class="img-responsive">
                    </div>
                </div> 
                <div class="col-md-9">
                  <div class="nav-tabs-custom" style="box-shadow:none;">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#activity" data-toggle="tab">Details</a></li>
                      <li><a href="#images" data-toggle="tab">Images</a></li>
                      <?php if(!empty($qrcode)){ ?>
                      <li><a href="#qrcode" data-toggle="tab">Qrcode</a></li>
                      <?php } ?>
                      <li><a href="#tarings" data-toggle="tab">Ratings</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <form class="form-horizontal">
                            <div class="form-group">
                             <label for="inputName" class="col-sm-2 control-label">Name</label>
                              <div class="col-sm-10">
                                <div class="content_box">
                                  <?php echo $product['name']; ?>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail" class="col-sm-2 control-label" >Category</label>
                                   <?php $cate_name = $this->categorymodel->get_catname_by_id($product['category']); ?>
                                  <div class="col-sm-10">
                                    <div class="content_box">
                                      <?php echo $cate_name; ?>
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group">
                              <label for="inputSkills" class="col-sm-2 control-label">Subcategory</label>
                              <?php $subcategory = $this->subcategorymodel->get_subcatname_by_id($product['subcategory']); ?>
                              <div class="col-sm-10">
                                <div class="content_box">
                                  <?php echo $subcategory; ?>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputSkills" class="col-sm-2 control-label">Discription</label>
                              <div class="col-sm-10">
                                <div class="content_box">
                                  <?php echo $product['description']; ?>
                                </div>
                              </div>
                            </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="images">
                        <!-- The timeline -->
                        <div class="col-lg-12">
                           <?php $i=1; ?>
                           <?php foreach ($img_arr as $key => $values) { ?>
                              <img src="<?php echo IMAGE_URL.'products/product_images/thumbnail/'.$values; ?>" alt="product" id="imagePreview" style="width: 140px;">
                           <?php } ?>
                        </div>
                      </div>
                    <!-- /.tab-pane -->
                      <div class="tab-pane" id="qrcode" style="margin-top: -20px;">
                        <div style="margin-top: -48px;"> <a href="<?php echo site_url('admin/save-all-qr/'.$product['id']);?>"  target='_blank' class="btn btn-sm pull-right btn-info btn-danger" style="margin-right:15px;">View PDF</a></div>
                          <div class="col-lg-12"><br>
                            <?php foreach ($qrcode as $value) { ?>
                                <img src="<?php echo IMAGE_URL.'qr_image/'.$value['qr_image']; ?>" alt="qrcode" id="imagePreview" style="width: 112px;">
                            <?php } ?>
                          </div>
                        <!-- /.tab-pane -->
                      </div>

                      <div class="tab-pane" id="tarings">
                        <div class="col-lg-12">
                          <table id="table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>#</th> 
                              <th>Rating</th>
                              <th>Name</th>
                              <th>Designationy</th>
                              <th>City</th>
                              <th>Review</th>               
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($ratings)){ ?>  
                              <?php $i=1; ?>
                                <?php foreach($ratings as $row) { ?>
                                  <tr> 
                                    <td><?php echo $i++; ?></td>
                                    <td><i class="fa fa-star text-yellow"></i> <?php echo $row['rating']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['designation']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['review']; ?></td>
                                  </tr>                  
                                <?php } ?>    
                            <?php } ?>
                          </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
           </section>
            <!-- /.content -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
        <!-- /.col -->
  </section>
</div>

<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $("#table").DataTable(); 
  });
</script>