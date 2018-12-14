<ol class="breadcrumb" style="background-color: transparent;">
  <li><a href="<?php echo base_url()?>">Trang chủ</a></li>
  <li class="active">Hướng dẫn</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title" style="font-size: 25px">Hướng dẫn</h2>
    </div>
    <div class="panel-body">
        <?php foreach ($guide as $key => $value): ?>
	    	<div class="media" style="border-bottom: 1px dashed #ccc; padding-bottom: 10px">
			  	<div class="media-left">
			    	<a href="<?php echo base_url().'huong-dan/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><img class="media-object" src="<?php echo base_url('upload/').$value->img ?>" width="100px" alt=""></a>
			  	</div>
			  	<div class="media-body">
			    	<a href="<?php echo base_url().'huong-dan/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><h4 class="media-heading"> <?php echo $value->name ?></h4></a>
			    	<h5 style="font-style: italic; color: #666;"><?php echo date('d/m/Y',$value->created) ?></h5>
			    	<div><?php echo $value->intro ?></div>
			  	</div>
			</div>
	    <?php endforeach ?>
    </div>
</div>