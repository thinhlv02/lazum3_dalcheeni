<?php

Class Department extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('department_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $department = $this->department_model->get_list();
        $this->data['res'] = $department;

        $this->data['temp'] = 'admin/department/department';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdddepartment')) {
            $name = $this->input->post('txtName');
            $des = $this->input->post('description');
            $dataSubmit = array(
                'name' => $name,
                'description' => $des
            );
//            prev($dataSubmit);
//            die();
            if ($this->department_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm phòng ban thành công!');
                redirect(base_url('admin/department'));
            } else {
                $this->session->set_flashdata('message', 'Thêm phòng ban thất bại!');
                redirect(base_url('admin/department'));
            }

        }
        $this->data['temp'] = 'admin/department/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $department_id = $this->uri->segment(4);
        $department_id = intval($department_id);
        //pre($department_id);
        $department = $this->department_model->get_info($department_id);
        if ($department == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/department'));
        } else {
            $this->data['department'] = $department;
        }

        if ($this->input->post('btnUpdatedepartment')) {
            $name = $this->input->post('txtName');
            $des = $this->input->post('description');

            $dataSubmit = array(
                'name' => $name,
                'description' => $des
            );
//            pre($dataSubmit);
            if ($this->department_model->update($department_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin phòng ban thành công!');
                redirect(base_url('admin/department'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin phòng ban thất bại!');
                redirect(base_url('admin/department'));
            }
        }

        $this->data['temp'] = 'admin/department/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $department_id = $this->uri->segment(4);
        $department_id = intval($department_id);
        $department = $this->department_model->get_info($department_id);

        if ($department == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin phòng ban!');
            redirect(base_url('admin/department'));
        } else {
            if ($this->department_model->delete($department_id)) {
                $img = './upload/' . $department->img;
                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa phòng ban thành công!');
                redirect(base_url('admin/department'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/department'));
            }
        }
    }
}