<?php $menu_access = $this->session->userdata('menu_access'); ?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo admin_url('employee') ?>" class="site_title"><i class="fa fa-paw"></i>
                <span>Trang chủ</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo base_url() ?>/public/lichtuan.png" alt=""
                     class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Xin chào,</span>
                <h2><?php echo $admin->UserName ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br/>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    <!---->
                    <!--                    // $access = $this->menu_access_model->get_column('menu_access', 'access',-->
                    <!--                    // array('employee_id' => $admin->employee_id, 'menu_id' => 1))[0]->access;-->
                    <!--                    --><?php //pre($menu_access) ?>

                    <?php if ($menu_access[1] >= 1) { ?>
                        <li><a><i class="fa fa-tasks"></i>Quản lý nhân sự<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[1] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('employee') ?>">Danh sách nhân sự</a></li>
                                <?php }
                                ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[2] >= 1 || $menu_access[3] >= 1 || $menu_access[4] >= 1) { ?>
                        <li><a><i class="fa fa-tasks"></i>DS HLV, DV<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[2] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('hlv') ?>">Danh sách HLV, DV</a></li>
                                <?php }
                                ?>

                                <?php if ($menu_access[3] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('phieuluong') ?>">Phiếu lương</a></li>
                                <?php }
                                ?>

                                <?php if ($menu_access[4] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('bangchamcong') ?>">Bảng chấm công</a></li>
                                <?php }
                                ?>

                                <?php if ($menu_access[14] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('congphatsinh') ?>">Công phát sinh</a></li>
                                <?php }
                                ?>

                                <?php if ($menu_access[15] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('phieuluongthungan') ?>">Phiếu lương thu ngân</a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[5] >= 1 || $menu_access[6] >= 1 || $menu_access[7] >= 1) { ?>
                        <li><a><i class="fa fa-bed"></i>Quản lý lớp học<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[5] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('branch') ?>">Danh sách địa điểm</a></li>
                                <?php }
                                ?>

                                <?php if ($menu_access[6] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('room') ?>">Danh sách lớp học</a></li>
                                <?php }
                                ?>

                                <?php if ($menu_access[7] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('schedule_week') ?>">Lịch tuần cho các phòng
                                            học</a>
                                    </li>                                <?php }
                                ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[8] >= 1) { ?>
                        <li><a><i class="fa fa-building-o"></i>Quản lý phòng ban<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[8] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('department') ?>">Danh sách phòng ban</a></li>
                                <?php }
                                ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[9] >= 1 || $menu_access[10] >= 1) { ?>
                        <li><a><i class="fa fa-bars"></i>Quản lý hợp đồng<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[9] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('contract') ?>">Các loại hợp đồng</a></li>
                                <?php }
                                ?>

                                <?php if ($menu_access[10] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('contract_detail') ?>">Chi tiết các hợp đồng</a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[11] >= 1 || $menu_access[12] >= 1) { ?>
                        <li><a><i class="fa fa-graduation-cap"></i>Quản lý học viên, thẻ<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[11] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('student') ?>">Danh sách học viên</a></li>
                                <?php }
                                ?>

                                <?php if ($menu_access[12] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('card') ?>">Danh sách thẻ</a></li>
                                <?php }
                                ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[13] >= 1) { ?>
                        <li><a><i class="fa fa-graduation-cap"></i>Quản lý Level HLV<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[13] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('level') ?>">Level HLV</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php
                    if ($admin->employee_id == 141189 || $admin->employee_id == 141188) { ?>
                        <li><a><i class="fa fa-user"></i>Admin<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo admin_url('admin') ?>">Danh sách tài khoản</a></li>
                            </ul>
                        </li>
                    <?php }
                    ?>

                    <?php if ($menu_access[16] >= 1 || $menu_access[17] >= 1 || $menu_access[18] >= 1 || $menu_access[19] >= 1) { ?>
                        <li><a><i class="fa fa-bar-chart"></i>Báo cáo kinh doanh<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[16] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('schedule_week_kd') ?>">HLV, TN</a></li>
                                <?php } ?>

                                <?php if ($menu_access[17] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('phieuluong_kd') ?>">Phiếu lương Kinh doanh</a>
                                    </li>
                                <?php } ?>

                                <?php if ($menu_access[18] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('bangchamcong_kd') ?>">Bảng chấm công Kinh
                                            doanh</a></li>
                                <?php } ?>

                                <?php if ($menu_access[19] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('report_card') ?>">Báo cáo loại thẻ</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>