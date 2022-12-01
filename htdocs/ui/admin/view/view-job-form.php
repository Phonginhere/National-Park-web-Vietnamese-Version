<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-job" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
	    <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
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
    <?php $_SESSION['ERROR_TEXT'] = NULL;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $web_title ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-job" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-title">Tên Nghề Nghiệp</label>
            <div class="col-sm-10">
              <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title" id="input-title" class="form-control" />
              <?php if ($error_title) { ?>
              <div class="text-danger"><?php echo $error_title; ?></div>
              <?php } ?>
            </div>
          </div>
       
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-code">Mã Nghề</label>
            <div class="col-sm-10">
              <input type="text" name="code" value="<?php echo $code; ?>" placeholder="Job" id="input-code" class="form-control" />
              <?php if ($error_code) { ?>
              <div class="text-danger"><?php echo $error_code; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-min_salary">Lương Tối Thiểu (vnd)</label>
            <div class="col-sm-10">
              <input name="min_salary" value="<?php echo $min_salary; ?>" placeholder="Min Salary" id="input-min_salary" class="form-control" type="text" />
              <?php if ($error_min_salary) { ?>
              <div class="text-danger"><?php echo $error_min_salary; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-max_salary">Lương Tối Đa (vnd)</label>
            <div class="col-sm-10">
              <input name="max_salary" value="<?php echo $max_salary; ?>" placeholder="Min Salary" id="input-max_salary" class="form-control" type="text" />
              <?php if ($error_max_salary) { ?>
              <div class="text-danger"><?php echo $error_max_salary; ?></div>
              <?php } ?>
            </div>
          </div>

          <!--
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status">Trạng thái</label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="0">Không cho phép</option>
                <option value="1" selected="selected">Cho phép</option>
                <?php } else { ?>
                <option value="0" selected="selected">Không cho phép</option>
                <option value="1">Cho phép</option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort_order">Trật tự sắp xếp</label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="Sort Order" id="input-sort_order" class="form-control" />
            </div>
          </div>
          -->

        </form>
      </div>
    </div>
  </div>
</div>
