<?php 
	$now = new DateTime();
	$now = $now->getTimestamp(); 
	$event_now = array();
?>
<?php foreach ($event as $key => $value): ?>
	<?php if ($now >= $value->time_from && $now <= $value->time_to){
		$event_now[] = $value;
		unset($event[$key]);
	}?>
<?php endforeach ?>
<ol class="breadcrumb" style="background-color: transparent;">
  <li><a href="<?php echo base_url()?>">Trang chủ</a></li>
  <li class="active">Sự kiện</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title" style="font-size: 25px">Sự kiện đang diễn ra</h1>
    </div>
    <div class="panel-body">
	    <?php foreach ($event_now as $key => $value): ?>
	    	<div class="media" style="border-bottom: 1px dashed #ccc; padding-bottom: 10px">
			  	<div class="media-left">
			    	<a href="<?php echo base_url().'su-kien/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><img class="media-object" src="<?php echo base_url('upload/').$value->img ?>" width="200px" height="150px" alt=""></a>
			  	</div>
			  	<div class="media-body">
			    	<a href="<?php echo base_url().'su-kien/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><h4 class="media-heading"> <?php echo $value->name ?></h4></a>
			    	<h5 style="font-style: italic; color: #666;"><?php echo date('d/m/Y',$value->created) ?></h5>
			    	<div><?php echo $value->intro ?></div>
			  	</div>
			</div>
	    <?php endforeach ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title" style="font-size: 25px">Sự kiện</h1>
    </div>
    <div class="panel-body">
	    <?php foreach ($event as $key => $value): ?>
	    	<div class="media" style="border-bottom: 1px dashed #ccc; padding-bottom: 10px">
			  	<div class="media-left">
			    	<a href="<?php echo base_url().'su-kien/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><img class="media-object" src="<?php echo base_url('upload/').$value->img ?>" width="200px" height="150px" alt=""></a>
			  	</div>
			  	<div class="media-body">
			    	<a href="<?php echo base_url().'su-kien/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><h4 class="media-heading"> <?php echo $value->name ?></h4></a>
			    	<h5 style="font-style: italic; color: #666;"><?php echo date('d/m/Y',$value->created) ?></h5>
			    	<div><?php echo $value->intro ?></div>
			  	</div>
			</div>
	    <?php endforeach ?>
    </div>
</div>