<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-manufacturer" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
	    <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
	    <li><a href="/admin/manufacturer.php">Nhà Sản Xuất</a></li>
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
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-manufacturer" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Tên Nhà Sản Xuất</label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $manufacturer_name; ?>" placeholder="Tên Nhà Sản Xuất" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="Không dùng phím space. Dùng dấu - để ngăn cách. Các keyword phải là duy nhất.">Keywords</span></label>
            <div class="col-sm-10">
              <input type="text" name="keyword" value="<?php echo $manufacturer_keyword; ?>" placeholder="Keywords" id="input-keyword" class="form-control" />
              <?php if ($error_keyword) { ?>
              <div class="text-danger"><?php echo $error_keyword; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image">Ảnh</label>
            <div class="col-sm-10"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $manufacturer_thumb; ?>" alt="" title="" data-placeholder="<?php echo $manufacturer_placeholder; ?>" /></a>
              <input type="hidden" name="image" value="<?php echo $manufacturer_image; ?>" id="input-image" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order">Trật tự sắp xếp</label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="Trật tự sắp xếp" id="input-sort-order" class="form-control" />
            </div>
          </div>
          <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top">Hãng Nổi Bật</label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($manufacturer_featured) { ?>
                      <input type="checkbox" name="featured" value="1" checked="checked" id="input-top" />
                      <?php } else { ?>
                      <input type="checkbox" name="featured" value="1" id="input-top" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>
