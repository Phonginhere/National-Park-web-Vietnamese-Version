<div id="content">
  <div class="page-header">
    <div class="container-fluid">
<!--       <h1>Dashboard</h1> -->
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/dashboard.php">Dashboard</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
        <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6"><div class="tile">
  <div class="tile-heading">Tổng số đơn hàng <span class="pull-right"><i class="fa fa-caret-up"></i>...%</span></div>
  <div class="tile-body"><i class="fa fa-shopping-cart"></i>
    <h2 class="pull-right"><?php echo orderGetTotal();?></h2>
  </div>
  <div class="tile-footer"><a href="/admin/order.php">Xem thêm ...</a></div>
</div>
</div>
      <div class="col-lg-3 col-md-3 col-sm-6"><div class="tile">
  <div class="tile-heading">Tổng doanh số <span class="pull-right">
        <i class="fa fa-caret-up"></i>...% </span></div>
  <div class="tile-body"><i class="fa fa-credit-card"></i>
    <h2 class="pull-right"><?php echo orderGetTotalSalesWithFormat();?></h2>
  </div>
  <div class="tile-footer"><a href="/admin/order.php">Xem thêm ...</a></div>
</div>
</div>
      <div class="col-lg-3 col-md-3 col-sm-6"><div class="tile">
  <div class="tile-heading">Tổng số khách hàng <span class="pull-right">
        <i class="fa fa-caret-down"></i>
        -...%</span></div>
  <div class="tile-body"><i class="fa fa-user"></i>
    <h2 class="pull-right">...</h2>
  </div>
  <div class="tile-footer"><a href="/admin/customer.php">Xem thêm ...</a></div>
</div>
</div>
      <div class="col-lg-3 col-md-3 col-sm-6"><div class="tile">
  <div class="tile-heading">Khách hàng Online</div>
  <div class="tile-body"><i class="fa fa-eye"></i>
    <h2 class="pull-right">...</h2>
  </div>
  <div class="tile-footer"><a href="#link-to-report-customer-online">Xem thêm ...</a></div>
</div>
</div>
    </div>
      <div class="col-lg-6 col-md-12 col-sx-12 col-sm-12">
       <div class="panel panel-default">
		  <div class="panel-heading">
		    <div class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
		      <ul id="range" class="dropdown-menu dropdown-menu-right">
		        <li><a href="http://demo.opencart.com/admin/day">Today</a></li>
		        <li><a href="http://demo.opencart.com/admin/week">Week</a></li>
		        <li class="active"><a href="http://demo.opencart.com/admin/month">Month</a></li>
		        <li><a href="http://demo.opencart.com/admin/year">Year</a></li>
		      </ul>
		    </div>
    		<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Sales Analytics</h3>
          </div>
		  <div class="panel-body">
		    <div id="chart-sale" style="width: 100%; height: 260px; padding: 0px; position: relative;">
		    	<canvas height="260" width="527" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 527px; height: 260px;" class="flot-base"></canvas>
		    	<div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);" class="flot-text">
		    	<div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;" class="flot-x-axis flot-x1-axis xAxis x1Axis">
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 13px; text-align: center;">01</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 29px; text-align: center;">02</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 45px; text-align: center;">03</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 61px; text-align: center;">04</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 78px; text-align: center;">05</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 94px; text-align: center;">06</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 110px; text-align: center;">07</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 126px; text-align: center;">08</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 142px; text-align: center;">09</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 158px; text-align: center;">10</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 174px; text-align: center;">11</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 190px; text-align: center;">12</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 207px; text-align: center;">13</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 223px; text-align: center;">14</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 239px; text-align: center;">15</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 255px; text-align: center;">16</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 271px; text-align: center;">17</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 287px; text-align: center;">18</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 303px; text-align: center;">19</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 319px; text-align: center;">20</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 336px; text-align: center;">21</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 352px; text-align: center;">22</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 368px; text-align: center;">23</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 384px; text-align: center;">24</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 400px; text-align: center;">25</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 416px; text-align: center;">26</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 432px; text-align: center;">27</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 448px; text-align: center;">28</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 465px; text-align: center;">29</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 481px; text-align: center;">30</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 17px; top: 240px; left: 497px; text-align: center;">31</div>
		    	
		    	</div>
		    	<div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;" class="flot-y-axis flot-y1-axis yAxis y1Axis">
		    	<div class="flot-tick-label tickLabel" style="position: absolute; top: 226px; left: 8px; text-align: right;">0</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; top: 170px; left: 8px; text-align: right;">5</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; top: 113px; left: 2px; text-align: right;">10</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; top: 57px; left: 2px; text-align: right;">15</div>
		    	<div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 2px; text-align: right;">20</div>
		    </div>
		    </div>
		    <canvas height="260" width="527" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 527px; height: 260px;" class="flot-overlay"></canvas>
		    <div class="legend">
		    	<div style="position: absolute; width: 65px; height: 36px; top: 14px; right: 13px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div>
		    	<table style="position:absolute;top:14px;right:13px;;font-size:smaller;color:#545454">
		    	<tbody>
		    		<tr>
		    			<td class="legendColorBox">
		    				<div style="border:1px solid #ccc;padding:1px">
		    					<div style="width:4px;height:0;border:5px solid rgb(159,213,241);overflow:hidden"></div>
		    				</div>
		    			</td>
		    			<td class="legendLabel">Orders</td>
		    		</tr>
		    		<tr>
		    			<td class="legendColorBox">
		    				<div style="border:1px solid #ccc;padding:1px">
		    					<div style="width:4px;height:0;border:5px solid rgb(16,101,210);overflow:hidden"></div>
		    				</div>
		    			</td>
		    			<td class="legendLabel">Customers</td>
		    		</tr>
		    	</tbody>
		    	</table>
		    	</div>
		    </div>
		  </div>
