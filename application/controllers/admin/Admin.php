<?php

Class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('employee_model');
        $this->load->model('menu_model');
        $this->load->model('menu_access_model');

        $employee = $this->employee_model->get_list();
        $this->data['emp'] = $employee;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

//        $admin = $this->admin_model->get_list();
        $admin = $this->admin_model->function_getlist();
        $this->data['res'] = $admin;

        $this->data['temp'] = 'admin/admin/admin';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddadmin')) {
            $employee_id = $this->input->post('employee_id');
            $txtName = $this->input->post('txtName');

            $dataSubmit = array(
                'UserName' => $txtName,
                'Password' => 'e10adc3949ba59abbe56e057f20f883e',
                'employee_id' => $employee_id
            );
//            prev($dataSubmit);
//            die();
            /* Check tài khoản đã tạo chưa */
            $input = array();
            $input['where'] = array(
                'employee_id' => $employee_id
            );
            if (!$this->admin_model->get_list($input)) {
                $insert_id = $this->admin_model->create($dataSubmit);
                if ($insert_id >= 0) {
                    /* thêm quyền vào bảng menu_access*/
                    $menu = $this->menu_model->get_list();
//                pre($menu);

                    foreach ($menu as $key => $value) {
                        $dataSubmit1 = array(
                            'employee_id' => $employee_id,
                            'menu_id' => $value->id,
                            'access' => 0
                        );
                        $this->menu_access_model->create($dataSubmit1);
                    }
                    /* End thêm quyền vào bảng menu_access*/

                    $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thành công!');
                    redirect(base_url('admin/admin'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thất bại!');
                    redirect(base_url('admin/admin'));
                }
            } else {
                $this->session->set_flashdata('message', 'Tài khoản này đã tồn tại, vui lòng kiểm tra lại!');
                redirect(base_url('admin/admin/add'));
            }
            /* Check tài khoản đã tạo chưa */
        }
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $user_id = $this->uri->segment(4);
        $user_id = intval($user_id);
        //pre($admin_id);
        $user = $this->admin_model->get_info($user_id);
        if ($user == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài khoản!');
            redirect(base_url('admin/admin'));
        } else {
            $this->data['user'] = $user;
        }

        if ($this->input->post('btnUpdateadmin')) {
            $name = $this->input->post('txtName');

            $dataSubmit = array(
                'UserName' => $name
            );
            if ($this->admin_model->update($user_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thành công!');
                redirect(base_url('admin/admin'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(base_url('admin/admin'));
            }
        }

        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function access()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

//        $menu_access = $this->menu_access_model->get_list();
//        $this->data['menu_access'] = $menu_access;

        $menu_access_id = $this->uri->segment(4);
        $menu_access_id = intval($menu_access_id);
//        pre($menu_access_id);
        $input = array();
        $input['where'] = array(
            'employee_id' => $menu_access_id
        );
        //(ví dụ $input['order'] = array('id','DESC'))

        $input['order'] = array('menu_id', 'ASC');
        $menu_access = $this->menu_access_model->get_list($input);
//        pre($menu_access);
        if ($menu_access == null) {
            $this->session->set_flashdata('message', 'Không tồn tại quyền nv!');
            redirect(base_url('admin/access'));
        } else {
            $this->data['menu_access'] = $menu_access;
        }
        if ($this->input->post('btnUpdateemployee')) {
//            $access1 = $access2 = array();
//            var_dump($access1);
            $access1 = $this->input->post('access1');
            $access2 = $this->input->post('access2');
//            pre($access1);
//            pre($access1);
//            pre($access2);
            $i = 0;
            foreach ($menu_access as $row) {
                if ($access2 && in_array($row->id, $access2)) {
                    $this->menu_access_model->update($row->id, array('access' => 2));
                    $i++;
                } else if ($access1 && in_array($row->id, $access1)) {
                    $this->menu_access_model->update($row->id, array('access' => 1));
                    $i++;
                } else {
                    $this->menu_access_model->update($row->id, array('access' => 0));
                    $i++;
                }
            }
            if (count($i) > 0) {
                $this->session->set_flashdata('message', 'Cập nhật xong!');
                redirect(base_url('admin/admin/access/' . $menu_access_id));
            }
//            if (is_array($access1)) {
//                foreach ($access1 as $value) {
////                    if(in_array($value, $access2)){
////                        $this->employee_model->update($employee_id, array('access'=>2));
////                    }
////                    else{
////                        $this->employee_model->update($employee_id, array('access'=>1));
////                    }
//                }
//            }

//            if ($this->employee_model->update($employee_id, $dataSubmit)) {
//                $this->session->set_flashdata('message', 'Sửa quyền nhân sự thành công!');
//                redirect(base_url('admin/access' / $employee_id));
//            } else {
//                $this->session->set_flashdata('message', 'Sửa quyền nhân sự thất bại!');
//                redirect(base_url('admin/access' / $employee_id));
//            }
        }
        $this->data['menu_access_id'] = $menu_access_id;
        $this->data['temp'] = 'admin/admin/access';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $admin_id = $this->uri->segment(4);
        $admin_id = intval($admin_id);
        $admin = $this->admin_model->get_info($admin_id);

        if ($admin == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài khoản login hệ thống!');
            redirect(base_url('admin/admin'));
        } else {
            if ($this->admin_model->delete($admin_id)) {
                /* nếu xóa tài khoản thì xóa luôn quyền trong menu-access*/
                $input = array();
                $input['where'] = array(
                    'employee_id' => $admin->employee_id
                );
                $menu_access = $this->menu_access_model->get_list($input);
                foreach ($menu_access as $value) {
                    $this->menu_access_model->delete($value->id);
                }
                /* End nếu xóa tài khoản thì xóa luôn quyền trong menu-access*/
//                $img = './upload/' . $admin->img;
//                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa tài khoản login hệ thống thành công!');
                redirect(base_url('admin/admin'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/admin'));
            }
        }
    }
}