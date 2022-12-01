<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Quản Lý Ảnh</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-sm-5"><a href="<?php echo $manager_parent; ?>" data-toggle="tooltip" title="Thư mục cha" id="button-parent" class="btn btn-default"><i class="fa fa-level-up"></i></a> <a href="<?php echo $manager_refresh; ?>" data-toggle="tooltip" title="Refresh" id="button-refresh" class="btn btn-default"><i class="fa fa-refresh"></i></a>
          <button type="button" data-toggle="tooltip" title="Tải lên" id="button-upload" class="btn btn-primary"><i class="fa fa-upload"></i></button>
          <button type="button" data-toggle="tooltip" title="Thư mục" id="button-folder" class="btn btn-default"><i class="fa fa-folder"></i></button>
          <button type="button" data-toggle="tooltip" title="Xóa" id="button-delete" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
        </div>
        <div class="col-sm-7">
          <div class="input-group">
            <input type="text" name="search" value="<?php echo $manager_filter_name; ?>" placeholder="Tìm" class="form-control">
            <span class="input-group-btn">
            <button type="button" data-toggle="tooltip" title="Tìm" id="button-search" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </span></div>
        </div>
      </div>
      <hr />
      <?php foreach (array_chunk($manager_images, 4) as $images) { ?>
      <div class="row">
        <?php foreach ($images as $image) { ?>
        <div class="col-sm-3 text-center">
          <?php if ($image['type'] == 'directory') { ?>
          <div class="text-center"><a href="<?php echo $image['href']; ?>" class="directory" style="vertical-align: middle;"><i class="fa fa-folder fa-5x"></i></a></div>
          <label>
            <input type="checkbox" name="path[]" value="<?php echo $image['path']; ?>" />
            <?php echo $image['name']; ?></label>
          <?php } ?>
          <?php if ($image['type'] == 'image') { ?>
          <a href="<?php echo $image['href']; ?>" class="thumbnail"><img src="<?php echo $image['thumb']; ?>" alt="<?php echo $image['name']; ?>" title="<?php echo $image['name']; ?>" /></a>
          <label>
            <input type="checkbox" name="path[]" value="<?php echo $image['path']; ?>" />
            <?php echo $image['name']; ?></label>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <br />
      <?php } ?>
    </div>
    <div class="modal-footer"><?php echo $web_pagination_controls;?></div>
  </div>
</div>
<script type="text/javascript">
// Nếu nhấp chuột lên hình đại diện của folder hoặc file ảnh:
$('a.thumbnail').on('click', function(e) {
	e.preventDefault();

	<?php if ($manager_thumb) { ?>
	$('#<?php echo $manager_thumb; ?>').find('img').attr('src', $(this).find('img').attr('src'));
	<?php } ?>
	
	<?php if ($manager_target) { ?>
	$('#<?php echo $manager_target; ?>').attr('value', $(this).parent().find('input').attr('value'));
	<?php } else { ?>
	var range, sel = document.getSelection(); 
	
	if (sel.rangeCount) { 
		var img = document.createElement('img');
		img.src = $(this).attr('href');
	
		range = sel.getRangeAt(0); 
		range.insertNode(img); 
	}
	<?php } ?>

	$('#modal-image').modal('hide');
});

$('a.directory').on('click', function(e) {
	e.preventDefault();
	
	$('#modal-image').load($(this).attr('href'));
});

$('.pagination a').on('click', function(e) {
	e.preventDefault();
	
	$('#modal-image').load($(this).attr('href'));
});

$('#button-parent').on('click', function(e) {
	e.preventDefault();
	
	$('#modal-image').load($(this).attr('href'));
});

$('#button-refresh').on('click', function(e) {
	e.preventDefault();
	
	$('#modal-image').load($(this).attr('href'));
});

$('#button-search').on('click', function() {
	
	var url = $('#urlFilemanager').attr('href') + '?directory=<?php echo $manager_directory; ?>';
		
	var filter_name = $('input[name=\'search\']').val();
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
							
	<?php if ($manager_thumb) { ?>
	url += '&thumb=' + '<?php echo $manager_thumb; ?>';
	<?php } ?>
	
	<?php if ($manager_target) { ?>
	url += '&target=' + '<?php echo $manager_target; ?>';
	<?php } ?>
			
	$('#modal-image').load(url);
});
</script>

<script type="text/javascript">
$('#button-upload').on('click', function() {
	$('#form-upload').remove();
	
	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" value="" /></form>');
	
	$('#form-upload input[name=\'file\']').trigger('click');
	
	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);
			
			$.ajax({
				url: '/admin/filemanager-upload.php?directory=<?php echo $manager_directory; ?>',
				type: 'post',		
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,		
				beforeSend: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$('#button-upload').prop('disabled', true);
				},
				complete: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
					$('#button-upload').prop('disabled', false);
				},
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}
					
					if (json['success']) {
						alert(json['success']);
						
						$('#button-refresh').trigger('click');
					}
				},			
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});	
		}
	}, 500);
});

$('#button-folder').popover({
	html: true,
	placement: 'bottom',
	trigger: 'click',
	title: 'Thư Mục',
	content: function() {
		html  = '<div class="input-group">';
		html += '  <input type="text" name="folder" value="" placeholder="Thư mục" class="form-control">';
		html += '  <span class="input-group-btn"><button type="button" title="Thư mục" id="button-create" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></span>';
		html += '</div>';
		
		return html;	
	}
});

$('#button-folder').on('shown.bs.popover', function() {
	$('#button-create').on('click', function() {
		
		$.ajax({
			url: '/admin/filemanager-folder.php?directory=<?php echo $manager_directory; ?>',
			type: 'post',		
			dataType: 'json',
			data: 'folder=' + encodeURIComponent($('input[name=\'folder\']').val()),
			beforeSend: function() {
				$('#button-create').prop('disabled', true);
			},
			complete: function() {
				$('#button-create').prop('disabled', false);
			},
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				}
				
				if (json['success']) {
					alert(json['success']);
										
					$('#button-refresh').trigger('click');
				}
			},			
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});	
});

$('#modal-image #button-delete').on('click', function(e) {
	if (confirm('Bạn có chắc là muốn xóa')) {
		$.ajax({
			url: '/admin/filemanager-delete.php',
			type: 'post',		
			dataType: 'json',
			data: $('input[name^=\'path\']:checked'),
			beforeSend: function() {
				$('#button-delete').prop('disabled', true);
			},	
			complete: function() {
				$('#button-delete').prop('disabled', false);
			},		
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				}
				
				if (json['success']) {
					alert(json['success']);
					
					$('#button-refresh').trigger('click');
				}
			},			
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
});
</script>