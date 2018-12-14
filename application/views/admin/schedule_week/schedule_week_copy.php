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
    <div class="x_title">
        <h2>Danh sách</h2>
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
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
<!--                <th>ID_Branch</th>-->
                <th>Stt</th>
                <th>Địa điểm</th>
                <th>Thứ 2
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
                    <!--                    <td>-->
                    <!--                        --><?php //if ($itemMonId) { ?>
                    <!--                            --><?php //foreach ($itemMonId as $row) {
                    //                                $itemMon = $this->teach_model->get_info($row);
                    //                                $info = $this->employee_model->get_info($itemMon->employee_id);
                    //                                ?>
                    <!--                                --><?php //echo $info->name ?>
                    <!--                            --><?php //} ?>
                    <!--                        --><?php //} ?>
                    <!--                        <div class="btn_them_thinhlv">-->
                    <!--                            <a href="-->
                    <?php //echo base_url('admin/schedule_week/add_schedule/' . $schedule_week->id . '/' . $value->id . '/2') ?><!--"><i class="fa fa-plus" aria-hidden="true"></i></a>-->
                    <!--                        </div>-->
                    <!--                    </td>-->
                    <td>
                        <?php if ($itemMonId && $itemMonId[0]) { ?>
<!--                            --><?php //var_dump($itemMonId[0]) ?>
                            <?php foreach ($itemMonId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <span style="color: red"> <?php echo 'Giờ bắt đầu : ' . $itemMon->start ?></span><br>
                                <span style="color: green"><?php echo 'HLV: ' . $info->name ?></span> <br>
                                <span style="color: red"><?php echo 'TN: ' . $info2->name ?></span>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <?php if ($itemMonId && $itemMonId[0]) { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/edit_schedule/' . $row . '/' . $week->id) ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } else { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/2') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php } ?>

                        </div>
                    </td>
                    <!--                    <td>--><?php //echo $value->id ?><!--</td>-->
                    <td>
                        <?php if ($itemTueId && $itemTueId[0]) { ?>
<!--                            --><?php //var_dump($itemTueId[0]) ?>
                            <?php foreach ($itemTueId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <span style="color: red"> <?php echo 'Giờ bắt đầu : ' . $itemMon->start ?></span><br>
                                <span style="color: green"><?php echo 'HLV: ' . $info->name ?></span> <br>
                                <span style="color: red"><?php echo 'TN: ' . $info2->name ?></span>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <?php if ($itemTueId && $itemTueId[0]) { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/edit_schedule/' . $row. '/' . $week->id) ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } else { ?>
                                <a href="
                            <?php
                                //                                var_dump($schedule_week);
                                echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/3') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php } ?>

                        </div>
                    </td>
                    <td>
                        <?php if ($itemWedId && $itemWedId[0]) { ?>
<!--                            --><?php //var_dump($itemWedId[0]) ?>
                            <?php foreach ($itemWedId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <span style="color: red"> <?php echo 'Giờ bắt đầu : ' . $itemMon->start ?></span><br>
                                <span style="color: green"><?php echo 'HLV: ' . $info->name ?></span> <br>
                                <span style="color: red"><?php echo 'TN: ' . $info2->name ?></span>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <?php if ($itemWedId && $itemWedId[0]) { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/edit_schedule/' . $row. '/' . $week->id) ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } else { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/4') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php } ?>

                        </div>
                    </td>

                    <td>
                        <?php if ($itemThuId && $itemThuId[0]) { ?>
<!--                            --><?php //var_dump($itemThuId[0]) ?>
                            <?php foreach ($itemThuId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <span style="color: red"> <?php echo 'Giờ bắt đầu : ' . $itemMon->start ?></span><br>
                                <span style="color: green"><?php echo 'HLV: ' . $info->name ?></span> <br>
                                <span style="color: red"><?php echo 'TN: ' . $info2->name ?></span>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <?php if ($itemThuId && $itemThuId[0]) { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/edit_schedule/' . $row. '/' . $week->id) ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } else { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/5') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php } ?>

                        </div>
                    </td>

                    <td>
                        <?php if ($itemFriId && $itemFriId[0]) { ?>
<!--                            --><?php //var_dump($itemFriId[0]) ?>
                            <?php foreach ($itemFriId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <span style="color: red"> <?php echo 'Giờ bắt đầu : ' . $itemMon->start ?></span><br>
                                <span style="color: green"><?php echo 'HLV: ' . $info->name ?></span> <br>
                                <span style="color: red"><?php echo 'TN: ' . $info2->name ?></span>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <?php if ($itemFriId && $itemFriId[0]) { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/edit_schedule/' . $row. '/' . $week->id) ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } else { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/6') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php } ?>

                        </div>
                    </td>

                    <td>
                        <?php if ($itemSatId && $itemSatId[0]) { ?>
<!--                            --><?php //var_dump($itemSatId[0]) ?>
                            <?php foreach ($itemSatId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <span style="color: red"> <?php echo 'Giờ bắt đầu : ' . $itemMon->start ?></span><br>
                                <span style="color: green"><?php echo 'HLV: ' . $info->name ?></span> <br>
                                <span style="color: red"><?php echo 'TN: ' . $info2->name ?></span>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <?php if ($itemSatId && $itemSatId[0]) { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/edit_schedule/' . $row. '/' . $week->id) ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } else { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/7') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php } ?>

                        </div>
                    </td>

                    <td>
                        <?php if ($itemSunId && $itemSunId[0]) { ?>
<!--                            --><?php //var_dump($itemSunId[0]) ?>
                            <?php foreach ($itemSunId as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                $itemMon = $this->teach_model->get_info($row);
                                $info = $this->employee_model->get_info($itemMon->employee_id);
                                $info2 = $this->employee_model->get_info($itemMon->thungan);
                                ?>
                                <span style="color: red"> <?php echo 'Giờ bắt đầu : ' . $itemMon->start ?></span><br>
                                <span style="color: green"><?php echo 'HLV: ' . $info->name ?></span> <br>
                                <span style="color: red"><?php echo 'TN: ' . $info2->name ?></span>
                            <?php } ?>
                        <?php } ?>
                        <div class="btn_them_thinhlv">
                            <?php if ($itemSunId && $itemSunId[0]) { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/edit_schedule/' . $row. '/' . $week->id) ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php } else { ?>
                                <a href="
                            <?php echo base_url('admin/schedule_week/add_schedule/' . $week->id . '/' . $schedule_week[$key]->id . '/' . $value->id . '/8') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php } ?>

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
        vertical-align: middle !important;
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
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa  lịch tuần cho các phòng học này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('schedule_week/del/')?>" + id;
        }
    }
</script>