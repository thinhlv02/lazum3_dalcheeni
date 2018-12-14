<div class="notice-game margin-top">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title" style="text-align: center;">Thông báo</h2>
        </div>
        <div class="panel-body">
            <ul>
                <?php foreach ($notice_right as $key => $value): ?>
                    <li><a href="<?php echo base_url().'thong-bao/'.create_slug($value->name).'-'.$value->id.'.html' ?>"><?php echo $value->name ?></a></li>
                <?php endforeach ?>
            </ul>
            <a href="<?php echo base_url('thong-bao') ?>">Xem thêm </a>
        </div>
    </div>
</div>
<div class="margin-top">
    <div class="fb-page" data-href="https://www.facebook.com/verking.gamebaidoithe/" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/verking.gamebaidoithe/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/verking.gamebaidoithe/">VerKing - Game Bài Đổi Thưởng</a></blockquote></div>
</div>