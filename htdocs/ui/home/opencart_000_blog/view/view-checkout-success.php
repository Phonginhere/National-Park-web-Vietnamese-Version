<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12">
      <h1>Đơn hàng của bạn đã được đặt</h1>
      <p>Đơn hàng của bạn đã được xử lý thành công!</p>
	  <p>Nếu có bất kỳ thắc mắc nào, bạn vui lòng gửi về cho chủ <a href="/contact.php">cửa hàng</a>.</p>
	  <p>Cảm ơn quý khách đã tham gia mua hàng online !</p>
      <div class="buttons">
        <div class="pull-right"><a href="/home.php" class="btn btn-primary">Tiếp tục</a></div>
      </div>
     </div>
    </div>
</div>
