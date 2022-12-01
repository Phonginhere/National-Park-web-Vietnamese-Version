<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="/about.php">Giới Thiệu</a></li>
  </ul>
  <div class="row">
  	
  	<!-- START CATEGORIES SIDE BAR MENU -->
  	<column id="column-left" class="col-sm-3 hidden-xs">
		<div class="list-group">
		  <a href="/about.php"   class="list-group-item active">Giới Thiệu Về Chúng Tôi</a>
		  <a href="/contact.php" class="list-group-item">Liên Hệ Với Chúng Tôi</a>
		  <a href="/blog.php"    class="list-group-item">Blog Diễn Đàn, Tin Tức</a>
		  <a href="#"            class="list-group-item">Bản Đồ Site</a>

		  
		  
		  <!-- 
		  <a href="#" class="list-group-item active">&nbsp;&nbsp;&nbsp;- Tầm Nhìn</a>
		  <a href="#" class="list-group-item">&nbsp;&nbsp;&nbsp;- Thông Tin Giao Hàng</a>
		  
		  <a href="#" class="list-group-item">Điều Khoản Sử Dụng</a>
		  <a href="/contact.php" class="list-group-item">Liên Hệ</a>
		  -->
		</div>
	</column>
	<!-- END CATEGORIES SIDE BAR MENU -->
  	
    <div id="content" class="col-sm-9">
	   <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Who We Are</font></font></h1>
	   <br>
	   <br>
	   <p></p>
	   <table width="100%" cellpadding="15" border="0">
	      <tbody>
	         <?php foreach($users as $emp) { ?>
	         <tr valign="top">
	            <td><img style="width: 120px;" src="<?php echo $emp['thumb']?>">
	               <br><br><b><font style="vertical-align: inherit;"><?php echo $emp['fullname']?></font></b>
	               <br><font style="vertical-align: inherit;"><?php echo $emp['job_title']?></font>
	               <br><?php echo $emp['email'];?>
	            </td>
	            <td>
	                <?php echo $emp['description'];?>
	            </td>
	         </tr>
	         <tr>
	            <td colspan="1">&nbsp;<br><br><br></td>
	         </tr>	         
	         <?php } // end foreach ?>
	         
	         <!-- Dữ liệu html tĩnh của 1 bản ghi
	         <tr valign="top">
	            <td><img style="width: 120px;" src="https://www.foodgenuine.com/image/catalog/varie/team members/paolo-foodgenuine.jpg">
	               <br><br><b><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Paolo Guizzo</font></font></b>
	               <br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Chief Executive Officer
	               </font></font><br><img style="width: 240px;" src="https://www.foodgenuine.com/image/catalog/varie/team members/emails/paolo.png">
	            </td>
	            <td><span style="font-size: 16px;" lang="IT-IT"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">A lover of technology and the internet, I have worked in the Netherlands for more than 7 years in this area. </font><font style="vertical-align: inherit;">I Holland food is not a factor of pride and my passion for good food and the difficulty of finding it in supermarkets and on the net has weighed heavily on my stay abroad. </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
	               Driven by this need, I started the creation of Foodgenuine, an e-commerce for the sale of food and drinks that are genuine, healthy, natural and non-industrial. </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
	               My goal is also to offer small producers the opportunity to sell their products worldwide. </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
	               Good and healthy food for everyone; </font><font style="vertical-align: inherit;">" </font></font><span style="font-style: italic;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">food is not filling your belly, food is health</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ".</font></font></span>
	            </td>
	         </tr>
	         <tr>
	            <td colspan="1">&nbsp;<br><br><br></td>
	         </tr>
	          -->
	        
	         
	      </tbody>
	   </table>
	</div>
    
    
  </div>
</div>

<script type="text/javascript">

// Khi nhấp chuột vào nút tìm kiếm ...
$('#button-search').bind('click', function() { 

	// ...thì điều hướng sang trang sau...
	url = '/blog.php';

	// ...với các tham số :
	// từ khóa tìm kiếm (để so sánh với tựa đề bài viết)
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '?search=' + encodeURIComponent(search);
	}

	// nếu người dùng muốn tìm kiếm từ khóa cả ở trong nội dung của bài viết:
	var filter_content = $('#content input[name=\'content\']:checked').prop('value');
	
	if (filter_content) {
		url += '&content=true';
	}

	// Bắt đầu điều hướng:
	location = url;
});

// Khi ấn phím Enter trên hộp tìm kiếm
//$('#content input[name=\'search\']').bind('keydown', function(e) {
$("#content input[name='search']").bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});


</script> 