<div id="cart" class="btn-group btn-block">
  <button type="button" data-toggle="dropdown" data-loading-text="Đang tải..." class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="fa fa-shopping-cart"></i> <span id="cart-total"><?php echo cartGetTextCountAndTotal(); ?></span></button>
  <ul class="dropdown-menu pull-right">
    <li>
      <table class="table table-striped">
        <?php foreach (cartGetProductsWithFormat() as $product) { ?>
        <tr>
          <td class="text-center"><?php if ($product['thumb']) { ?>
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
            <?php } ?></td>
          <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          
          <td class="text-right">x <?php echo $product['quantity']; ?></td>
          <td class="text-right"><?php echo $product['total']; ?></td>
          <td class="text-center"><button type="button" onclick="cart.remove('<?php echo $product['product_id'];?>');" title="Gỡ bỏ" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
        </tr>
        <?php } ?>
      </table>
    </li>
    <li>
      <div>
        <table class="table table-bordered">
          <tr>
            <td class="text-right"><strong>Tổng giá trị:</strong></td>
            <td class="text-right"><?php echo cartGetTotalWithFormat(); ?></td>
          </tr>
        </table>
        <p class="text-right"><a href="/cart.php"><strong><i class="fa fa-shopping-cart"></i> Xem giỏ hàng</strong></a>&nbsp;&nbsp;&nbsp;<a href="/checkout.php"><strong><i class="fa fa-share"></i> Thanh Toán</strong></a></p>
      </div>
    </li>
  </ul>
</div>
