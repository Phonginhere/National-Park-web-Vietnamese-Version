<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="/cart.php">Giỏ Hàng</a></li>
  </ul>
  
  <?php if (cartHasProducts()) {?>
  <div class="row">
    <div id="content" class="col-sm-12">
      <h1>Xem Giỏ Hàng</h1>
      <form action="/cart-edit.php" method="post" enctype="multipart/form-data">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">Ảnh</th>
                <th class="text-left">Tên Sản Phẩm</th>
                <th class="text-left">Model</th>
                <th class="text-left">Số Lượng</th>
                <th class="text-right">Giá Mỗi Sản Phẩm</th>
                <th class="text-right">Tổng Tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (cartGetProductsWithFormat() as $product) { ?>
              <tr>
                <td class="text-center"><?php if ($product['thumb']) { ?>
                  <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
                  <?php } ?></td>
                <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                  <?php if (!$product['stock']) { ?>
                  <span class="text-danger">***</span>
                  <?php } ?>
                  
                  </td>
                <td class="text-left"><?php echo $product['model']; ?></td>
                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="quantity[<?php echo $product['product_id']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
                    <span class="input-group-btn">
                    <button type="submit" data-toggle="tooltip" title="Cập Nhật" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                    <button type="button" data-toggle="tooltip" title="Xóa Bỏ" class="btn btn-danger" onclick="cart.remove('<?php echo $product['product_id']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>
                <td class="text-right"><?php echo $product['price']; ?></td>
                <td class="text-right"><?php echo $product['total']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
		     <tr>
				<td colspan="5" class="text-right"><strong>Tổng giá trị đơn hàng:</strong></td>
				<td class="text-right"><?php echo cartGetTotalWithFormat(); ?></td>
				</tr>
			</tfoot>
          </table>
        </div>
      </form>
      
      <br />
      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
            <?php foreach ($totals as $total) { ?>
            <tr>
              <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
              <td class="text-right"><?php echo $total['text']; ?></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      
      <div class="buttons">
        <div class="pull-left"><a href="/home.php" class="btn btn-default">Tiếp tục mua sắm</a></div>
        <div class="pull-right"><a href="/checkout.php" class="btn btn-primary">Thanh toán</a></div>
      </div>
      </div>
    </div>
    <?php }else { ?>
    	<div class="row">Giỏ hàng trống</div><!-- @todo tìm ảnh empty cart quẳng vào đây -->
    <?php }?>
</div><!-- end .container -->
