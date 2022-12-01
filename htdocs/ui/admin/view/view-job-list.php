<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
	   <a href="/admin/job-add.php" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xóa') ? $('#form-job').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/job.php">Nghề Nghiệp</a></li>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> Nghề Nghiệp</h3>
      </div>
      <div class="panel-body">
        <form action="/admin/job-delete.php" method="post" enctype="multipart/form-data" id="form-job">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">
                    <a href="<?php echo $sort_title; ?>" class="<?php if ($sort == 'title') echo strtolower($order); ?>">Nghề Nghiệp</a>
                  </td>

                  <td class="text-left">
                    <a href="<?php echo $sort_code; ?>" class="<?php if ($sort == 'code') echo strtolower($order); ?>">Mã Nghề</a>
                  </td>

                  <td class="text-left">
                    <a href="<?php echo $sort_date_added; ?>" class="<?php if ($sort == 'date_added') echo strtolower($order); ?>">Ngày tạo</a>
                  </td>
                  <td class="text-right">Hành động</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($jobs) { ?>
                <?php foreach ($jobs as $job) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($job['job_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $job['job_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $job['job_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $job['title']; ?></td>
                  <td class="text-left"><?php echo $job['code']; ?></td>
                  <td class="text-left"><?php echo $job['date_added']; ?></td>
                  <td class="text-right">
                  	<a href="<?php echo $job['edit']; ?>" data-toggle="tooltip" title="Sửa" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $job['job_id'];?>\']').prop('checked', true);confirm('Bạn có chắc muốn xóa') ? $('#form-job').submit() : false; $('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
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
