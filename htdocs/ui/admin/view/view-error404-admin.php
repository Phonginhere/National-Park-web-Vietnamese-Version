<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1><?php echo tr('ID_PAGE_TITLE_ERROR_404'); ?></h1>
    <ul class="breadcrumb">
      <?php foreach ($view->breadcrumbs as $breadcrumb) { ?>
      <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-exclamation-triangle"></i> <?php echo tr('ID_PAGE_TITLE_ERROR_404'); ?></h3>
    </div>
    <div class="panel-body">
      <p class="text-center"><?php echo tr('ID_ERROR_404_MSG'); ?></p>
    </div>
  </div>
</div>