</div>
<script type="text/javascript" src="/Templates/OpenCartAdmin_files//jquery_004.js"></script> 
<script type="text/javascript" src="/Templates/OpenCartAdmin_files//jquery_003.js"></script>
<script type="text/javascript"><!--
//$('#range a').on('click', function(e) {
//	e.preventDefault();
//	
//	$(this).parent().parent().find('li').removeClass('active');
//	
//	$(this).parent().addClass('active');
//	
//	$.ajax({
//		type: 'get',
//		url: 'index.php?route=dashboard/chart/chart&token=c8e9256a500ecc7df571605f7be89958&range=' + $(this).attr('href'),
//		dataType: 'json',
//		success: function(json) {
//			var option = {	
//				shadowSize: 0,
//				colors: ['#9FD5F1', '#1065D2'],
//				bars: { 
//					show: true,
//					fill: true,
//					lineWidth: 1
//				},
//				grid: {
//					backgroundColor: '#FFFFFF',
//					hoverable: true
//				},
//				points: {
//					show: false
//				},
//				xaxis: {
//					show: true,
//            		ticks: json['xaxis']
//				}
//			}
//			
//			$.plot('#chart-sale', [json['order'], json['customer']], option);	
//					
//			$('#chart-sale').bind('plothover', function(event, pos, item) {
//				$('.tooltip').remove();
//			  
//				if (item) {
//					$('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');
//					
//					$('#tooltip').css({
//						position: 'absolute',
//						left: item.pageX - ($('#tooltip').outerWidth() / 2),
//						top: item.pageY - $('#tooltip').outerHeight(),
//						pointer: 'cusror'
//					}).fadeIn('slow');	
//					
//					$('#chart-sale').css('cursor', 'pointer');		
//			  	} else {
//					$('#chart-sale').css('cursor', 'auto');
//				}
//			});
//		},
//        error: function(xhr, ajaxOptions, thrownError) {
//           alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//        }
//	});
//});
//
//$('#range .active a').trigger('click');
//--></script> </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-12 col-sm-12 col-sx-12"><div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-calendar"></i> Recent Activity</h3>
  </div>
  <ul class="list-group">
            <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 04:01:15</small></li>
        <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 04:00:18</small></li>
        <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 03:58:58</small></li>
        <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 03:57:48</small></li>
        <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 03:56:14</small></li>
          </ul>
</div></div>
      <div class="col-lg-8 col-md-12 col-sm-12 col-sx-12"> <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Đơn hàng mới nhất</h3>
  </div>
  <div class="table-responsive">
  <?php if(orderGetLatestForDashboard()) { ?>
    <table class="table">
      <thead>
        <tr>
          <td class="text-right">ID</td>
          <td>Khách Hàng</td>
          <td>Trạng Thái</td>
          <td>Ngày Tạo</td>
          <td class="text-right">Tổng Giá Trị</td>
          <td class="text-right">Hành Động</td>
        </tr>
      </thead>
      <tbody>
      
      <?php foreach(orderGetLatestForDashboard() as $order_detail) { ?>
      <tr>
          <td class="text-right"><?php echo $order_detail['order_id'] ;?></td>
          <td><?php echo $order_detail['customer'] ;?></td>
          <td><?php echo $order_detail['status'] ;?></td>
          <td><?php echo $order_detail['date_added'] ;?></td>
          <td class="text-right"><?php echo $order_detail['total'] ;?></td>
          <td class="text-right"><a data-original-title="View" href="<?php echo $order_detail['view'];?>" data-toggle="tooltip" title="" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
        </tr>
      <?php } ?>
      
      </tbody>
    </table>
   <?php } else { ?>
   <h3>Không có đơn hàng mới nào</h3>   	
   <?php } ?> 
  </div>
</div>
 </div>
    </div>
  </div>
</div>