<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
       <a href="<?php echo $url_invoice; ?>" target="_blank" data-toggle="tooltip" title="In hóa đơn" class="btn btn-info"><i class="fa fa-print"></i></a> 
       <a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
	    <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
	    <li><a href="/admin/order.php">Đơn Hàng</a></li>
	  </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Đơn hàng</h3>
      </div>
      <div class="panel-body">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-order" data-toggle="tab">Chi Tiết Đơn Hàng</a></li>
          <li><a href="#tab-product" data-toggle="tab">Sản Phẩm</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab-order">
            <table class="table table-bordered">
              <tr>
                <td>ID Đơn Hàng</td>
                <td>#<?php echo $order_info['order_id']; ?></td>
              </tr>
             
              <tr>
                <td>Khách hàng</td>
                <td>
                	<?php if ($order_info['customer_id']) { ?>
                	<a href="/admin/customer-edit.php?customer_id=<?php echo $order_info['customer_id']; ?>" target="_blank">
                		<?php echo $order_info['fullname']; ?>
                	</a>
                	<?php } else { ?>
                		<?php echo $order_info['fullname']; ?>	
                	<?php } ?>
                </td>
              </tr>
              
              <tr>
                <td>Địa chỉ</td>
                <td><?php echo $order_info['address']; ?></td>
              </tr>
              
              <tr>
                <td>Email</td>
                <td><a href="mailto:<?php echo $order_info['email']; ?>"><?php echo $order_info['email']; ?></a></td>
              </tr>
              <tr>
                <td>Điện thoại</td>
                <td><?php echo $order_info['telephone']; ?></td>
              </tr>
              <tr>
                <td>Tổng giá trị đơn hàng</td>
                <td><?php echo number_format($order_info['total'],0,'.',',').' ₫'; ?></td>
              </tr>
             
              <?php if ($order_info['comment']) { ?>
              <tr>
                <td>Chú Thích</td>
                <td><?php echo nl2br($order_info['comment']); ?></td>
              </tr>
              <?php } ?>
              
              <tr>
                <td>Ngày tạo</td>
                <td><?php echo date("d/m/Y", strtotime($order_info['date_added'])); ?></td>
              </tr>
            </table>
          </div>
          
          <div class="tab-pane" id="tab-product">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td class="text-left">Sản Phẩm</td>
                  <td class="text-left">Model</td>
                  <td class="text-right">Số lượng</td>
                  <td class="text-right">Đơn Giá</td>
                  <td class="text-right">Tổng tiền</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($products as $product) { ?>
                <tr>
                  <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                  <td class="text-left"><?php echo $product['model']; ?></td>
                  <td class="text-right"><?php echo $product['quantity']; ?></td>
                  <td class="text-right"><?php echo $product['price']; ?></td>
                  <td class="text-right"><?php echo $product['total']; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="tab-history">
            <div id="history"></div>
            <br />
            <fieldset>
              <legend>Lịch sử đơn hàng</legend>
              <form class="form-horizontal">
               
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-notify">Gửi thông báo</label>
                  <div class="col-sm-10">
                    <input type="checkbox" name="notify" value="1" id="input-notify" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-comment">Ghi chú</label>
                  <div class="col-sm-10">
                    <textarea name="comment" rows="8" id="input-comment" class="form-control"></textarea>
                  </div>
                </div>
              </form>
              <div class="text-right">
                <button id="button-history" data-loading-text="Đang tải" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Thêm mới lịch sử</button>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
