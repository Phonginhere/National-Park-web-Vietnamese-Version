<!DOCTYPE html><?php  include_once $_SERVER["DOCUMENT_ROOT"].'/configs.php'; ?>
<html dir="ltr" lang="vi">
<head>
<meta charset="UTF-8" />
<title>Hóa Đơn</title>
<base href="/home.php" />
<link href="/ui/src/css/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
<link href="/ui//src/css/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="/ui//src/css/style-admin.css" rel="stylesheet" type="text/css" media="all" rel="stylesheet" />
<script src="/<?php echo URL_URI ?>/src/css/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>

</head>
<body>
<div class="container">
  <div style="page-break-after: always;">
    <h1>Hóa đơn #<?php echo $order['order_id']; ?></h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td colspan="2">Chi tiết hóa đơn</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%;"><address>
            <strong><?php echo web_name(); ?></strong><br />
            <?php echo store_address(); ?>
            </address>
            <b>Điện thoại:</b> <?php echo $order['store_telephone']; ?><br />
            <b>Email:</b> <?php echo web_email(); ?><br />
            <b>Website:</b> <a href="<?php echo web_url(); ?>"><?php echo web_url(); ?></a></td>
          <td style="width: 50%;"><b>Ngày tạo:</b> <?php echo $order['date_added']; ?><br />
            <?php if ($order['invoice_no']) { ?>
            <b>Số hóa đơn:</b> <?php echo $order['invoice_no']; ?><br />
            <?php } ?>
            <b>ID Đơn hàng</b> <?php echo $order['order_id']; ?><br />
            <b>Người nhận:</b> <?php echo $order['fullname']; ?><br />
            <b>Địa chỉ:</b> <?php echo $order['address']; ?><br />
            <b>Phương thức thanh toán:</b> Giao hàng nhận tiền.<br />
            <b>Phương thức giao nhận:</b> Vận chuyển thông thường.<br />
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td style="width: 50%;"><b>Nơi nhận hàng và thanh toán:</b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><address>
            <?php echo $order['address']; ?>
            </address></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b>Sản phẩm</b></td>
          <td><b>Model</b></td>
          <td class="text-right"><b>Số lượng</b></td>
          <td class="text-right"><b>Giá</b></td>
          <td class="text-right"><b>Tổng tiền</b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($order['products'] as $product) { ?>
        <tr>
          <td><?php echo $product['name']; ?>
          <td><?php echo $product['model']; ?></td>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
          <td class="text-right"><?php echo $product['price']; ?></td>
          <td class="text-right"><?php echo $product['total']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
      	<tr>
      		<td colspan="4" style="text-align:right"><b>Tổng giá trị đơn hàng:</b></td>
      		<td style="text-align:right"><b><?php echo $order['total'];?></b></td>
      	</tr>
      </tfoot>
    </table>
    <?php if ($order['comment']) { ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b>Ghi chú</b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $order['comment']; ?></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>
  </div>
</div>
</body>
</html>