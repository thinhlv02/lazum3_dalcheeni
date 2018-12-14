<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Danh sách nhân sự</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <?php if ($menu_access[1] == 2) { ?>
                <a href="<?php echo admin_url('employee/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <?php } ?>
            <a href="<?php echo admin_url('employee') ?>" class="btn btn-info btn-sm">Danh sách</a>
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
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Sinh ngày</th>
                <th>CMTND số</th>
                <th>CMTND Ngày cấp</th>
                <th>CMTND cấp tại</th>
                <th>SĐT</th>
                <th>Chức vụ</th>
                <th>Phòng ban</th>
                <th>Đ/c</th>
                <th>Hành động</th>
                <th>Phân quyền</th>
            </tr>
            </thead>

            <tbody>
            <?php $i = 0 ?>
            <?php foreach ($res as $key => $value): ?>
                <?php
                $i++;
                $department = $this->department_model->get_info($value->department_id);
//                pre($department);
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $value->name ?></td>
                    <td><?php echo date('d/m/Y', $value->birthday) ?></td>
                    <?php $identity = explode('|', $value->identity_card) ?>
                    <td><?php echo $identity[0] ?></td>
                    <td><?php echo date('d-m-y', $identity[1]) ?></td>
                    <td><?php echo $identity[2] ?></td>
                    <td><?php echo $value->phone ?></td>
                    <td><?php echo $value->position ?></td>
                    <td><?php echo $department->name ?></td>
                    <td><?php echo $value->address ?></td>

                    <?php if ($menu_access[1] == 2) { ?>
                        <td><a href="<?php echo admin_url('employee/edit/') . $value->id ?>"
                               class="btn btn-info btn-xs">Sửa</a>
                            <a onclick="confirm_del_event(<?php echo $value->id ?>)"
                               class="btn btn-danger btn-xs">Xóa</a>
                        </td>
                        <td><a href="<?php echo admin_url('employee/access/') . $value->id ?>"
                               class="btn btn-info btn-xs">Phân quyền</a>
                        </td>
                    <?php } else { ?>
                        <td></td>
                        <td></td>
                    <?php } ?>
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
        var r = confirm("Bạn có chắc chắn muốn xóa nhân sự này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('employee/del/')?>" + id;
        }
    }
</script>