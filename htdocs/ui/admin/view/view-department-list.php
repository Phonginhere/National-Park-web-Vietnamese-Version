<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      	<a href="/admin/department-add.php" data-toggle="tooltip" title="Thêm Mới" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
        <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('Bạn có chắc là muốn xóa ?') ? $('#form-department').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <!-- 
      <h1>Danh Mục Sản Phẩm</h1>
      -->
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/department.php">Phòng Ban</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
  	<?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } $_SESSION['ERROR_TEXT'] = null;?>
    <?php if ($_SESSION['SUCCESS_TEXT']) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $_SESSION['SUCCESS_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } $_SESSION['SUCCESS_TEXT'] = null;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i>Danh Sách Phòng Ban</h3>
      </div>
      <div class="panel-body">
        <form action="/admin/department-delete.php" method="post" enctype="multipart/form-data" id="form-department">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox"></td>
                  <td class="text-left">                    
                     <a href="<?php echo $sort_department_id; ?>" class="<?php if ($sort == 'department_id') { echo strtolower($order); }?>">Mã</a>
                  </td>
                  <td class="text-left">                    
                     <a href="<?php echo $sort_name; ?>" class="<?php if ($sort == 'name') { echo strtolower($order); }?>">Phòng Ban</a>
                  </td>
                  <td class="text-right">
                     <a href="<?php echo $sort_sort_order; ?>" class="<?php if ($sort == 'sort_order') { echo strtolower($order); } ?>">Trật Tự Sắp Xếp</a>
                  </td>
                  <td class="text-right">Hành Động</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($departments) {?>
                <?php foreach ($departments as $department) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($department['department_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $department['department_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $department['department_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $department['department_id']; ?></td>
                  <td class="text-left"><?php echo $department['name']; ?></td>
                  <td class="text-right"><?php echo $department['sort_order']; ?></td>
                  <td class="text-right">
                  	<a href="<?php echo $department['edit']; ?>" data-toggle="tooltip" title="Sửa" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $department['department_id'];?>\']').prop('checked', true);confirm('Bạn có chắc là muốn xóa ?') ? $('#form-department').submit() : false;$('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="4">Không tìm thấy kết quả nào</td>
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