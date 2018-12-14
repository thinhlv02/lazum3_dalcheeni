<?php

Class Room extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('room_model');
//        get list branch
        $this->load->model('branch_model');
        $room_branch = $this->branch_model->get_list();
        $this->data['room_branch'] = $room_branch;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

//        $room = $this->room_model->get_list();
        $room = $this->room_model->demo();
        $this->data['res'] = $room;

        $this->data['temp'] = 'admin/room/room';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddroom')) {
            $name = $this->input->post('txtName');
            $branch = $this->input->post('branch');
            $dataSubmit = array(
                'name' => $name,
                'branch_id' => $branch
            );
//            prev($dataSubmit);
//            die();
            if ($this->room_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm lớp học thành công!');
                redirect(base_url('admin/room'));
            } else {
                $this->session->set_flashdata('message', 'Thêm lớp học thất bại!');
                redirect(base_url('admin/room'));
            }

        }
        $this->data['temp'] = 'admin/room/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $room_id = $this->uri->segment(4);
        $room_id = intval($room_id);
        //pre($room_id);
        $room = $this->room_model->get_info($room_id);
        if ($room == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/room'));
        } else {
            $this->data['room'] = $room;
        }

        if ($this->input->post('btnUpdateroom')) {
            $name = $this->input->post('txtName');
            $branch = $this->input->post('branch');

            $dataSubmit = array(
                'name' => $name,
                'branch_id' => $branch
            );
            if ($this->room_model->update($room_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin lớp học thành công!');
                redirect(base_url('admin/room'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin lớp học thất bại!');
                redirect(base_url('admin/room'));
            }
        }

        $this->data['temp'] = 'admin/room/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $room_id = $this->uri->segment(4);
        $room_id = intval($room_id);
        $room = $this->room_model->get_info($room_id);

        if ($room == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin lớp học!');
            redirect(base_url('admin/room'));
        } else {
            if ($this->room_model->delete($room_id)) {
                $img = './upload/' . $room->img;
                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa lớp học thành công!');
                redirect(base_url('admin/room'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/room'));
            }
        }
    }
}