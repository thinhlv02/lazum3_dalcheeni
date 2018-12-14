<?php

Class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    function index()
    {
        $this->data['temp'] = 'admin/index';
        $this->load->view('admin/layout', $this->data);
    }

    function logout()
    {
        if ($this->session->userdata('login')) {
            $this->session->unset_userdata('login');
//            mycontroller
            $this->session->unset_userdata('menu_access');

            /*phiếu lương*/
            $this->session->unset_userdata('level_e');
            $this->session->unset_userdata('result');
            $this->session->unset_userdata('name_e');
            /*End phiếu lương*/

            /*Bảng chấm công*/
            $this->session->unset_userdata('name_e2');
            $this->session->unset_userdata('arr_week');
            $this->session->unset_userdata('arr_branch_id');
            /*End Bảng chấm công*/

            /*schedule_week*/
            $this->session->unset_userdata('branch');
            $this->session->unset_userdata('week');
            /*End schedule_week*/

            /*Employee*/
            $this->session->unset_userdata('employee');
            /*End employee*/

            /*contract_detail*/
            $this->session->unset_userdata('employee_of_contract');
            $this->session->unset_userdata('contract_detail');
            /*End contract_detail*/

            /*hlv ,dv excel*/
            $this->session->unset_userdata('hlv');
            /*End hlv ,dv excel*/
        }
        redirect(base_url('admin/login'));
    }

    function info()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post('btnUpdateInfo')) {
            $fullname = $this->input->post('txtName');
            $password = $this->input->post('txtPassword');
            $newPassword = $this->input->post('txtNewPassword');
            $confirmPassword = $this->input->post('txtConfirmPassword');
            if ($fullname == '' || $fullname == null) {
                $this->session->set_flashdata('message', 'Tên không được để trống!');
                redirect(base_url('admin/home/info'));
            } else if (md5($password) != $this->session->userdata('admin')->Password) {
                $this->session->set_flashdata('message', 'Mật khẩu không đúng!');
                redirect(base_url('admin/home/info'));
            } else {
                $admin = $this->data['admin'];
                $dataUpdate = array('UserName' => $fullname);
                if ($newPassword != '' && $newPassword != null) {
                    if ($newPassword != $confirmPassword) {
                        $this->session->set_flashdata('message', 'Xác nhận mật khẩu không khớp!');
                        redirect(base_url('admin/home/info'));
                    } else {
                        $dataUpdate['Password'] = md5($newPassword);
                    }
                }
//pre($dataUpdate);
                if ($this->admin_model->update($admin->id, $dataUpdate)) {
                    $this->session->set_flashdata('message', 'Cập nhật thông tin thành công!');
                    $admin = $this->admin_model->get_info($admin->id);
                    $this->session->set_userdata('admin', $admin);
                    // pre($this->session->userdata('admin'));
                    redirect(base_url('admin/home/info'));
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
                    redirect(base_url('admin/home/info'));
                }

            }
        }

        $this->data['temp'] = 'admin/info';
        $this->load->view('admin/layout', $this->data);
    }
}