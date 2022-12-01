<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-setting" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $view->cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/setting-edit.php">Cài Đặt</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } unset($_SESSION['ERROR_TEXT']);?>
    <?php if ($_SESSION['SUCCESS_TEXT']) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $_SESSION['SUCCESS_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } unset($_SESSION['SUCCESS_TEXT']); ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Cài đặt</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Thông tin chung</a></li>
            <li><a href="#tab-option" data-toggle="tab">Tùy chọn</a></li>
            <!-- <li><a href="#tab-image" data-toggle="tab">Ảnh</a></li> -->
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-name">Tên cửa hàng</label>
                <div class="col-sm-10">
                  <input type="text" name="config_name" value="<?php echo $config_name; ?>" placeholder="Tên cửa hàng" id="input-name" class="form-control" />
                  <?php if ($error_name) { ?>
                  <div class="text-danger"><?php echo $error_name; ?></div>
                  <?php } ?>
                </div>
              </div>
            
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-address">Địa chỉ</label>
                <div class="col-sm-10">
                  <textarea name="config_address" placeholder="Địa chỉ" rows="3" id="input-address" class="form-control"><?php echo $config_address; ?></textarea>
                  <?php if ($error_address) { ?>
                  <div class="text-danger"><?php echo $error_address; ?></div>
                  <?php } ?>
                </div>
              </div>
			  
			  <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-html_google_map_embed">Bản Đồ</label>
                <div class="col-sm-10">
                  <textarea name="html_google_map_embed" placeholder="Bản Đồ" rows="5" id="input-html_google_map_embed" class="form-control"><?php echo $html_google_map_embed; ?></textarea>
                  <?php if ($error_html_google_map_embed) { ?>
                  <div class="text-danger"><?php echo $error_html_google_map_embed; ?></div>
                  <?php } ?>
                </div>
              </div>
           
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-email">Email</label>
                <div class="col-sm-10">
                  <input type="text" name="config_email" value="<?php echo $config_email; ?>" placeholder="Email" id="input-email" class="form-control" />
                  <?php if ($error_email) { ?>
                  <div class="text-danger"><?php echo $error_email; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-meta-title">Website:</label>
                <div class="col-sm-10">
                  <input type="text" name="config_url" value="<?php echo $config_url; ?>" placeholder="Store URL" id="input-meta-title" class="form-control" />
                  <?php if ($error_config_url) { ?>
                  <div class="text-danger"><?php echo $error_config_url; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-telephone">Điện thoại</label>
                <div class="col-sm-10">
                  <input type="text" name="config_telephone" value="<?php echo $config_telephone; ?>" placeholder="Điện thoại" id="input-telephone" class="form-control" />
                  <?php if ($error_telephone) { ?>
                  <div class="text-danger"><?php echo $error_telephone; ?></div>
                  <?php } ?>
                </div>
              </div>
            
              <!-- 
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-image">Ảnh</label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="config_image" value="<?php echo $config_image; ?>" id="input-image" />
                </div>
              </div>
               -->
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-logo">Logo</label>
                <div class="col-sm-10"><a href="" id="thumb-logo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $logo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="config_logo" value="<?php echo $config_logo; ?>" id="input-logo" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-icon"><span data-toggle="tooltip" title="Icon hiển thị trên tab trình duyệt web">Favicon</span></label>
                <div class="col-sm-10"><a href="" id="thumb-icon" data-toggle="image" class="img-thumbnail"><img src="<?php echo $icon; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="config_icon" value="<?php echo $config_icon; ?>" id="input-icon" />
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-option">
              <fieldset>
                <!-- <legend>Sản phẩm</legend> -->
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-catalog-limit"><span data-toggle="tooltip" title="Số bản ghi trên một trang.(sản phẩm, loại sản phẩm, v.v...)">Kích thước phân trang(Home)</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="config_product_limit" value="<?php echo $config_product_limit; ?>" placeholder="Default Items Per Page" id="input-catalog-limit" class="form-control" />
                    <?php if ($error_product_limit) { ?>
                    <div class="text-danger"><?php echo $error_product_limit; ?></div>
                    <?php } ?>
                  </div>
                </div>
               
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-admin-limit"><span data-toggle="tooltip" title="Số bản ghi trên một trang quản trị (sản phẩm, loại sản phẩm, user...)">Kích thước phân trang(Admin)</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="config_limit_admin" value="<?php echo $config_limit_admin; ?>" placeholder="Số phần tử trên trang(Admin)" id="input-admin-limit" class="form-control" />
                    <?php if ($error_limit_admin) { ?>
                    <div class="text-danger"><?php echo $error_limit_admin; ?></div>
                    <?php } ?>
                  </div>
                </div>
				
                 <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-list-description-limit"><span data-toggle="tooltip" title="Giới hạn số kí tự mô tả ngắn sản phẩm, loại sản phẩm, v.v...">Số kí tự mô tả(Catalog)</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="config_product_description_length" value="<?php echo $config_product_description_length; ?>" placeholder="Số kí tự mô tả(Catalog)" id="input-list-description-limit" class="form-control" />
                    <?php if ($error_product_description_length) { ?>
                    <div class="text-danger"><?php echo $error_product_description_length; ?></div>
                    <?php } ?>
                  </div>
                </div>
				
				 <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-products_featured_limit"><span data-toggle="tooltip" title="Giới hạn số sản phẩm nổi bật (Featured Products)">Số Sản Phẩm Nổi Bật</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="products_featured_limit" value="<?php echo $products_featured_limit; ?>" placeholder="Số sản phẩm nổi bật" id="input-products_featured_limit" class="form-control" />
                    <?php if ($error_products_featured_limit) { ?>
                    <div class="text-danger"><?php echo $error_products_featured_limit; ?></div>
                    <?php } ?>
                  </div>
                </div>
				
				
				<div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-products_best_seller_limit"><span data-toggle="tooltip" title="Giới hạn số sản phẩm bán chạy (Best Seller Products)">Số Sản Phẩm Bán Chạy</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="products_best_seller_limit" value="<?php echo $products_best_seller_limit; ?>" placeholder="Số sản phẩm nổi bật" id="input-products_best_seller_limit" class="form-control" />
                    <?php if ($error_products_best_seller_limit) { ?>
                    <div class="text-danger"><?php echo $error_products_best_seller_limit; ?></div>
                    <?php } ?>
                  </div>
                </div>
				
				
              </fieldset>
              
              
              
              
             
             
            </div>
            
            <!-- 
            <div class="tab-pane" id="tab-image">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-category-width"><span data-toggle="tooltip" title="Kích thước ảnh loại sản phẩm">Category Image Size</span></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_category_width" value="<?php echo $config_image_category_width; ?>" placeholder="độ rộng" id="input-image-category-width" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_category_height" value="<?php echo $config_image_category_height; ?>" placeholder="độ cao" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_category) { ?>
                  <div class="text-danger"><?php echo $error_image_category; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-thumb-width"><span data-toggle="tooltip" title="Kích thước ảnh đại diện sản phẩm">Product Image Thumb Size</span></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_thumb_width" value="<?php echo $config_image_thumb_width; ?>" placeholder="độ rộng" id="input-image-thumb-width" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_thumb_height" value="<?php echo $config_image_thumb_height; ?>" placeholder="độ cao" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_thumb) { ?>
                  <div class="text-danger"><?php echo $error_image_thumb; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-popup-width"><span data-toggle="tooltip" title="Kích thước ảnh sản phẩm popup">Product Image Popup Size</span></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_popup_width" value="<?php echo $config_image_popup_width; ?>" placeholder="độ rộng" id="input-image-popup-width" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_popup_height" value="<?php echo $config_image_popup_height; ?>" placeholder="độ cao" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_popup) { ?>
                  <div class="text-danger"><?php echo $error_image_popup; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-product-width"><span data-toggle="tooltip" title="Kích thước ảnh sản phẩm phân trang">Product Image List Size</span></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_product_width" value="<?php echo $config_image_product_width; ?>" placeholder="độ rộng" id="input-image-product-width" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_product_height" value="<?php echo $config_image_product_height; ?>" placeholder="độ cao" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_product) { ?>
                  <div class="text-danger"><?php echo $error_image_product; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-additional-width"><span data-toggle="tooltip" title="Kích thước ảnh thêm mới vào sản phẩm">Additional Product Image Size</span></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_additional_width" value="<?php echo $config_image_additional_width; ?>" placeholder="độ rộng" id="input-image-additional-width" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_additional_height" value="<?php echo $config_image_additional_height; ?>" placeholder="độ cao" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_additional) { ?>
                  <div class="text-danger"><?php echo $error_image_additional; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-related"><span data-toggle="tooltip" title="Kích thước ảnh sản phẩm liên quan">Related Product Image Size</span></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_related_width" value="<?php echo $config_image_related_width; ?>" placeholder="độ rộng" id="input-image-related" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_related_height" value="<?php echo $config_image_related_height; ?>" placeholder="độ cao" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_related) { ?>
                  <div class="text-danger"><?php echo $error_image_related; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-compare"><span data-toggle="tooltip" title="Kích thước ảnh khi so sánh">Compare Image Size</span></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_compare_width" value="<?php echo $config_image_compare_width; ?>" placeholder="độ rộng" id="input-image-compare" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_compare_height" value="<?php echo $config_image_compare_height; ?>" placeholder="độ cao" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_compare) { ?>
                  <div class="text-danger"><?php echo $error_image_compare; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-wishlist">Whishlist Image Size</label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_wishlist_width" value="<?php echo $config_image_wishlist_width; ?>" placeholder="độ rộng" id="input-image-wishlist" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_wishlist_height" value="<?php echo $config_image_wishlist_height; ?>" placeholder="độ dài" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_wishlist) { ?>
                  <div class="text-danger"><?php echo $error_image_wishlist; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-cart"><span data-toggle="tooltip" title="Kích thước ảnh giỏ hàng">Cart Image Size</span></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_cart_width" value="<?php echo $config_image_cart_width; ?>" placeholder="độ rộng" id="input-image-cart" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_cart_height" value="<?php echo $config_image_cart_height; ?>" placeholder="độ cao" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_cart) { ?>
                  <div class="text-danger"><?php echo $error_image_cart; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-image-location">Store Image Size</label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="config_image_location_width" value="<?php echo $config_image_location_width; ?>" placeholder="độ rộng" id="input-image-location" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="config_image_location_height" value="<?php echo $config_image_location_height; ?>" placeholder="độ dài" class="form-control" />
                    </div>
                  </div>
                  <?php if ($error_image_location) { ?>
                  <div class="text-danger"><?php echo $error_image_location; ?></div>
                  <?php } ?>
                </div>
              </div>
            </div>
             -->
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
