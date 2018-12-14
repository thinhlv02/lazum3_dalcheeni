<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Tuần <?php echo $week->week_number ?>
            <small>(<?php echo date('d/m', $week->mon) ?> - <?php echo date('d/m', $week->sun) ?>)</small>
        </h3>
    </div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('schedule_week/add') ?><!--" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> mới</a>-->
            <a href="<?php echo admin_url('schedule_week') ?>" class="btn btn-info btn-sm">Danh sách tuần</a>
        </div>
    </div>
</div>

<div class="x_panel">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Địa điểm<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <?php $branch_s = $this->branch_model->get_list(); ?>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="branch_s">
                    <?php
                    session_start();
                    $_SESSION['branch_s'] = $_POST['branch_s'];
                    ?>
                    <option value="99">All</option>
                    <?php foreach ($branch_s as $value): ?>
                        <option value="<?php echo $value->id ?>" <?php if ($_SESSION['branch_s'] == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnSearch" required class="btn btn-success"
                       value="Tìm kiếm">
            </div>
        </div>
    </form>
</div>
<?php
if (isset($_POST['btnSearch'])) {
    if ($_POST['branch_s'] != '99') {
//        echo 'branchID: ' . $_POST['branch_s'];
//        echo ' week_id: ' . $week_id;
        $input['where'] = array(
            'week_id' => $week_id,
            'branch_id' => $_POST['branch_s']
        );
        $schedule_week = $this->schedule_week_model->get_list($input);
//        pre($schedule_week);
    }
}
?>
<div class="x_panel">
    <div class="x_title">
        <h2>Danh sách</h2>
        <?php if (isset($branch) && count($branch) > 0) { ?>
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
        <!--                <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
        <table id="" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <!--                <th>ID_Branch</th>-->
                <th>Stt</th>
                <th>Địa điểm</th>
                <th style="">Thứ 2
                    <br>
                    <small class="white-space"><?php echo date('d-m-Y', $week->mon) ?></small>
                </th>
                <th>Thứ 3
                    <br>
                    <small class="white-space"><?php echo date('d-m-Y', $week->tue) ?></small>
                </th>
                <th>Thứ 4
                    <br>
                    <small class="white-space"><?php echo date('d-m-Y', $week->wed) ?></small>
                </th>
                <th>Thứ 5 <br>
                    <small class="white-space"><?php echo date('d-m-Y', $week->thu) ?></small>
                </th>
                <th>Thứ 6 <br>
                    <small class="white-space"><?php echo date('d-m-Y', $week->fri) ?></small>
                </th>
                <th>Thứ 7 <br>
                    <small class="white-space"><?php echo date('d-m-Y', $week->sat) ?></small>
                </th>
                <th>Chủ nhật <br>
                    <small class="white-space"><?php echo date('d-m-Y', $week->sun) ?></small>
                </th>
                <!--                <th>Hành động</th>-->
            </tr>
            </thead>

            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($branch as $key => $value): ?>
                <?php $i++ ?>
                <?php
                $input = array();
//                $input['where'] = array('branch_id' => $value->id, 'week_id' => $schedule_week[$key]->id);
                $input['where'] = array('branch_id' => $value->id, 'week_id' => $week->id);
//                pre($input);
//                $input['where'] = array('branch_id' => 6, 'week_id' => 1);
                $item = $this->schedule_week_model->get_list($input);
//                prev($input);
//                pre($item);
                $itemMonId = null;
                $itemTueId = null;
                $itemWedId = null;
                $itemThuId = null;
                $itemFriId = null;
                $itemSatId = null;
                $itemSunId = null;
                if ($item) {
                    $itemMonId = explode(',', $item[0]->mon);
                    $itemTueId = explode(',', $item[0]->tue);
                    $itemWedId = explode(',', $item[0]->wed);
                    $itemThuId = explode(',', $item[0]->thu);
                    $itemFriId = explode(',', $item[0]->fri);
                    $itemSatId = explode(',', $item[0]->sat);
                    $itemSunId = explode(',', $item[0]->sun);
//                    pre($itemMonId);
                }
//                $itemMon = $item[0] . mon;
//                pre($item);
                ?>
                <tr>
                    <!--                    <td>--><?php //echo $value->id ?><!--</td>-->
                    <td><?php echo $i ?></td>
                    <td><?php echo $value->name ?></td>
                    <td id="<?php echo $value->id . '_mon' ?>"
                        class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_mon') echo 'schedule_week_selected'; ?>">
                        <?php if ($itemMonId && $itemMonId[0]) { ?>
                            <!--                            --><?php //var_dump($itemMonId[0]) ?>
                            <?php foreach ($itemMonId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <div id="<?php echo $row; ?>"
                                     class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'schedule_week_selected'; ?>">
                                    <span style="color: red"> <?php echo $itemMon->start ?></span><br>
                                    <span class="white-space" style="color: green"><?php if ($info) echo $info->displayName . ' - ' . $itemMon->level_room ?></span>
                                    <br>
                                    <span style="color: red"><?php if ($info2) echo 'TN: ' . $info2->displayName ?></span>
                                    <br>
                                    <a href="<?php echo base_url('admin/schedule_week/edit_schedule/' . $row . '/' . $week->id) ?>"><i
                                                class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                                    <a onclick="confirm_del_event(<?php echo $row ?>, <?php echo $schedule_week[$key]->id ?>, 'mon', <?php echo $week->id ?>, <?php echo $value->id ?>)"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                        aria-hidden="true"></i></a>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <!--note link thêm: week_id/id/branch_id/thứ-->
                            <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/mon') ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </td>
                    <!--                    <td>--><?php //echo $value->id ?><!--</td>-->
                    <td id="<?php echo $value->id . '_tue' ?>"
                        class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_tue') echo 'schedule_week_selected'; ?>">
                        <?php if ($itemTueId && $itemTueId[0]) { ?>
                            <!--                            --><?php //var_dump($itemTueId[0]) ?>
                            <?php foreach ($itemTueId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <div id="<?php echo $row; ?>"
                                     class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'schedule_week_selected'; ?>">
                                    <span style="color: red"> <?php echo $itemMon->start ?></span><br>
                                    <span class="white-space"
                                          style="color: green"><?php if ($info) echo $info->displayName . ' - ' . $itemMon->level_room ?></span>
                                    <br>
                                    <span style="color: red"><?php if ($info2) echo 'TN: ' . $info2->displayName ?></span>
                                    <br>
                                    <a href="<?php echo base_url('admin/schedule_week/edit_schedule/' . $row . '/' . $week->id) ?>"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a onclick="confirm_del_event(<?php echo $row ?>, <?php echo $schedule_week[$key]->id ?>, 'tue', <?php echo $week->id ?>, <?php echo $value->id ?>)"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                        aria-hidden="true"></i></a>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <a href="
                            <?php
                            //                                var_dump($schedule_week);
                            echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/tue') ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </td>

                    <td id="<?php echo $value->id . '_wed' ?>"
                        class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_wed') echo 'schedule_week_selected'; ?>">
                        <?php if ($itemWedId && $itemWedId[0]) { ?>
                            <!--                            --><?php //var_dump($itemWedId[0]) ?>
                            <?php foreach ($itemWedId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <div id="<?php echo $row; ?>"
                                     class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'schedule_week_selected'; ?>">
                                    <span style="color: red"> <?php echo $itemMon->start ?></span><br>
                                    <span class="white-space"
                                          style="color: green"><?php if ($info) echo $info->displayName . ' - ' . $itemMon->level_room ?></span>
                                    <br>
                                    <span style="color: red"><?php if ($info2) echo 'TN: ' . $info2->displayName ?></span>
                                    <br>
                                    <a href="<?php echo base_url('admin/schedule_week/edit_schedule/' . $row . '/' . $week->id) ?>"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a onclick="confirm_del_event(<?php echo $row ?>, <?php echo $schedule_week[$key]->id ?>, 'wed', <?php echo $week->id ?>, <?php echo $value->id ?>)"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                        aria-hidden="true"></i></a>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/wed') ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </td>

                    <td id="<?php echo $value->id . '_thu' ?>"
                        class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_thu') echo 'schedule_week_selected'; ?>">
                        <?php if ($itemThuId && $itemThuId[0]) { ?>
                            <!--                            --><?php //var_dump($itemThuId[0]) ?>
                            <?php foreach ($itemThuId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <div id="<?php echo $row; ?>"
                                     class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'schedule_week_selected'; ?>">
                                    <span style="color: red"> <?php echo $itemMon->start ?></span><br>
                                    <span class="white-space"
                                          style="color: green"><?php if ($info) echo $info->displayName . ' - ' . $itemMon->level_room ?></span>
                                    <br>
                                    <span style="color: red"><?php if ($info2) echo 'TN: ' . $info2->displayName ?></span>
                                    <br>
                                    <a href="<?php echo base_url('admin/schedule_week/edit_schedule/' . $row . '/' . $week->id) ?>"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a onclick="confirm_del_event(<?php echo $row ?>, <?php echo $schedule_week[$key]->id ?>, 'thu', <?php echo $week->id ?>, <?php echo $value->id ?>)"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                        aria-hidden="true"></i></a>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/thu') ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </td>

                    <td id="<?php echo $value->id . '_fri' ?>"
                        class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_fri') echo 'schedule_week_selected'; ?>">
                        <?php if ($itemFriId && $itemFriId[0]) { ?>
                            <!--                            --><?php //var_dump($itemFriId[0]) ?>
                            <?php foreach ($itemFriId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <div id="<?php echo $row; ?>"
                                     class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'schedule_week_selected'; ?>">
                                    <span style="color: red"> <?php echo $itemMon->start ?></span><br>
                                    <span class="white-space"
                                          style="color: green"><?php if ($info) echo $info->displayName . ' - ' . $itemMon->level_room ?></span>
                                    <br>
                                    <span style="color: red"><?php if ($info2) echo 'TN: ' . $info2->displayName ?></span>
                                    <br>
                                    <a href="<?php echo base_url('admin/schedule_week/edit_schedule/' . $row . '/' . $week->id) ?>"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a onclick="confirm_del_event(<?php echo $row ?>, <?php echo $schedule_week[$key]->id ?>, 'fri', <?php echo $week->id ?>, <?php echo $value->id ?>)"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                        aria-hidden="true"></i></a>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/fri') ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </td>

                    <td id="<?php echo $value->id . '_sat' ?>"
                        class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_sat') echo 'schedule_week_selected'; ?>">
                        <?php if ($itemSatId && $itemSatId[0]) { ?>
                            <!--                            --><?php //var_dump($itemSatId[0]) ?>
                            <?php foreach ($itemSatId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <div id="<?php echo $row; ?>"
                                     class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'schedule_week_selected'; ?>">
                                    <span style="color: red"> <?php echo $itemMon->start ?></span><br>
                                    <span class="white-space"
                                          style="color: green"><?php if ($info) echo $info->displayName . ' - ' . $itemMon->level_room ?></span>
                                    <br>
                                    <span style="color: red"><?php if ($info2) echo 'TN: ' . $info2->displayName ?></span>
                                    <br>
                                    <a href="<?php echo base_url('admin/schedule_week/edit_schedule/' . $row . '/' . $week->id) ?>"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a onclick="confirm_del_event(<?php echo $row ?>, <?php echo $schedule_week[$key]->id ?>, 'sat', <?php echo $week->id ?>, <?php echo $value->id ?>)"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                        aria-hidden="true"></i></a>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/sat') ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </td>

                    <td id="<?php echo $value->id . '_sun' ?>"
                        class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_sun') echo 'schedule_week_selected'; ?>">
                        <?php if ($itemSunId && $itemSunId[0]) { ?>
                            <!--                            --><?php //var_dump($itemSunId[0]) ?>
                            <?php foreach ($itemSunId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <div id="<?php echo $row; ?>"
                                     class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'schedule_week_selected'; ?>">
                                    <span style="color: red"> <?php echo $itemMon->start ?></span><br>
                                    <span class="white-space"
                                          style="color: green"><?php if ($info) echo $info->displayName . ' - ' . $itemMon->level_room ?></span>
                                    <br>
                                    <span style="color: red"><?php if ($info2) echo 'TN: ' . $info2->displayName ?></span>
                                    <br>
                                    <a href="<?php echo base_url('admin/schedule_week/edit_schedule/' . $row . '/' . $week->id) ?>"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a onclick="confirm_del_event(<?php echo $row ?>, <?php echo $schedule_week[$key]->id ?>, 'sun', <?php echo $week->id ?>, <?php echo $value->id ?>)"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                        aria-hidden="true"></i></a>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/sun') ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </td>
                    <!--<td><a href="<?php echo admin_url('schedule_week/edit/') . $value->id ?>"
                           class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a onclick="confirm_del_event(<?php echo $value->id ?>)"
                           class="btn btn-danger btn-xs">Xóa</a>
                    </td>-->
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<style type="text/css">
    td {
        /*vertical-align: middle !important;*/
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }

    .white-space {
        white-space: nowrap;
    }
</style>
<script type="text/javascript">
    function confirm_del_event(id_teach, id_schedule_week, day, week_id, branch_id) {
        var r = confirm("Bạn có chắc chắn muốn xóa ?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('schedule_week/del/')?>" + id_teach + "/" + id_schedule_week + "/" + day + '/' + week_id + '/' + branch_id;
        }
    }
</script>