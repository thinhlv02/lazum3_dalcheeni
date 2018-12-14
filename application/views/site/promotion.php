<div class="notice-game margin-top">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title" style="text-align: center;">Khuyến mãi</h2>
        </div>
        <div class="panel-body">
            <ul>
                <?php foreach ($promotion_footer as $key => $value): ?>
                    <li><a href="<?php echo base_url().'promotion/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><?php echo $value->name ?></a></li>
                <?php endforeach ?>
            </ul>
            <a href="<?php echo base_url('promotion') ?>">Xem thêm </a>
        </div>
    </div>
</div>