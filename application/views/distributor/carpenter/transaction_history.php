<?php
$obj=&get_instance();
$user_id = $this->uri->segment(3);
$history = $this->dealermodel->dealer_transfer_history_by_id($user_id);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Carpenter Transaction History</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
           <div class="box">
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
         </div>
          <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="transaction_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Frome Name</th>
                  <th>To Name</th>
                  <th>Point</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($history)){ 
                  $i = 1;
                ?>  
                <?php foreach($history as $row) { ?>
                  <tr style="background-color:<?php echo($row->status == 'credit')?'#aef7d6':'#f7baba'; ?> ">
                        <td><?php echo $i++; ?></td>
                        <td><?php echo date("d M, Y",strtotime($row->transfer_date)); ?></td>
                        <td><?php echo $row->from_name; ?></td>
                        <td><?php echo $row->to_name; ?></td>
                        <td><?php echo $row->point; ?></td>
                        <td><?php echo ucfirst($row->status); ?></td>
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
<script type="text/javascript">
  $(function(){
    $("#transaction_table").DataTable();
  });
  
</script>


