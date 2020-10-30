<footer class="main-footer">
     <strong>  Copyright © Zuma Corporation 2019 </strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script src="<?=base_url('public')?>/components/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url('public')?>/components/PACE/pace.min.js"></script>
<script src="<?=base_url('public')?>/components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url('public')?>/components/fastclick/lib/fastclick.js"></script>
<script src="<?=base_url('public')?>/dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
  })
  $(document).ajaxStart(function () {
    Pace.restart();
  });
</script>
</body>
</html>
