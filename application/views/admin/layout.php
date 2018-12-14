<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('admin/head'); ?>
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php $this->load->view('admin/left'); ?>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="<?php echo base_url() ?>/public/lichtuan.png"
                                     alt=""><?php echo $admin->UserName ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="<?php echo base_url('admin/home/info') ?>"> Thông tin cá nhân</a></li>
                                <li><a href="<?php echo base_url('admin/home/logout') ?>"><i
                                                class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown" style="display: none">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img
                                                    src="<?php echo admin_theme() ?>production/images/img.jpg"
                                                    alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img
                                                    src="<?php echo admin_theme() ?>production/images/img.jpg"
                                                    alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img
                                                    src="<?php echo admin_theme() ?>production/images/img.jpg"
                                                    alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img
                                                    src="<?php echo admin_theme() ?>production/images/img.jpg"
                                                    alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php $this->load->view($temp) ?>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Thiết kế bởi SGC
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
<?php //$this->load->view('admin/js') ?>
<?php $this->load->view('admin/js_thinhlv') ?>
</body>
</html>