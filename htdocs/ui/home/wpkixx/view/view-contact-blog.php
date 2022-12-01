
<div id="information-contact" class="container">
<!--    <ul class="breadcrumb">
        <li>
            <a href="/blog.php"><i class="fa fa-home"></i></a>
        </li>
        <li><a href="/contact-blog.php">Liên Hệ</a></li>
    </ul> -->
    <div class="row">
        <div id="content" class="col-sm-12">
            <!-- h1>Liên Hệ Với Chúng Tôi</h1 -->
            <h3>Liên Hệ Với Chúng Tôi</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Địa Chỉ</strong><br />
                            <address>
                                <?php echo $settings['config_address'];?><br/>
                            </address>
                        </div>
                        <div class="col-sm-3">
                            <strong>Điện Thoại</strong><br />
                            <?php echo $settings['config_telephone'];?><br />
                            <br />
                        </div>
                        <div class="col-sm-3">
							<strong>Email</strong><br />
                            <a href="mailto:teamnationalpark@gmail.com"><?php echo $settings['config_email'];?></a><br />
                            <br />
						</div>
                    </div>
					<div class="row">
							<div class="col-sm-12">
						
								<!-- Tham khảo cách nhúng bản đồ Google Map vào html
								https://support.google.com/maps/answer/144361?hl=vi&co=GENIE.Platform%3DDesktop
								 -->
								<?php echo $settings['html_google_map_embed'];?>
							</div>
					</div>
                </div>
            </div>
            <form action="/contact.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                <fieldset>
                    <legend>Phản Hồi Độc Giả (Feedback Form)</legend>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name">Tên</label>
                        <div class="col-sm-10">
                            <input name="name" value="" id="input-name" class="form-control" required type="text" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                        <div class="col-sm-10">
                            <input name="email" value="" id="input-email" class="form-control" required type="text" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-phone">Điện Thoại</label>
                        <div class="col-sm-10">
                            <input name="phone" value="" id="input-phone" class="form-control" required type="text" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-department"><span data-toggle="tooltip" title="(Autocomplete)">Nơi Tiếp Nhận</span></label>
                            <div class="col-sm-10">
                              <input type="text" required name="to_dep_name" value="<?php echo $to_dep_name; ?>" placeholder="Phòng Ban tiếp nhận phản hồi khách hàng" id="input-department" class="form-control" />
                              <input type="hidden" required name="to_dep_id" value="<?php echo $to_dep_id; ?>" />
                            </div>
                    </div>

                    <div class="form-row">
                        <label class="col-sm-2 control-label" for="input-date">Ngày (dd/mm/yyyy)</label>
                        <div class="form-group col-sm-2">
                              <input name="date" required value="<?php echo $date;?>" placeholder="Ngày hẹn gặp, tiếp nhận, v.v..." id="input-date" class="form-control" type="date" >
                         </div>

                         <label class="col-sm-2 control-label" for="input-time">Thời Gian (HH:ii)</label>
                          <div class="form-group col-md-6">
                              <input name="time" required value="<?php echo $time;?>" placeholder="Thời gian hẹn gặp, tiếp nhận, v.v..." id="input-time" class="form-control" type="time">
                          </div>
                    </div>

					<div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-subject">Tiêu Đề</label>
                        <div class="col-sm-10">
                            <input name="subject" required value="" id="input-subject" class="form-control" placeholder="Góp Ý, Phản Hồi, Khiếu Nại, Hẹn Gặp, v.v..." type="text" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-message">Nội Dung</label>
                        <div class="col-sm-10">
                            <textarea name="message" required rows="10" id="input-message" class="form-control"></textarea>
                        </div>
                    </div>
                </fieldset>
                <div class="buttons">
                    <div class="col-sm-6" >
                        <input  type="submit" value="Gửi" style="height: 50px; width: 100px;background-color: rgb(244, 108, 99); border-radius: 15px; margin-left: 1050px; "/> <!-- class="btn btn-primary"  -->
                    </div>
                </div>
            </form>
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
</script>