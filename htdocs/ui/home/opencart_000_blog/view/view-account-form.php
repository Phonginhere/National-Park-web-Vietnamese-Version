<div class="container">
  <ul class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i></a></li>
        <li><a href="/account.php">Tài Khoản</a></li>
        <?php if(isset($_GET['cid'])) {?>
        <li><a href="/account-edit.php?cid=<?php echo $_GET['cid']; ?>">Sửa</a></li>
        <?php } else {?>
        <li><a href="/register.php">Đăng Kí</a></li>
        <?php }?>
        
      </ul>
    <div class="row">                
     <div id="content" class="col-sm-9">      
     <h1><?php echo $form_title;?></h1>
      <?php if ($_SESSION['ERROR_TEXT']) {?>
      	<div class="alert alert-danger">
        	<i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo $_SESSION['ERROR_TEXT']?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      <?php }?>
      <?php unset($_SESSION['ERROR_TEXT']);?>
      <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
          <legend>Thông Tin Cá Nhân</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-fullname">Họ và Tên</label>
            <div class="col-sm-10">
              <input name="fullname" value="<?php echo $fullname; ?>" placeholder="Tên" id="input-fullname" class="form-control" type="text">
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
            <div class="col-sm-10">
              <input name="email" value="<?php echo $email; ?>" placeholder="E-Mail" id="input-email" class="form-control" type="email">
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-telephone">Điện thoại</label>
            <div class="col-sm-10">
              <input name="telephone" value="<?php echo $telephone; ?>" placeholder="Điện thoại" id="input-telephone" class="form-control" type="tel">
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1">Địa chỉ</label>
            <div class="col-sm-10">
              <input name="address" value="<?php echo $address; ?>" placeholder="Địa chỉ" id="input-address-1" class="form-control" type="text">
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Thông Tin Đăng Nhập</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-password">Mật khẩu</label>
            <div class="col-sm-10">
              <input name="password" value="<?php echo $password;?>" placeholder="Password" id="input-password" class="form-control" type="password">
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-confirm">Xác nhận</label>
            <div class="col-sm-10">
              <input name="confirm_password" value="<?php echo $confirm_password;?>" placeholder="Xác nhận mật khẩu" id="input-confirm" class="form-control" type="password">
                          </div>
          </div>
        </fieldset>
       
                <div class="buttons">
          <div class="pull-right">                        
            <input value="Tiếp Tục" class="btn btn-primary" type="submit">
          </div>
        </div>
        <input type="hidden" name="status" value="<?php echo $customer_status;?>" />
       </form>
      </div>
    <?php include_once "view/view-account-box.php" ?>
</div>
</div>