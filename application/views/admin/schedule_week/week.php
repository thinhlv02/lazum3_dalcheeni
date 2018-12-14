<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Danh sách tuần đã tạo trong năm</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <?php if ($menu_access[7] == 2) { ?>
                <a href="<?php echo admin_url('schedule_week/add') ?>" class="btn btn-primary btn-sm">Thêm mới tuần</a>
                <a href="<?php echo admin_url('schedule_week/copy_detail_week') ?>" class="btn btn-primary btn-sm">Copy lịch tuần chi
                    tiết</a>
            <?php } ?>
            <!--            <a href="-->
            <?php //echo admin_url('schedule_week') ?><!--" class="btn btn-info btn-sm">Danh sách tuần</a>-->
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
                <th>Tuần</th>
                <th>Năm</th>
                <th>Thứ 2</th>
                <th>Thứ 3</th>
                <th>Thứ 4</th>
                <th>Thứ 5</th>
                <th>Thứ 6</th>
                <th>Thứ 7</th>
                <th>Chủ nhật</th>
                <th>Hành động</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($res as $key => $value): ?>
                <tr>
                    <td><?php echo $value->week_number ?></td>
                    <td><?php echo $value->year_number ?></td>
                    <td><?php echo date('d-m-Y', $value->mon) ?></td>
                    <td><?php echo date('d-m-Y', $value->tue) ?></td>
                    <td><?php echo date('d-m-Y', $value->wed) ?></td>
                    <td><?php echo date('d-m-Y', $value->thu) ?></td>
                    <td><?php echo date('d-m-Y', $value->fri) ?></td>
                    <td><?php echo date('d-m-Y', $value->sat) ?></td>
                    <td><?php echo date('d-m-Y', $value->sun) ?></td>
                    <td>
                        <a href="<?php echo admin_url('schedule_week/detail_week/') . $value->id ?>"
                           class="btn btn-info btn-xs">Chi tiết</a>
                    </td>

                    <!--<td><a href="<?php echo admin_url('schedule_week/edit/') . $value->id ?>"
                           class="btn btn-info btn-xs">Sửa</a>
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
</style>
<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa  lịch tuần cho các phòng học này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('schedule_week/del/')?>" + id;
        }
    }
</script>
