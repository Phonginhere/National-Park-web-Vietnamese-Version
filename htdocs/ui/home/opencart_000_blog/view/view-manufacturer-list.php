<div class="container">
  <ul class="breadcrumb">
    <li> <a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a> </li>
    <li> <a href="/manufacturer-list.php">Thương Hiệu</a> </li>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12">
      <h1>Tìm thương hiệu bạn yêu thích</h1>
      <?php if ($manufacturers) { ?>
      <p><strong>Danh mục thương hiệu</strong>
        <?php foreach ($manufacturers as $brand) { ?>
        &nbsp;&nbsp;&nbsp;<a href="/manufacturer-list.php#<?php echo $brand['name']; ?>"><?php echo $brand['name']; ?></a>
        <?php } ?>
      </p>
      <?php foreach ($manufacturers as $brand) { ?>
      <h2 id="<?php echo $brand['name']; ?>"><?php echo $brand['name']; ?></h2>
      <?php if ($brand['manufacturer']) { ?>
      <?php foreach (array_chunk($brand['manufacturer'], 4) as $manufacturers) { ?>
      <div class="row">
        <?php foreach ($manufacturers as $manufacturer) { ?>
        <div class="col-sm-3"><a href="<?php echo $manufacturer['href']; ?>"><?php echo $manufacturer['name']; ?></a></div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php } ?>
      <?php } ?>
      <?php } else { ?>
      <p>Không tìm thấy thương hiệu nào</p>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="/home.php" class="btn btn-primary">Tiếp tục</a></div>
      </div>
      <?php } ?>
      </div>
    </div>
</div>
