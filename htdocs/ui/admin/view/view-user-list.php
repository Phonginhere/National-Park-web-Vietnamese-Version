<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="/admin/user-add.php" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xóa') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <ul class="breadcrumb">
	    <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
	    <li><a href="/admin/user.php">Nhân Viên</a></li>
	  </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php $_SESSION['ERROR_TEXT']=NULL;?>
    <?php if ($_SESSION['SUCCESS_TEXT']) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $_SESSION['SUCCESS_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } $_SESSION['SUCCESS_TEXT']=NULL;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Danh Sách Nhân Viên</h3>
      </div>
      <div class="panel-body">
        <form action="/admin/user-delete.php" method="post" enctype="multipart/form-data" id="form-user">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td>Ảnh Đại Diện</td>

                  <td class="text-left">
                    <a href="<?php echo $sort_fullname; ?>" class="<?php if ($sort == 'fullname') echo strtolower($order); ?>">Tên Đầy Đủ</a>
                  </td>
                  
                  <td class="text-left">Chức Danh</td>

                  <td class="text-left">
                    <a href="<?php echo $sort_username; ?>" class="<?php if ($sort == 'username') echo strtolower($order); ?>">Tên Đăng Nhập</a>
                  </td>

                  <td class="text-left">
                    <a href="<?php echo $sort_status; ?>" class="<?php if ($sort == 'status') echo strtolower($order); ?>">Trạng thái</a>
                  </td>
                  
                  <td class="text-left">
                    <a href="<?php echo $sort_date_added; ?>" class="<?php if ($sort == 'date_added') echo strtolower($order); ?>">Ngày tạo</a>
                  </td>
                  <td class="text-right">Hành động</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($users) { ?>
                <?php foreach ($users as $user) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($user['user_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $user['user_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $user['user_id']; ?>" />
                    <?php } ?>
                  </td>
                  <td><img src="<?php echo $user['thumb']?>" height="48"/></td>
                  <td class="text-left"><?php echo $user['fullname']; ?></td>
                  <td class="text-left"><?php echo $user['job_title']; ?></td>
                  <td class="text-left"><?php echo $user['username']; ?></td>
                  <td class="text-left"><?php echo $user['status']; ?></td>
                  <td class="text-left"><?php echo $user['date_added']; ?></td>
                  <td class="text-right">
                  	<a href="<?php echo $user['edit']; ?>" data-toggle="tooltip" title="Sửa" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  	 <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $user['user_id'];?>\']').prop('checked', true);confirm('Bạn có chắc muốn xóa') ? $('#form-user').submit() : false;$('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5">Không tìm thấy kết quả nào</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row"><!-- Phân Trang, xem class.Paginator.php, sys.functions.php - paginate() -->
          <div class="col-sm-6 text-left"><?php echo $web_pagination_controls; ?></div>
          <div class="col-sm-6 text-right"><?php echo $web_pagination_results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
