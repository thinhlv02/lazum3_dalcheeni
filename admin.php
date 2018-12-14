<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_cache_limiter('public'); // works too
session_start();

if (!isset($_SESSION['userid']) || $_SESSION['userid'] == NULL) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header("Location:../index.php", true, 301);
    exit;
} else {
    include("config/dbconnect.php");
    include("config/dbconnect_acc.php");
    include("config/dbconnect_log.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SVIP_CMS</title>
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"/>
    <!--[if lt IE 9]>
    <!--coment at 7/7/2017-->
<!--    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen"/>-->
<!--    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
    <!--coment at 7/7/2017-->
<!--    <![endif]-->
    <!--<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>-->
<!--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/hideshow.js" type="text/javascript"></script>
</head>

<body>
<header id="header">
    <hgroup>
        <h1 class="site_title"></h1>
        <h2 class="section_title">Admin Control Panel</h2>
        <!--<div class="btn_view_site"><a href="#">View Site</a></div>-->
    </hgroup>
</header> <!-- end of header bar -->

<section id="secondary_bar">
    <div class="user">
        <p>Xin chào: <?php echo $_SESSION['userid'] ?> </p>
        <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
    </div>
    <div class="breadcrumbs_container">
        <!--<article class="breadcrumbs"><a href="index.html">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>-->
    </div>
</section><!-- end of secondary bar -->

<aside id="sidebar" class="column">
    <h3 id="home"><a href="?action=default">Trang chủ</a></h3>
    <h3>Thống kê User</h3>
    <ul class='toggle'>
        <?php
        if ($_SESSION['userid'] == 'thinhlv') {
            ?>
            <li class="icn_categories"><a href="?action=user_dk_test">Thống kê lượng User đăng kí mới test</a></li>
            <!--            <li class="icn_categories"><a href="?action=arputime">Thống kê PU/ ARPU - ARPPU </a></li>-->
            <li class="icn_categories"><a href="?action=doithuong_money">Thống kê tiền đổi thưởng theo mệnh giá</a></li>
            <?php
        }
        ?>
        <li class="icn_categories"><a href="?action=ccu">CCU</a></li>
        <li class="icn_categories"><a href="?action=user_dk">Thống kê lượng User đăng kí mới</a></li>
        <li class="icn_categories"><a href="?action=user_dk_update_client">Thống kê User update bản client mới</a></li>
        <li class="icn_categories"><a href="?action=user_dk_fb_imei">Thống kê lượng userdk facebook trùng IMEI</a></li>
        <li class="icn_categories"><a href="admin.php?action=user_ip">Thống kê Tổng User ĐK theo IP máy</a></li>
        <li class="icn_categories"><a href="admin.php?action=user_ime">Thống kê đăng ký theo ime</a></li>
        <!--<li class="icn_categories"><a href="?action=topnaptien">TOP nạp tiền</a></li>-->
    </ul>

    <h3>Doanh Thu</h3>
    <ul class='toggle'>
        <li class="icn_categories"><a href="?action=thenap">Thống kê thẻ nạp</a></li>
        <li class="icn_categories"><a href="?action=theouser">Thống kê thẻ nạp từng User</a></li>
        <li class="icn_categories"><a href="?action=smschung">Thống kê SMS</a></li>
        <li class="icn_categories"><a href="?action=smsuser">Thống kê SMS từng User</a></li>
        <li class="icn_categories"><a href="?action=all_money">Thống kê tiền thật trên Server</a></li>
        <li class="icn_categories"><a href="?action=arputime">Thống kê PU/ ARPU - ARPPU </a></li>
        <li class="icn_categories"><a href="?action=a3_a7_a15">Thống kê chỉ số A3-A7-A15-A30</a></li>
        <!--<li class="icn_categories"><a href="?action=tongphe">Tổng phế trên Server</a></li>-->
        <!--<li class="icn_categories"><a href="?action=phevandau">Thống kê phế ván đấu</a></li>-->
        <li class="icn_categories"><a href="?action=phevandau_v2">Thống kê phế ván đấu theo mức cược (v2)</a></li>
        <li class="icn_categories"><a href="?action=chart_money">Biểu đồ nạp tiền theo thời gian</a></li>
        <!--        <li class="icn_categories"><a href="?action=doanhthu_progress">Doanh thu theo đô thị</a></li>-->

    </ul>

    <h3>Thống kê xu - chip</h3>
    <ul class='toggle'>
        <li class="icn_categories"><a href="?action=total_bim">Thống kê Xu trên Server</a></li>
        <!--        <li class="icn_categories"><a href="?action=total_chip">Thống kê Chip trên Server</a></li>-->
        <li class="icn_categories"><a href="?action=xocdia">Thống kê xóc đĩa</a></li>
        <li class="icn_categories"><a href="?action=xocdia_v2">Thống kê xóc đĩa (v2)</a></li>
        <li class="icn_categories"><a href="?action=poker_xeng">Thống kê PokerMini</a></li>
        <li class="icn_categories"><a href="?action=taixiu_vandanh">Thống kê Tài xỉu</a></li>
        <li class="icn_categories"><a href="?action=baucuatomca">Thống kê Bầu cua tôm cá</a></li>
        <li class="icn_categories"><a href="?action=congtien">Thống kê cộng tiền</a></li>
        <li class="icn_categories"><a href="?action=chuyentien">Thống kê chuyển tiền</a></li>
        <!--        <li class="icn_categories"><a href="?action=congchip">Thống kê cộng chip</a></li>-->
    </ul>

    <h3>Thống kê top</h3>
    <ul class='toggle'>
        <li class="icn_categories"><a href="?action=topbim">TOP Tiền Xu</a></li>
        <!--        <li class="icn_categories"><a href="?action=thongke_topchip">Top Tiền Chip</a></li>-->
        <li class="icn_categories"><a href="?action=topthenap">TOP thẻ nạp</a></li>
        <li class="icn_categories"><a href="?action=topsms">TOP SMS</a></li>
        <!--<li class="icn_categories"><a href="?action=topiap">TOP IAP</a></li>-->
        <li class="icn_categories"><a href="?action=topdoithuong">TOP Đổi Thưởng</a></li>
        <li class="icn_categories"><a href="?action=topwinlose">TOP thắng thua trong game </a></li>
        <!--        <li class="icn_categories"><a href="?action=topvip">Thống kê top Vip</a></li>-->
    </ul>

    <h3>Check Log</h3>
    <ul class='toggle'>
        <li class="icn_categories"><a href="?action=thongtin">Thông tin người chơi</a></li>
        <li class="icn_categories"><a href="?action=napthe">Kiểm tra nạp thẻ</a></li>
        <li class="icn_categories"><a href="?action=sms">Kiểm tra nạp SMS</a></li>
        <!--<li class="icn_categories"><a href="?action=iap">Kiểm tra nạp IAP</a></li>-->
        <li class="icn_categories"><a href="?action=tien_log">Thống kê tiền Log</a></li>
        <li class="icn_categories"><a href="?action=dual">Thống kê đánh cặp</a></li>
        <li class="icn_categories"><a href="?action=vandau">Thống kê ván đấu người chơi</a></li>
        <li class="icn_categories"><a href="?action=total_new">Thống kê phân loại người chơi theo từng khoảng tiền</a>
        </li>
        <li class="icn_categories"><a href="?action=user_login">Thống kê user đăng nhập lại game</a>
        </li>
    </ul>

    <h3>Thống Kê Duyệt Đổi Thưởng</h3>
    <ul class='toggle'>
        <li class="icn_categories"><a href="?action=doithuong">Thống kê đổi thưởng</a></li>
        <li class="icn_categories"><a href="?action=tinnhan">Thống kê tin nhắn đổi thưởng</a></li>
        <li class="icn_categories"><a href="?action=doithuong_money">Thống kê tiền đổi thưởng theo mệnh giá</a></li>
    </ul>

    <h3>Chăm Sóc Khách Hàng</h3>
    <ul class='toggle'>
        <!--        <li class="icn_categories"><a href="?action=tilexuchip">Tỉ lệ xu chip</a></li>-->
        <li class="icn_categories"><a href="?action=chat_admin">Thống kê tin nhắn chat_ admin</a></li>
        <li class="icn_categories"><a href="?action=message">Gửi tin nhắn cho người chơi</a></li>
        <!--        <li class="icn_categories"><a href="?action=message_dk">Gửi tin nhắn cho người chơi theo điều kiện lọc</a></li>-->
        <!--        <li class="icn_categories"><a href="?action=black_list">Danh sách user ẩn đổi thưởng</a></li>-->
        <li class="icn_categories"><a href="?action=fcm">Messaging FCM</a></li>
        <!--<li class="icn_categories"><a href="?action=total_money">Tổng BIM trên Server</a></li>-->
    </ul>

    <!--<h3>Đối Soát</h3>
    <ul class = 'toggle'>
        <li class="icn_categories"><a href="?action=doisoat_card">Đối soát Thẻ cào</a></li>
        <li class="icn_categories"><a href="?action=doisoat_sms">Đối soát Sms</a></li>
        <li class="icn_categories"><a href="?action=doisoat_topup">Đối soát Topup</a></li>-->
    <!--<li class="icn_categories"><a href="?action=tongphe">Tổng phế trên Server</a></li>
    <li class="icn_categories"><a href="?action=phevandau">Thống kê phế ván đấu</a></li>
    <li class="icn_categories"><a href="?action=chuyentien">Thống kê chuyển tiền</a></li>
</ul>-->

    <h3>Quản Trị game</h3>
    <ul class='toggle'>
        <li class="icn_categories"><a href="?action=tbl_title">Tạo chữ chạy trên loa thông báo</a></li>
        <li class="icn_categories"><a href="?action=tb_event">Tạo thông báo Event</a></li>
        <li class="icn_categories"><a href="?action=addmoney">Cộng tiền cho người chơi</a></li>
        <li class="icn_categories"><a href="?action=thaydoisdt">Thay đổi SĐT CSKH</a></li>
        <li class="icn_categories"><a href="?action=lock_unlock">Lock và unlock người chơi</a></li>
        <li class="icn_categories"><a href="?action=thongke_top_lock">Thống kê Top lock người chơi</a></li>
        <li class="icn_categories"><a href="?action=show_hide_gc">Ẩn hiện đổi thưởng</a></li>
        <li class="icn_categories"><a href="?action=reset">Reset bàn chơi</a></li>
        <li class="icn_categories"><a href="?action=reload">Reload database</a></li>
        <li class="icn_categories"><a href="?action=choingay">Cập nhật trường chơi ngay khi vào game</a></li>
        <li class="icn_categories"><a href="?action=taixiu">Thông tin bảng tài xỉu</a></li>
        <li class="icn_categories"><a href="?action=change_paycard">Chuyển kênh nạp thẻ</a></li>
        <!--<li class="icn_categories"><a href="?action=doiheso">Thay đổi hệ số Free Money - Đổi thưởng</a></li>-->
        <!--<li class="icn_categories"><a href="?action=thongbao">Tạo thông báo Server</a></li>
        <li class="icn_categories"><a href="?action=push">Tạo thông báo đẩy</a></li>
        <li class="icn_categories"><a href="?action=email">Gửi Email cho người chơi</a></li>-->
    </ul>

    <h3>Partner</h3>
    <ul class="toggle">
        <li class="icn_categories"><a href="?action=taouser">Tạo User đăng nhập</a></li>
        <!--        <li class="icn_categories"><a href="?action=taoprovider">Tạo Provider</a></li>-->
        <!--        <li class="icn_categories"><a href="?action=details">Tạo chi tiết Provider</a></li>-->
        <li class="icn_categories"><a href="?action=provider">Danh sách Provider</a></li>
        <li class="icn_categories"><a href="?action=user">Danh sách người dùng</a></li>
        <li class="icn_categories"><a href="?action=doithuong_partner">Thống kê đổi thưởng Partner</a></li>
        <!--        <li class="icn_categories"><a href="?action=partner_thenap">Thống kê thẻ nạp theo Partner</a></li>-->
        <!--        <li class="icn_categories"><a href="?action=partner_sms">Thống kê sms theo Partner</a></li>-->
        <!--        <li class="icn_categories"><a href="?action=active">Thống kê Active User</a></li>-->
        <!--<li class="icn_categories"><a href="?action=free_chip">Thống kê User nhận Free Money</a></li>
        <!--<li class="icn_categories"><a href="?action=thongketop">Thống kê TOP</a></li>-->
        <!--<li class="icn_categories"><a href="?action=bogame">Lượng người bỏ game</a></li>-->
        <!--<li class="icn_categories"><a href="?action=khuyenmai">Thay đổi hệ số SMS-Thẻ nạp</a></li>-->
    </ul>
    <h3>Kinh doanh</h3>
    <ul class='toggle'>
        <li class="icn_categories"><a href="?action=kinhdoanh">Kinh doanh</a></li>
    </ul>
    <h3>Phân Quyền</h3>
    <ul class="toggle">
        <li class="icn_security"><a href="?action=changepass">Đổi mật khẩu</a></li>
        <li class="icn_jump_back"><a href="config/logout.php">Logout</a></li>
        <!--        <li class="icn_categories"><a href="?action=test">Test</a></li>-->
        <!--
        <li class="icn_categories"><a href="?action=arpu">Thống kê ARPU theo tháng</a></li>-->
    </ul>
    <footer>
        <hr/>
        <!--<p><strong>Copyright &copy; 2015 SGROUP COMPANY</strong></p>-->
    </footer>
</aside><!-- end of sidebar -->

<section id="main" class="column">
    <?php
    if (isset($_GET['action'])) $action = $_GET['action']; else $action = '';
    if (isset($_GET['function'])) $function = $_GET['function']; else $function = '';
    switch ($action) {
        //thongkenguoidung
        // tbl_title
        case 'tbl_title':
            include("quanlyserver/tbl_title.php");
            break;
        case 'chat_admin':
            switch ($function) {
                case 'reply':
                    include('quanlyserver/reply_chat.php');
                    break;
                default:
                    include("thongke/chat_admin.php");
            }
            break;
        case 'reset':
            include("thongke/resetbanchoi.php");
            break;
        case 'bogame':
            include("thongke/bogame.php");
            break;
        case 'tilexuchip':
            include("thongke/tilexuchip.php");
            break;
        case 'thaydoisdt':
            include("thongke/thaydoisdt.php");
            break;
        case 'dual':
            include("thongke/dual.php");
            break;
        case 'vandau':
            include("thongke/vandau_page.php");
            break;
        case 'total_new':
            include("thongke/total_new.php");
            break;
        case 'user_login':
//            include("thongke/user_login.php");
            include("thongke/user_login2.php");
            break;
        case 'topvip':
            include("thongke/topvip.php");
            break;
        case 'free_chip':
            include("thongkechung/free_chip.php");
            break;
        case 'total_money':
            include("thongkechung/total_money.php");
            break;
        case 'total_bim':
            include("thongkechung/total_bim.php");
            break;
        case 'total_chip':
            include("thongkechung/total_chip.php");
            break;
        case 'congtien':
            switch ($function) {
                case 'check_log':
                    include('thongke/tien_log.php');
                    break;
                default:
                    include("thongke/congtien.php");
            }
            break;
        case 'congchip':
            include("thongke/congchip.php");
            break;
        case 'chuyentien':
            include("thongke/chuyentien.php");
            break;
        case 'active':
            include("thongke/active_users.php");
            break;
        case 'phevandau':
            include("thongke/phevandau.php");
            break;
        case 'phevandau_v2':
            include("thongke/phevandau_v4_2.php");
            break;
        case 'chart_money':
            include("thongke/chart_money.php");
            break;
        case 'doanhthu_progress':
            include("thongke/doanhthu_progress.php");
            break;
        case 'doithuong':
            switch ($function) {
                case 'thongtin':
                    include("thongke/thongtin.php");
                    break;
                // default:include("thongke/doithuong_new.php");
                default:
                    include("thongke/doithuong_page.php");
            }
            break;

        case 'dongy':
            include("thongke/dongy.php");
            break;
        case 'tinnhan':
            include("thongke/tinnhan.php");
            break;
        case 'doithuong_partner':
            include("thongke/doithuong_partner.php");
            break;
        case 'thongke_topchip':
            include("thongke/thongke_topchip.php");
            break;

        /* tien log */
        case 'tien_log':
            switch ($function) {
                case 'chitiet_log':
                    include("thongke/chitiet_log.php");
                    break;
                default:
                    include("thongke/tien_log.php");
            }
            break;

        case 'napthe':
            include("thongke/check_napthe.php");
            break;
        case 'sms':
            include("thongke/check_sms.php");
            break;
        case 'iap':
            include("thongkechung/inapp_thongke.php");
            break;
        case 'topiap':
            include("thongkechung/inapp_top.php");
            break;
        case 'topdoithuong':
            include("thongkechung/topdoithuong.php");
            break;
        case 'topbim':
            include("thongke/thongke_top.php");
            break;
        case 'topwinlose':
            include("thongke/topwinlose.php");
            break;
        case 'topnaptien':
            include("thongke/topnaptien.php");
            break;
        case 'thongtin':
            include("thongke/thongtin.php");
            break;

        /* user đk */
        case 'user_dk':
            switch ($function) {
                // case 'user_detail':include("thongke/user_detail.php");break;
                // default: include("thongke/user_dk_new.php");
                default:
                    include("thongke/user_dk_page.php");
            }
            break;
        case 'user_dk_update_client':
            switch ($function) {
                // case 'user_detail':include("thongke/user_detail.php");break;
                // default: include("thongke/user_dk_new.php");
                default:
                    include("thongke/user_dk_update_client.php");
            }
            break;
        case 'user_dk_fb_imei':
            switch ($function) {
//                case 'user_dk_fb_imei_details':
//                    include("thongke/user_dk_fb_imei_details.php");
//                    break;
                default:
                    include("thongke/user_dk_fb_imei.php");
            }
            break;

        case 'user_dk_test':
            switch ($function) {
                default:
                    include("thongke/user_dk_page_test.php");
            }
            break;
        case 'doithuong_money':
            include("thongke/doithuong_money.php");
            break;

        case 'user_ip':
            switch ($function) {
                case 'ip_detail':
                    include("thongke/ip_detail.php");
                    break;
                default:
                    include("thongke/user_ip.php");
//                    header('Location: http://www.google.com/');

            }
            break;

        // case 'user_ip': include("thongke/user_ip.php");break;
        case 'user_ime':
            include('thongke/user_ime.php');
            break;

        case 'khuyenmai':
            include("thongke/thaydoi_km.php");
            break;

        //admin
        case 'doiheso':
            include("admin/doiheso.php");
            break;
        case 'provider':
            switch ($function) {
                case'edit_provider':
                    include("admin/edit_provider.php");
                    break;
                default:
                    include("admin/ds_provider.php");
                    break;
            }
            break;
        case 'taouser':
            include("admin/taouser.php");
            break;
        case 'taoprovider':
            include("admin/taoma_kd.php");
            break;
        case 'details':
            include("admin/chitiet_mkd.php");
            break;
        case 'user':
            switch ($function) {
                case 'edit_user':
                    include("admin/edit_user.php");
                    break;
                default:
                    include("admin/ds_user.php");
                    break;
            }
            break;
        case 'ql_server':
            include("admin/ql_server.php");
            break;
        case 'ccu':
            include("admin/CCU.php");
            break;
        //thongkechung
        case 'topthenap':
            switch ($function) {
                case 'card_details':
                    include("thongkechung/card_details.php");
                    break;
                default:
                    include("thongkechung/topthenap.php");
            }
            break;
        case 'xocdia':
            include("thongkechung/xocdia.php");
            break;
        case 'xocdia_v2':
            include("thongkechung/xocdia_v2_cutoff.php");
            break;
        case 'poker_xeng':
            include("thongkechung/poker_xeng.php");
            break;
        case 'taixiu_vandanh':
            include("thongkechung/taixiu_vandanh.php");
            break;
        case 'change_paycard':
            include("paycard/change_paycard.php");
            break;
        case 'baucuatomca':
            include("thongkechung/baucuatomca.php");
            break;
        case 'thenap':
            include("thongkechung/thongkethenap.php");
            break;
        case 'doisoat_card':
            include("doisoat/card.php");
            break;
        case 'smschung':
            include("thongkechung/thongkesms.php");
            break;
        case 'arpu':
            include("thongkechung/arpu.php");
            break;
        case 'arputime':
            include("thongkechung/arputime_new.php");
            break;
        /* top sms */
        case 'topsms':
            switch ($function) {
                case 'sms_detail':
                    include("thongkechung/sms_details.php");
                    break;
                default:
                    include("thongkechung/thongketopsms_user.php");
            }
            break;

        case 'theouser':
            switch ($function) {
                case 'card_details':
                    include("thongkechung/card_details.php");
                    break;
                default:
                    include("thongkechung/thongkethe_user.php");
            }
            break;

        case 'smsuser':
            include("thongkechung/thongkesms_user.php");
            break;
        case 'partner_thenap':
            include("thongkechung/partner_thenap.php");
            break;
        case 'partner_sms':
            include("thongkechung/partner_sms.php");
            break;
        case 'kinhdoanh':
            include("thongke/kinhdoanh.php");
            break;
        case 'tongphe':
            include("thongkechung/tongphe.php");
            break;
        case 'all_money':
            include("thongkechung/all_money.php");
            break;
        case 'a3_a7_a15':
            include("thongkechung/chiso_a3_a7_a15_cutoff.php");
            break;

        /* quanlyserver */
        case 'addmoney':
            include("quanlyserver/congtien.php");
            break;

        /* event */
        case 'tb_event':
            switch ($function) {
                case 'edit_event':
                    include("quanlyserver/update_event.php");
                    break;
                default:
                    include("quanlyserver/event_manager.php");
            }
            break;

        case 'thongbao':
            include("quanlyserver/tb_server.php");
            break;

        /* Tạo thông báo đẩy */
        case 'push':
            switch ($function) {
                case 'edit_notifi':
                    include("quanlyserver/edit_notifi.php");
                    break;
                default:
                    include("quanlyserver/notification.php");
            }
            break;

        case 'email':
            include("quanlyserver/email.php");
            break;
        case 'message':
            include("quanlyserver/message_page.php");
            break;
//        case 'message_dk':
//            include("quanlyserver/message_dk.php");
//            break;
        case 'black_list':
            include("quanlyserver/black_list_page.php");
            break;
        case 'fcm':
            include("fcm/index.php");
            break;
        case 'lock_unlock':
            include("quanlyserver/lock_unlock.php");
            break;
        case 'thongke_top_lock':
            include("thongke/thongke_top_lock.php");
            break;

        case 'reload':
            include("quanlyserver/reload.php");
            break;
        case 'choingay':
            include("quanlyserver/choingay.php");
            break;
        case 'taixiu':
            include("quanlyserver/taixiu.php");
            break;
        case 'show_hide_gc':
            include("quanlyserver/show_hide_gc.php");
            break;
        case 'test':
            include("thongke/phevandau_v4_3.php");
            break;
        //quanlydangnhap
        case 'changepass':
            include("config/changepass.php");
            break;
        default:
            include("thongke/thongke_top.php");
    }
    ?>
</section>
</body>
</html>