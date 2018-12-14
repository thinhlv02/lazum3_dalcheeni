<?php

Class Level extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('level_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['id !='] = 0;
//        pre($input);

        $level = $this->level_model->get_list();
        $this->data['res'] = $level;

        $this->data['temp'] = 'admin/level/level';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddlevel')) {
            $name = $this->input->post('txtName');
            $luong = $this->input->post('luong');
            $dataSubmit = array(
                'level_name' => $name,
                'luong' => $luong
            );
//            pre($dataSubmit);
//            die();
            if ($this->level_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm level thành công!');
                redirect(base_url('admin/level'));
            } else {
                $this->session->set_flashdata('message', 'Thêm level thất bại!');
                redirect(base_url('admin/level'));
            }

        }
        $this->data['temp'] = 'admin/level/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $level_id = $this->uri->segment(4);
//        $level_id = intval($level_id);
        $level_id = $level_id;
//        pre($level_id);
        $level = $this->level_model->get_info($level_id);
        if ($level == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin level!');
            redirect(base_url('admin/level'));
        } else {
            $this->data['level'] = $level;
        }

        if ($this->input->post('btnUpdatelevel')) {
            $name = $this->input->post('txtName');
            $luong = $this->input->post('luong');

            $dataSubmit = array(
                'level_name' => $name,
                'luong' => $luong
            );
//            pre($dataSubmit);
            if ($this->level_model->update($level_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin level thành công!');
                redirect(base_url('admin/level'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin level thất bại!');
                redirect(base_url('admin/level'));
            }
        }

        $this->data['temp'] = 'admin/level/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $level_id = $this->uri->segment(4);
        $level_id = intval($level_id);
        $level = $this->level_model->get_info($level_id);

        if ($level == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin level!');
            redirect(base_url('admin/level'));
        } else {
            if ($this->level_model->delete($level_id)) {
                $img = './upload/' . $level->img;
                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa level thành công!');
                redirect(base_url('admin/level'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/level'));
            }
        }
    }
}