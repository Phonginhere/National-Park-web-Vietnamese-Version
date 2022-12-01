<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="/admin/testimonial-add.php" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xóa') ? $('#form-testimonial').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/testimonial.php">Lời Chứng Thực</a></li>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> Danh Sách Lời Chứng Thực</h3>
      </div>
      <div class="panel-body">
        <form action="/admin/testimonial-delete.php" method="post" enctype="multipart/form-data" id="form-testimonial">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  
                  <td>Ảnh Đại Diện</td>

                    <td class="text-left"><?php if ($sort == 'name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>">Tên</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>">Tên</a>
                    <?php } ?></td>

                  <td class="text-left"><?php if ($sort == 'job') { ?>
                    <a href="<?php echo $sort_job; ?>" class="<?php echo strtolower($order); ?>">Nghề Nghiệp</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_job; ?>">Nghề Nghiệp</a>
                    <?php } ?></td>

                    <td class="text-left"><?php if ($sort == 'title') { ?>
                    <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>">Tiêu Đề</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_title; ?>">Tiêu Đề</a>
                    <?php } ?></td>

                  <td class="text-left"><?php if ($sort == 'status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>">Trạng thái</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>">Trạng thái</a>
                    <?php } ?></td>

                    <td class="text-right"><?php if ($sort == 'sort_order') { ?>
                    <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>">Trật tự sắp xếp</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_sort_order; ?>">Trật tự sắp xếp</a>
                    <?php } ?></td>

                    <!--
                  <td class="text-left"><?php if ($sort == 'date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>">Ngày tạo</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>">Ngày tạo</a>
                    <?php } ?></td>
                    -->

                  <td class="text-right">Hành động</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($testimonials) { ?>
                <?php foreach ($testimonials as $testimonial) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($testimonial['testimonial_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $testimonial['testimonial_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $testimonial['testimonial_id']; ?>" />
                    <?php } ?></td>
                 <td><img src="<?php echo $testimonial['thumb']?>" height="48"/></td>
                  <td class="text-left"><?php echo $testimonial['name']; ?></td>
                  <td class="text-left"><?php echo $testimonial['job']; ?></td>
                  <td class="text-left"><?php echo $testimonial['title']; ?></td>
                  <td class="text-left"><?php echo $testimonial['status']; ?></td>
                  <td class="text-right"><?php echo $testimonial['sort_order']; ?></td>


                  <!-- td class="text-left"><?php echo $testimonial['date_added']; ?></td -->

                  <td class="text-right">
                  	<a href="<?php echo $testimonial['edit']; ?>" data-toggle="tooltip" title="Sửa" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $testimonial['testimonial_id'];?>\']').prop('checked', true);confirm('Bạn có chắc muốn xóa') ? $('#form-testimonial').submit() : false; $('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
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
