<ol class="breadcrumb" style="background-color: transparent;">
  <li><a href="<?php echo base_url()?>">Trang chủ</a></li>
  <li class="active">Thông báo</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title" style="font-size: 25px">Thông báo</h1>
    </div>
    <div class="panel-body">
	    <?php foreach ($notice as $key => $value): ?>
	    	<div class="" style="border-bottom: 1px dashed #ccc; padding-bottom: 10px">
			  	
			  	<div class="">
			    	<a href="<?php echo base_url().'thong-bao/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><h4 class=""> <?php echo $value->name ?></h4></a>
			    	<h5 style="font-style: italic; color: #666;"><?php echo date('d/m/Y',$value->created) ?></h5>
			    	
			  	</div>
			</div>
	    <?php endforeach ?>
    </div>
</div>