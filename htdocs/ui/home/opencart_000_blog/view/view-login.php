<div class="container">
  <ul class="breadcrumb">
        <li><a href="/home.php"><i class="fa fa-home"></i></a></li>
        <li><a href="/account.php">Tài khoản</a></li>
        <li><a href="/login.php">Đăng nhập</a></li>
      </ul>
      <div class="row">                <div id="content" class="col-sm-9">      <div class="row">
        <div class="col-sm-6">
          <div class="well">
            <h2>Khách Hàng Mới</h2>
            <p><strong>Đăng kí tài khoản</strong></p>
            <p>Tạo tài khoản để mua sắm nhanh hơn, cập nhật với trạng thái của đơn hàng, và theo dõi các đơn hàng bạn đã tạo trước đó.</p>
            <a href="/register.php" class="btn btn-primary">Tiếp tục</a></div>
        </div>
        <div class="col-sm-6">
          <div class="well">
            <h2>Đã có Tài Khoản</h2>
            <p><strong>Tôi là khách hàng cũ</strong></p>
            <?php if ($_SESSION['ERROR_TEXT']) {?>
		      	<div class="alert alert-danger">
		        	<i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo $_SESSION['ERROR_TEXT']?>
		            <button type="button" class="close" data-dismiss="alert">&times;</button>
		        </div>
		    <?php }?>
		    <?php unset($_SESSION['ERROR_TEXT']);?>
            <form action="/login.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label" for="input-email">E-Mail</label>
                <input name="email" value="<?php echo $_SESSION['FAILED_EMAIL'];?>" placeholder="E-Mail" id="input-email" class="form-control" type="text">
              </div>
              <div class="form-group">
                <label class="control-label" for="input-password">Mật khẩu</label>
                <input name="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>" placeholder="Password" id="input-password" class="form-control" type="password">
                <a href="#account/forgotten">Quên mật khẩu</a></div>
              <input value="Đăng nhập" class="btn btn-primary" type="submit">
              <input type="hidden" name="ru" value="<?php echo $_GET['ru'];?>">
        	  <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : "";?>">
           </form>
          </div>
        </div>
      </div>
      </div>
    <?php include_once "view/view-account-box.php" ?>
</div>
</div>