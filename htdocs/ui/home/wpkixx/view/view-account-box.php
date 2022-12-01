<column id="column-right" class="col-sm-3 hidden-xs">
 <div class="list-group">
    
    <a href="/home.php" class="list-group-item active"><i class="fa fa-home"></i>&nbsp;Trang Chủ</a>
    <a href="/cart.php" class="list-group-item"><i class="fa fa-shopping-cart"></i>&nbsp;Giỏ Hàng</a>
    <a href="/cart.php" class="list-group-item"><i class="fa fa-check"></i>&nbsp;Checkout</a>
    
    <?php if (isset ($_SESSION['CUS_LOGGED'])) { ?>
    <a href="/logout.php" class="list-group-item"><i class="fa fa-sign-out"></i>&nbsp;Đăng Thoát</a>
    <a href="/account.php" class="list-group-item"><i class="fa fa-user"></i>&nbsp;Tài Khoản Của Tôi</a>
    <a href="/account-edit.php?cid=<?php echo $_SESSION['CUS_LOGGED']; ?>" class="list-group-item"><i class="fa fa-edit"></i>&nbsp;Sửa thông tin tài khoản</a>
    <a href="/order-history.php" class="list-group-item"><i class="fa fa-list"></i>&nbsp;Lịch Sử Đơn Hàng</a>
    <?php } else {?>
    <a href="/login.php" class="list-group-item"><i class="fa fa-sign-in"></i>&nbsp;Đăng Nhập</a> 
    <a href="/register.php" class="list-group-item"><i class="fa fa-file-text"></i>&nbsp;Đăng Kí</a>
    <a href="#forgotten" class="list-group-item" onclick="alert('Đang xây dựng, bạn vui lòng quay lại sau !')"><i class="fa fa-question"></i>&nbsp;Quên Mật Khẩu</a>
    
    <?php }?> 
    <!-- 
    <a href="#return" class="list-group-item">Returns</a> 
    <a href="#transaction" class="list-group-item">Transactions</a> 
    -->
 </div>
</column>
