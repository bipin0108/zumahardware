<!-- not direct access -->
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- load header -->
<?php $this->load->view('distributor/include/header');?>

<!-- load topbar -->
<?php $this->load->view('distributor/include/topbar');?>

<!-- load sidebar -->
<?php $this->load->view('distributor/include/sidebar');?>

<!-- load content -->
<?php $this->load->view('distributor/'.$page); ?>

<!-- load footer -->
<?php $this->load->view('distributor/include/footer');?>
