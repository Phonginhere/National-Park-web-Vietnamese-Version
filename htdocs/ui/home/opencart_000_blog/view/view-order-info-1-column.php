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
          <td style="width: 50%;"><address>
            <strong><?php echo $order['store_name']; ?></strong><br />
            <?php echo $order['store_address']; ?>
            </address>
            <b>Điện thoại:</b> <?php echo $order['store_telephone']; ?><br />
            <b>Email:</b> <?php echo $order['store_email']; ?><br />
            <b>Website:</b> <a href="<?php echo $order['store_url']; ?>"><?php echo $order['store_url']; ?></a></td>
          <td style="width: 50%;"><b>Ngày tạo:</b> <?php echo $order['date_added']; ?><br />
            <?php if ($order['invoice_no']) { ?>
            <b>Số hóa đơn:</b> <?php echo $order['invoice_no']; ?><br />
            <?php } ?>
            <b>ID Đơn hàng</b> <?php echo $order['order_id']; ?><br />
            <b>Phương thức thanh toán:</b> <?php echo $order['payment_method']; ?><br />
            <?php if ($order['shipping_method']) { ?>
            <b>Phương thức giao nhận:</b> <?php echo $order['shipping_method']; ?><br />
            <?php } ?></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td style="width: 50%;"><b>Nơi Nhận Hàng &amp; Thanh Toán:</b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><address>
            <?php echo $order['shipping_address']; ?>
            </address></td>
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
	        <?php foreach ($order['product'] as $product) { ?>
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
	      		<td style="text-align:right"><b><?php echo number_format($order_info['total'],0,'.',',').' ₫';?></b></td>
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
    <?php if ($order['histories'])?>
    <h3>Lịch Sử Đơn Hàng</h3>
    <table class="table table-bordered">
	  <thead>
	    <tr>
	      <th class="text-left">Ngày Tạo</th>
	      <th class="text-left">Ghi Chú</th>
	      <th class="text-left">Trạng Thái</th>
	      <th class="text-left">Thông Báo</th>
	    </tr>
	  </thead>
	  <tbody>
	    <?php foreach ($order['histories'] as $history) { ?>
	    <tr>
	      <td class="text-left"><?php echo $history['date_added']; ?></td>
	      <td class="text-left"><?php echo $history['comment']; ?></td>
	      <td class="text-left"><?php echo $history['status']; ?></td>
	      <td class="text-left"><?php echo $history['notify']; ?></td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
    <?php ?>
    
    <div class="buttons clearfix">
      <div class="pull-right"><a href="/order-history.php" class="btn btn-primary">Tiếp Tục</a></div>
     </div>
  </div>
</div>