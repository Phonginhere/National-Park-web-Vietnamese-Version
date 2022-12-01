<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-user" data-toggle="tooltip" title="Lưu" class="btn btn-primary" <?php echo $disabled;?>><i class="fa fa-save"></i></button>
        <a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      
      <ul class="breadcrumb">
	    <li><a href="/admin.php"><i class="fa fa-home"></i>Quản Trị</a></li>
	    <li><a href="/admin/contact.php">Ý Kiến Khách Hàng</a></li>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title;?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
         <fieldset id="account">
          <legend>Chi Tiết</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Tên</label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Tên" id="input-name" class="form-control" <?php echo $readonly; ?>/>
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">Email</label>
            <div class="col-sm-10">
              <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" id="input-email" class="form-control" <?php echo $readonly; ?>/>
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
          </div>
		  
			<div class="form-group">
					<label class="col-sm-2 control-label" for="input-website">Websie</label>
					<div class="col-sm-10">
					  <input name="website" value="<?php echo $website;?>" placeholder="Website" id="website" class="form-control" type="text" />
					  <?php if ($website) { ?>
					  <div class="text-danger"><?php echo $error_website; ?></div>
					  <?php } ?>
					</div>
			</div>			  

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-phone">Điện Thoại</label>
            <div class="col-sm-10">
              <input name="phone" value="<?php echo $phone;?>" placeholder="Điện thoại" id="input-phone" class="form-control" type="tel" <?php echo $readonly; ?>>
              <?php if ($error_phone) { ?>
              <div class="text-danger"><?php echo $error_phone; ?></div>
              <?php } ?>
            </div>
          </div>
		  
		  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-address">Địa chỉ</label>
					<div class="col-sm-10">
					  <input name="address" value="<?php echo $address;?>" placeholder="Địa chỉ" id="input-address" class="form-control" type="text" />
					  <?php if ($error_address) { ?>
					  <div class="text-danger"><?php echo $error_address; ?></div>
					  <?php } ?>
					</div>
			</div>	

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-department"><span data-toggle="tooltip" title="(Autocomplete)">Nơi Tiếp Nhận</span></label>
                <div class="col-sm-10">
                  <input type="text" name="to_dep_name" value="<?php echo $to_dep_name; ?>" placeholder="Phòng Ban tiếp nhận phản hồi khách hàng" id="input-department" class="form-control" />
                  <input type="hidden" name="to_dep_id" value="<?php echo $to_dep_id; ?>" />
                </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-emp"><span data-toggle="tooltip" title="(Autocomplete)">Người Tiếp Nhận</span></label>
                <div class="col-sm-10">
                  <input type="text" name="to_emp_name" value="<?php echo $to_emp_name; ?>" placeholder="Nhân viên tiếp nhận ..." id="input-emp" class="form-control" />
                  <input type="hidden" name="to_emp_id" value="<?php echo $to_emp_id; ?>" />
                </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-date">Ngày (dd/mm/yyyy)</label>
            <div class="col-sm-10">
              <input name="date" value="<?php echo $date;?>" placeholder="Ngày hẹn gặp, tiếp nhận, v.v..." id="input-date" class="form-control" type="date" >
              <?php if ($error_date) { ?>
              <div class="text-danger"><?php echo $error_date; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-time">Thời Gian (HH:ii)</label>
            <div class="col-sm-10">
              <input name="time" value="<?php echo $time;?>" placeholder="Thời gian hẹn gặp, tiếp nhận, v.v..." id="input-time" class="form-control" type="time">
              <?php if ($error_time) { ?>
              <div class="text-danger"><?php echo $error_time; ?></div>
              <?php } ?>
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-subject">Tiêu Đề</label>
            <div class="col-sm-10">
              <input name="subject" value="<?php echo $subject;?>" placeholder="Phản Hồi, Hẹn Gặp, Khiếu Nại,..." id="input-subject" class="form-control" type="tel" <?php echo $readonly; ?>>
              <?php if ($error_subject) { ?>
              <div class="text-danger"><?php echo $error_subject; ?></div>
              <?php } ?>
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-message">Nội Dung</label>
            <div class="col-sm-10">
			  <textarea name="message" placeholder="Nội Dung Phản Hồi" id="input-message" <?php echo $readonly; ?> rows="10" class="form-control"><?php echo $message; ?></textarea>
            </div>
          </div>
         </fieldset>

        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

// Phòng Ban Tiếp Nhận
$("input[name='to_dep_name']").autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/department-autocomplete.php?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				/*
                json.unshift({
					department_id: 0,
					name: '---Không---'
				});
				*/

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['department_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$("input[name='to_dep_name']").val(item['label']);
		$("input[name='to_dep_id']").val(item['value']);
	}	
});


// Nhân Viên Tiếp Nhận
// cũ: url: '/admin/user-autocomplete.php?filter_name=' +  encodeURIComponent(request),

$("input[name='to_emp_name']").autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '/admin/user-to-dep-autocomplete.php?filter_name=' +  encodeURIComponent(request)+'&dep_id='+$("input[name='to_dep_id']").val(),
			dataType: 'json',			
			success: function(json) {
				/*
                json.unshift({
					user_id: 0,
					fullname: '---Không---'
				});
				*/

				response($.map(json, function(item) {
					return {
						label: item['fullname'],
						value: item['user_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$("input[name='to_emp_name']").val(item['label']);
		$("input[name='to_emp_id']").val(item['value']);
	}	
});


</script> 