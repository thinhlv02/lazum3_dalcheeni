<div class="wrapper-header">
    <div class="container">
        <!-- <div id=top> -->
        <!-- <div id=bg_top><img src="<?php echo public_url("images/icon_game") ?>/logo.png"></div> -->
        <!--<div id=lg_before style=display:block>-->
        <!--<span class=font20 style=margin-left:165px>Đăng Nhập Với:</span>-->
        <!--<img id=ic_fb_index class=img_middle src=<?php echo public_url("images/icon_game") ?>fb.png alt="wide image"/>-->
        <!--<span onclick="show_DL(0)" class="font20 underLine" style="margin-left: 110px;display:none"> Đăng Nhập </span>-->
        <!--<span onclick="show_DL(1)" class="font20 underLine" style="margin-left: 245px;display:none"> Đăng Ký </span>-->
        <!--</div>-->

        <!-- <div id="top-left">
	            <div class="top-icon" id="btn_sukien">
	                <div id="total_event">
	                    <div class="top-icon-count">1</div>
	                </div>
	                <img src="<?php echo public_url("images/icon_game") ?>/sukien.png"><br><label>Sự kiện</label></div>
	            <div class="top-icon" id="btn_tintuc">
	                <div id="total_inbox"></div>
	                <img src="<?php echo public_url("images/icon_game") ?>/homthu.png"><br><label>Hòm thư</label></div>
	            <div class="top-icon" id="btn_doithuong"><img src="<?php echo public_url("images/icon_game") ?>/doithuong.png"><br><label>Đổi thưởng</label>
	            </div>
	        </div>
	        <div id=top-right>
	            <div class="top-icon" id="btn_napthe"><img src="<?php echo public_url("images/icon_game") ?>/napthe.png"><br><label>Nạp thẻ</label></div>
	            <div class="top-icon" id="btn_quydinh"><img src="<?php echo public_url("images/icon_game") ?>/quydinh.png"><br><label>Quy định</label></div>
	            <div class="top-icon" id=setting-game><img src="<?php echo public_url("images/icon_game") ?>/caidat.png"><br><label>Cài đặt</label></div>
	        </div> -->
        <!-- </div> -->

        <div class="menu-header">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                <li><a href="#" class="playGame">Chơi game</a></li>
                <li><a href="<?php echo base_url('doi-thuong') ?>">Đổi thưởng <img
                                src="<?php echo public_url('images/hot.gif') ?>"></a></li>
                <li><a href="<?php echo base_url('thong-bao') ?>">Thông báo</a></li>
                <li><a href="<?php echo base_url('su-kien') ?>">Sự kiện <span
                                class="badge"><?php if ($count_event > 0) echo $count_event ?></span></a></a></li>
                <li><a href="<?php echo base_url('huong-dan') ?>">Hướng dẫn</a></li>
                <li><a href="<?php echo base_url('tai-game-danh-bai-doi-thuong') ?>">Tải game</a></li>
                <li><a href="<?php echo base_url('promotion') ?>">Khuyến mãi</a></li>
            </ul>
        </div>
        <div class=" bottom-header">
            <!-- <div class="item-header btn-join-game playGame">
                <div class="icon-item-header"><i class="fa fa-play" aria-hidden="true"></i></div>
                <div class="join-game">Vào game</div>
            </div> -->
            <a href="<?php echo base_url() ?>">
                <div class="item-header" style="width: 170px">
                    <div class="icon-item-header"><a href="#" class="playGame"><img src="<?php echo public_url('images/logo.png') ?>"
                                                          style="    margin-top: -10px;width: 76px"></a></div>
                    <!-- <div class="title-item-header" style="margin-top: 15px; width: 90px">TRANG CHỦ</div> -->
                </div>
            </a>
            <!-- <div class="item-header" style="width: 80px; float: left;">
				<a href="<?php echo base_url() ?>"><img src="<?php echo public_url('images/logo.png') ?>" width="55px"></a>
			</div> -->
            <div class="item-header" style="width: 180px">
                <div class="icon-item-header circle"><i class="fa fa-phone" aria-hidden="true"></i></div>
                <div class="title-item-header" style="width: 120px">HOTLINE</div>
                <div class="content-item-header"><?php echo $content->hotline ?></div>
            </div>
            <div class="item-header">
                <div class="icon-item-header"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                <div class="title-item-header">HỖ TRỢ TRỰC TUYẾN</div>
                <div class="content-item-header"><?php echo $content->email ?></div>
            </div>
            <div class="download-game">
                <a href="<?php echo $content->linkiOS ?>"><img
                            src="<?php echo public_url('images/appstore.png'); ?>"></a>
                <a href="<?php echo $content->linkAndroid ?>"><img
                            src="<?php echo public_url('images/playstore.png'); ?>" style="margin-left: 10px"></a>
            </div>
        </div>
    </div>
</div>
