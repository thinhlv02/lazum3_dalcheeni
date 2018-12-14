
<?php echo $breadcrumb ?>

<?php foreach ($folders as $key => $value): ?>
	
		<div class="item-img dropdown">
			<img src="<?php echo public_url('images/folder.png')?>" id="menu_<?php echo $value->name ?>" alt="" type="button" data-toggle="dropdown">
			<div class="name-img"><?php echo $value->name ?></div>
			<ul class="dropdown-menu" role="menu" aria-labelledby="menu_<?php echo $value->name ?>">
		      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo admin_url('file/'.$value->id) ?>" style="padding-top: 10px;">Mở thư mục</a></li>
		      <li role="presentation"><a role="menuitem" tabindex="-1" onclick="confirmDelFolder('<?php echo $value->name?>')" style="padding-bottom: 10px;">Xóa</a></li> 
		    </ul>
		</div>
	
<?php endforeach ?>

<?php foreach ($map as $k) {?>
	<?php if(!is_array($k)){ ?>
		<div class="item-img dropdown">
			<img src="<?php echo base_url($dir)."/".$k;?>" alt="" id="menu_<?php echo $k ?>" type="button" data-toggle="dropdown">
			<div class="name-img"><?php echo $k ?></div>
			<ul class="dropdown-menu" role="menu" aria-labelledby="menu_<?php echo $k ?>">
		      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url().$dir.'/'.$k ?>" style="padding-top: 10px;">Lấy liên kết hình ảnh</a></li>
		      <li role="presentation"><a role="menuitem" tabindex="-1" onclick="confirmDelImage('<?php echo $dir.'/'.$k ?>')" style="padding-bottom: 10px;">Xóa</a></li> 
		    </ul>
		</div>	
	<?php }?>
<?php } ?> 
<div id="result"></div>
<style type="text/css">
	.item-img {
	    width: 100px;
	    display: inline-block;
	    margin: 5px;
	    text-align: center;
	}
	.name-img {
	    margin-top: 5px;
	}
	.item-img img {
	    max-height: 100px;
	    max-width: 100px;
	}
	ul{padding-top: 10px}
</style>