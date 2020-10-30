<?php 
$id=$this->uri->segment(3);
$user=$this->usermodel->get_user_by_id($id);
$tr_history= $this->usermodel->transfer_history_by_id($id);
$qr_history= $this->usermodel->qr_history_by_id($id);
?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>User Details</h1>
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
            <section class="content">
              <div class="row">
                <div class="col-md-3">
                  <!-- Profile Image -->
                  <div>
                    <div class="box-body">
                      <img style="height:200px;width: 500px;" alt="" src="<?php echo IMAGE_URL.'user/'.$user['image']; ?>" class="img-responsive">
                  </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div> 
                <div class="col-md-9">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#activity" data-toggle="tab">Details</a></li>
                      <li><a href="#tr_history" data-toggle="tab">Transfer History</a></li>
                      <?php if($user['type']=='carpenter'){?>
                      <li><a href="#qrcode" data-toggle="tab">QR History</a></li>
                    <?php }?>
                   </ul>
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <form class="form-horizontal">
                                    <div class="form-group">
                                     <label for="inputName" class="col-sm-2 control-label">First Name</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Name" value="<?php echo $user['first_name']; ?>" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputEmail" class="col-sm-2 control-label" >Last Name</label>
                                        <div class="col-sm-10">
                                          
                                          <td></td>
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Category" value="<?php echo $user['last_name']; ?>" disabled>
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label for="inputSkills" class="col-sm-2 control-label">Mobile</label>

                                      <div class="col-sm-10">
                                        
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Subcategory" value="<?php echo $user['mobile_no']; ?>" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputSkills" class="col-sm-2 control-label">Email</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Discription" value="<?php echo $user['email']; ?>" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputSkills" class="col-sm-2 control-label">Password</label>
                                      <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputSkills" placeholder="Prise" value="<?php echo $user['password']; ?>" disabled>
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label for="inputSkills" class="col-sm-2 control-label">Address</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Prise" value="<?php echo $user['address']; ?>" disabled>
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label for="inputSkills" class="col-sm-2 control-label">Adhar Number</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Prise" value="<?php echo $user['aadhar_no']; ?>" disabled>
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label for="inputSkills" class="col-sm-2 control-label">Type</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Prise" value="<?php echo $user['type']; ?>" disabled>
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label for="inputSkills" class="col-sm-2 control-label">Point</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Prise" value="<?php echo $user['point']; ?>" disabled>
                                      </div>
                                    </div>
                                  </form>
                      </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tr_history">
                <!-- The timeline -->
               <div class="box-body table-responsive">
                  <table id="transaction_table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Frome Name</th>
                      <th>To Name</th>
                      <th>Point</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if(!empty($tr_history)){ 
                      $i = 1;
                    ?>  
                    <?php foreach($tr_history as $row) { ?>
                      <tr style="background-color:<?php echo($row->status == 'credit')?'#aef7d6':'#f7baba'; ?> ">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row->from_name; ?></td>
                            <td><?php echo $row->to_name; ?></td>
                            <td><?php echo $row->point; ?></td>
                            <td><?php echo $row->transfer_date; ?></td>
                            <td><?php echo $row->status; ?></td>
                      </tr>                  
                    <?php } ?>    
                    <?php } ?>
                    </tbody>
                  </table>
            </div>
          </div>
              <!-- /.tab-pane -->

            <div class="tab-pane" id="qrcode">
              <div class="box-body table-responsive">
              <table id="qr_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Product Name</th>
                  <th>Unique Id</th>
                  <th>Point</th>
                  <th>Status</th>
                  <th>Qrcode</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($qr_history)){ 
                  $i = 1;
                ?>  
                <?php foreach($qr_history as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                  
                        <td><?php echo $row->scan_date; ?></td>
                         <td>
                      <img src="<?php echo UPLOAD_PATH."products/product_images/".$row->product_image; ?>" style="height: 35px;width: 35px;border-radius:40px; "> <?php echo $row->product_name; ?>
                        </td>
                        <td><?php echo $row->uniqueid; ?></td>
                        <td><?php echo $row->point; ?></td>
                        <td><?php echo $row->status; ?></td>
                        <td><a href="<?php echo UPLOAD_PATH."qr_image/".$row->qr_image; ?>" style="color: black;" target='_blank'> <button  type="button" class="btn btn-dark " >
                            <i class="fa fa-qrcode"></i>
                          </button></a></td>
                          </tr>                  
                        <?php } ?>    
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                      <!-- /.tab-pane -->
                </div>
                    <!-- /.tab-content -->
              </div>
                  <!-- /.nav-tabs-custom -->
            </div>
                  <!-- /.col -->
            </div>
                <!-- /.row -->
            </section>
              <!-- /.content -->
            </div>
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
<script type="text/javascript">
  $(function(){
    $("#transaction_table").DataTable();
  });
   $(function(){
    $("#qr_table").DataTable();
  });
</script>