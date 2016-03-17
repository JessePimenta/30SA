<?php defined('SYSPATH') or die('No direct script access.');?>

<?if ($widget->map_title!=''):?>
<div class=" col-lg-8 ">
    <div class="panel-heading" id='partsMapp'>
        <h3 class="panel-title"><?=$widget->map_title?></h3>
    </div>
<?endif?>
<div class="container">
  <div class=" map-responsive">

    <div class="panel-body map-responsive mr-new">
      <iframe frameborder="0" height="405px" width="100%" src="<?=Route::url('map')?>?height=<?=$widget->map_height?>&controls=0&zoom=<?=$widget->map_zoom?>">
      </iframe>
    </div>
  </div>
</div>
</div>
