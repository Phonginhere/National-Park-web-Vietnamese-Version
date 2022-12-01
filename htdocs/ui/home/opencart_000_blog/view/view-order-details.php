<div class="container">
 <div style="page-break-after: always;">
  <h1>Thông Tin Hóa Đơn</h1>
   <table class="table table-bordered">
    <thead>
     <tr>
      <td colspan="2"><b>Chi Tiết Hóa Đơn</b></td>
     </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%;">
            <address>
            Cửa hàng <strong><?php echo web_name(); ?></strong><br />
            <?php echo store_address(); ?>
            </address>
            <b>Điện thoại:</b> <?php echo web_telephone(); ?><br />
            <b>Email:</b> <?php echo web_email(); ?><br />
            <b>Website:</b> <a href="<?php echo web_url(); ?>"><?php echo web_url(); ?></a>
          </td>
          <td style="width: 50%;">
            <b>Ngày tạo:</b> <?php echo $order['date_added']; ?><br />
            <b>ID Đơn hàng:</b> <?php echo $order['order_id']; ?><br />
            <b>Khách hàng:</b> <?php echo $order['fullname']; ?><br />
            <b>Địa chỉ:</b> <?php echo $order['address']; ?><br />
            <b>Phương thức thanh toán:</b> Giao hàng chuyển tiền.<br />
            <b>Phương thức giao nhận:</b> Vận chuyển thông thường.<br />
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Mỗi bảng responsive phải có một thẻ div riêng để chứa -->
    <!-- Không chứa nhiều bảng trong một thẻ -->
    <div class="table-responsive">
	    <table class="table table-bordered">
	      <thead>
	        <tr>
	          <td><b>Sản Phẩm</b></td>
	          <td><b>Model</b></td>
	          <td class="text-right"><b>Số Lượng</b></td>
	          <td class="text-right"><b>Đơn Giá</b></td>
	          <td class="text-right"><b>Tổng Tiền</b></td>
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
    </div>
    <?php if ($order['comment']) { ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b>Ghi Chú</b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $order['comment']; ?></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>
    <div class="buttons clearfix">
      <div class="pull-right"><a href="/order-history.php" class="btn btn-primary">Tiếp Tục</a></div>
     </div>
  </div>
</div>