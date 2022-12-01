<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-testimonial" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
	    <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
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
    <?php $_SESSION['ERROR_TEXT'] = NULL;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $form_title ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-testimonial" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Tên</label>
            <div class="col-sm-10">
              <input type="text" name="input_name" value="<?php echo $name; ?>" placeholder="Name" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-age">Tuổi</label>
            <div class="col-sm-10">
              <input type="text" name="input_age" value="<?php echo $age; ?>" placeholder="Age" id="input-age" class="form-control" />
              <?php if ($error_age) { ?>
              <div class="text-danger"><?php echo $error_age; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-age">Địa Chỉ</label>
            <div class="col-sm-10">
              <input type="text" name="input_address" value="<?php echo $address; ?>" placeholder="Address" id="input-address" class="form-control" />
              <?php if ($error_address) { ?>
              <div class="text-danger"><?php echo $error_address; ?></div>
              <?php } ?>
            </div>
          </div>
       
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-job">Nghề Nghiệp</label>
            <div class="col-sm-10">
              <input type="text" name="input_job" value="<?php echo $job; ?>" placeholder="Job" id="input-job" class="form-control" />
              <?php if ($error_job) { ?>
              <div class="text-danger"><?php echo $error_job; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image">Ảnh</label>
            <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
              <input type="hidden" name="input_image" value="<?php echo $image; ?>" id="input-image" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-title">Tiêu Đề</label>
            <div class="col-sm-10">
              <input type="text" name="input_title" value="<?php echo $title; ?>" placeholder="Title" id="input-email" class="form-control" />
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-content">Nội Dung</label>
            <div class="col-sm-10">
			  <textarea name="input_content" placeholder="Content" id="input-content" rows="10" class="form-control"><?php echo $content; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status">Trạng thái</label>
            <div class="col-sm-10">
              <select name="input_status" id="input-status" class="form-control">
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
              <input type="text" name="input_sort_order" value="<?php echo $sort_order; ?>" placeholder="Sort Order" id="input-sort_order" class="form-control" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
