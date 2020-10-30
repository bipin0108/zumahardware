<?php  
  $obj=&get_instance();
  $id = $this->uri->segment(3);
  $count = $this->qrmodel->get_qrcode_by_count($id);
  $point = $this->qrmodel->get_qrcode_by_point($id);
  $qr = $this->qrmodel->get_qrcode_by_product_id($id,$count);
  $product = $this->productmodel->get_product_by_id($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome TO Qrcode PDF</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url('public')?>/css/bootstrap.min.css">
  <script src="<?=base_url('public')?>/amcharts/jquery.min.js"></script>
  <script src="<?=base_url('public')?>/js/bootstrap.min.js"></script>
</head>
<body>
  <h4>QR Code - <?php echo $product['name']; ?> (<?php echo $count; ?>) Point - (<?php echo $point; ?>)</h4>
  <hr>

  <?php foreach ($qr as $value) { ?>
    <img src="<?php echo IMAGE_URL.'qr_image/'.$value['qr_image']; ?>" alt="qrcode" id="imagePreview" style="width: 88px;">
  <?php } ?>

</body>
</html>