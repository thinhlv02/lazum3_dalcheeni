<?php
$now = new DateTime();
$now = $now->getTimestamp();
$promotion_now = array();
?>
<?php foreach ($promotion as $key => $value): ?>
    <?php if ($now >= $value->begin && $now <= $value->end) {
        $promotion_now[] = $value;
        unset($promotion[$key]);
    } ?>
<?php endforeach ?>
<ol class="breadcrumb" style="background-color: transparent;">
    <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
    <li class="active">Sự kiện</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title" style="font-size: 25px">Sự kiện đang diễn ra</h1>
    </div>
    <div class="panel-body">
        <?php foreach ($promotion_now as $key => $value): ?>
            <div class="media" style="border-bottom: 1px dashed #ccc; padding-bottom: 10px">
                <div class="media-left">
                    <a href="<?php echo base_url() . 'promotion/' . create_slug($value->name) . '-' . $value->id . '.html' ?>"><img
                                class="media-object" src="<?php echo base_url('upload/') . $value->img ?>" width="200px"
                                height="150px" alt=""></a>
                </div>
                <div class="media-body">
                    <a href="<?php echo base_url() . 'promotion/' . create_slug($value->name) . '-' . $value->id . '.html' ?>">
                        <h4 class="media-heading"> <?php echo $value->name ?></h4></a>
                    <h5 style="font-style: italic; color: #666;"><?php echo date('d/m/Y', $value->created) ?></h5>
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
        <?php foreach ($promotion as $key => $value): ?>
            <div class="media" style="border-bottom: 1px dashed #ccc; padding-bottom: 10px">
                <!--			  	<div class="media-left">-->
                <!--			    	<a href="-->
                <?php //echo base_url().'promotion/'.create_slug($value->name).'-'.$value->id.'.html' ?><!--"><img class="media-object" src="-->
                <?php //echo base_url('upload/').$value->img ?><!--" width="200px" height="150px" alt=""></a>-->
                <!--			  	</div>-->
                <div class="media-left">
                    <a href="<?php echo base_url() . 'promotion/' . create_slug($value->percent) . '-' . $value->id . '.html' ?>">
                        <h5><?php echo $value->percent ?></h5></a>
                </div>
                <div class="media-body">
                    <a href="<?php echo base_url() . 'promotion/' . create_slug($value->name) . '-' . $value->id . '.html' ?>">
                        <h4 class="media-heading"> <?php echo $value->name ?></h4></a>
                    <h5 style="font-style: italic; color: #666;"><?php echo date('d/m/Y', $value->created) ?></h5>
                    <div><?php echo $value->text ?></div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>