<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-banner-image" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
	    <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
	    <li><a href="/admin/banner-image-edit.php">Sửa Ảnh Banner</a></li>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-banner-image" class="form-horizontal">
		
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image">Ảnh</label>
            <div class="col-sm-10"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $banner_thumb; ?>" alt="" title="" data-placeholder="<?php echo $banner_placeholder; ?>" /></a>
              <input type="hidden" name="image" value="<?php echo $banner_image; ?>" id="input-image" />
            </div>
          </div>
		  
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-title">Tựa Đề</label>
            <div class="col-sm-10">
              <input type="text" name="title" value="<?php echo $banner_image_title; ?>" placeholder="Tựa đề ảnh banner" id="input-title" class="form-control" />
              <?php if ($error_title) { ?>
              <div class="text-danger"><?php echo $error_title; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-sub_title">Phụ Đề</label>
            <div class="col-sm-10">
              <input type="text" name="sub_title" value="<?php echo $banner_image_sub_title; ?>" placeholder="Phụ đề ảnh banner" id="input-sub_title" class="form-control" />
              <?php if ($error_sub_title) { ?>
              <div class="text-danger"><?php echo $error_sub_title; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-link"><span data-toggle="tooltip" title="">Link</span></label>
            <div class="col-sm-10">
              <input type="text" name="link" value="<?php echo $banner_image_link; ?>" placeholder="Siêu liên kết" id="input-link" class="form-control" />
              <?php if ($error_link) { ?>
              <div class="text-danger"><?php echo $error_link; ?></div>
              <?php } ?>
            </div>
          </div>
		  
		   <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description">Mô tả</label>
                    <div class="col-sm-10">
                      <textarea name="description" placeholder="Mô tả" id="input-description"><?php echo $banner_image_description; ?></textarea>
                    </div>
            </div>
		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order">Trật tự sắp xếp</label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="Trật tự sắp xếp" id="input-sort-order" class="form-control" />
            </div>
          </div>
		  
          <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Trạng Thái</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($banner_image_status) { ?>
                    <option value="1" selected="selected">Cho phép</option>
                    <option value="0">Không cho phép</option>
                    <?php } else { ?>
                    <option value="1">Cho phép</option>
                    <option value="0" selected="selected">Không cho phép</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
// Rich Text Editor
$('#input-description').summernote({height: 300});
//--></script> 