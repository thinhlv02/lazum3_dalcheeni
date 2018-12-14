<?php if ($message) {
    $this->load->view('admin/message', $this->data);
    $this->load->model('branch_model');
} ?>
<div class="page-title">
    <div class="title_left"><h3>Bảng chấm công</h3></div>
    <div class="title_right">
        <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
        <!--            <a href="-->
        <?php //echo admin_url('employee/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
        <!--            <a href="-->
        <?php //echo admin_url('employee') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
        <!--        </div>-->
    </div>
</div>
<div class="x_panel">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Chọn tên hlv, dv<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="employee">
                    <?php
                    $_SESSION['employee'] = $_POST['employee'];
                    ?>
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($emp as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($_SESSION['employee'] == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Bắt đầu<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtFrom" name="txtFrom" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['txtFrom'])) echo $_POST['txtFrom'] ?>">
                </div>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">kết thúc<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" id="txtTo" name="txtTo" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnAddEvent" class="btn btn-success"
                       value="Search">
            </div>
        </div>
    </form>
</div>
<div class="x_panel">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="x_title">
            <h2>Danh sách</h2>
            <?php if (isset($arr_week) && count($arr_week) > 0) { ?>
                <form method="post">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                        <input type="submit" name="btnExportData" class="btn btn-success"
                               value="Export excel">
                    </div>
                </form>
            <?php } ?>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped table-bordered bulk_action">
                <thead>
                <tr style="background-color: wheat;">
                    <!--                    <th>Week_id</th>-->
                    <th>Địa điểm</th>
                    <th>T2</th>
                    <th>T3</th>
                    <th>T4</th>
                    <th>T5</th>
                    <th>T6</th>
                    <th>T7</th>
                    <th>CN</th>
                    <th>Tổng</th>
                </tr>
                </thead>

                <tbody>
                <?php if (isset($arr_week) && count($arr_week) > 0) {
//                    pre($arr_week);
                    $total_m = 0;
                    ?>
                    <?php foreach ($arr_week as $key => $value): ?>
                        <?php
                        $tuan = $this->week_model->get_info($value->week_id);
//                        pre($tuan);
                        $total_week = 0;
                        ?>
                        <tr>
                            <td colspan="9" style="text-align: center;text-transform: uppercase;font-weight: bold;">
                                Tuần từ: <?php echo date('d/m', $value->start) ?>
                                - <?php echo date('d/m', $value->end) ?>
                            </td>
                        </tr>
                        <?php
                        foreach ($arr_branch_id as $key => $value1):
//                            echo 'value1:- >>>'. $value1;
//                        chekc branid
                            $value1_check = $this->bangchamcong_model->check_branch($value1);
                            $total = ''; ?>
                            <tr>
                                <!--                                <td>--><?php //echo $value->week_id
                                ?><!--</td>-->
                                <td style="font-weight: bold"><?php if ($value1_check) echo $this->branch_model->get_info($value1)->name ?></td>
                                <td>
                                    <?php $dem = ''; ?>
                                    <?php foreach ($value->data as $data) {
                                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->mon) {
                                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'mon');
//                                            pre($check_id_teach);
                                            if ($check_id_teach) {
                                                $total++;
                                                $dem++;
//                                            break;
                                            }
                                        }
                                    }
                                    echo $dem
                                    ?>
                                </td>
                                <td>
                                    <?php $dem = ''; ?>
                                    <?php foreach ($value->data as $data) {
//                                        pre($data);
                                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->tue) {
                                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'tue');
//                                            pre($check_id_teach);
                                            if ($check_id_teach) {
//                                            check id_teach có nằm trong schedule_week
                                                $total++;
                                                $dem++;
//                                                echo '1' . ' + ';
//                                            echo $value1 . ' xx' . $tuan->tue;
//                                            break;
                                            }
                                        }
                                    }
                                    echo $dem
                                    ?>
                                </td>
                                <td>
                                    <?php $dem = ''; ?>
                                    <?php foreach ($value->data as $data) {
                                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->wed) {
                                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'wed');
//                                            pre($check_id_teach);
                                            if ($check_id_teach) {
                                                $total++;
                                                $dem++;
                                            }
//                                            break;
                                        }
                                    }
                                    echo $dem
                                    ?>
                                </td>
                                <td>
                                    <?php $dem = ''; ?>
                                    <?php foreach ($value->data as $data) {
                                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->thu) {
                                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'thu');
//                                            pre($check_id_teach);
                                            if ($check_id_teach) {
                                                $total++;
                                                $dem++;
//                                            break;
                                            }
                                        }
                                    }
                                    echo $dem
                                    ?>
                                </td>
                                <td>
                                    <?php $dem = ''; ?>
                                    <?php foreach ($value->data as $data) {
                                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->fri) {
                                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'fri');
//                                            pre($check_id_teach);
                                            if ($check_id_teach) {
                                                $total++;
                                                $dem++;
                                            }
//                                            break;
                                        }
                                    }
                                    echo $dem
                                    ?>
                                </td>
                                <td>
                                    <?php $dem = ''; ?>
                                    <?php foreach ($value->data as $data) {
                                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->sat) {
                                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'sat');
//                                            pre($check_id_teach);
                                            if ($check_id_teach) {
                                                $total++;
                                                $dem++;
                                            }
//                                            break;
                                        }
                                    }
                                    echo $dem
                                    ?>
                                </td>
                                <td>
                                    <?php $dem = ''; ?>
                                    <?php foreach ($value->data as $data) {
                                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->sun) {
                                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'sun');
//                                            pre($check_id_teach);
                                            if ($check_id_teach) {
                                                $total++;
                                                $dem++;
                                            }
//                                            break;
                                        }
                                    }
                                    echo $dem
                                    ?>
                                </td>
                                <td><?php echo $total; ?></td>
                                <!--                            <td>--><?php //echo date('d-m-Y', $value->date)
                                ?><!--</td>-->
                            </tr>
                            <?php $total_week += $total ?>
                        <?php endforeach ?>
                        <td colspan="8"
                            style="text-align: center;text-transform: uppercase;font-weight: bold;color: red;background-color: #D3D3D3;">
                            Tổng tuần:
                        </td>
                        <td style="color: red;font-weight: bold"><?php echo $total_week ?></td>
                        <?php $total_m += $total_week; ?>
                    <?php endforeach ?>
                    <tr style="background-color: #F5DEB3;">
                        <td colspan="8" style="text-align: center;text-transform: uppercase;font-weight: bold">Tổng
                            tháng
                        </td>
                        <td><?php echo $total_m ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

<style type="text/css">
    td {
        vertical-align: middle !important;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }
</style>
<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa nhân sự này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('employee/del/')?>" + id;
        }
    }
</script>