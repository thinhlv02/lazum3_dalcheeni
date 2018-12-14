<?php

Class Day extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('day_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $day = $this->day_model->get_list();
        $this->data['res'] = $day;

        $this->data['temp'] = 'admin/day/day';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $day = $this->input->post('day');
            $dataSubmit = array(
                'day' => $day
            );
//            prev($dataSubmit);
//            die();
            $id_day = $this->day_model->create($dataSubmit);
            if ($id_day > 0) {
                $this->session->set_flashdata('message', 'Thêm giờ bắt đầu học thành công!');
                redirect(base_url('admin/day'));
            } else {
                $this->session->set_flashdata('message', 'Thêm giờ bắt đầu học thất bại!');
                redirect(base_url('admin/day'));
            }

        }
        $this->data['temp'] = 'admin/day/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $day_id = $this->uri->segment(4);
        $day_id = intval($day_id);
        //pre($day_id);
        $day = $this->day_model->get_info($day_id);
        if ($day == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/day'));
        } else {
            $this->data['day'] = $day;
        }

        if ($this->input->post('btnUpdateday')) {
            $day = $this->input->post('day');

            $dataSubmit = array(
                'day' => $day
            );
            if ($this->day_model->update($day_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin giờ bắt đầu học thành công!');
                redirect(base_url('admin/day'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin giờ bắt đầu học thất bại!');
                redirect(base_url('admin/day'));
            }
        }

        $this->data['temp'] = 'admin/day/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $day_id = $this->uri->segment(4);
        $day_id = intval($day_id);
        $day = $this->day_model->get_info($day_id);

        if ($day == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin giờ bắt đầu học!');
            redirect(base_url('admin/day'));
        } else {
            if ($this->day_model->delete($day_id)) {
                $this->session->set_flashdata('message', 'Xóa thành công!');
                redirect(base_url('admin/day'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác hỏng!');
                redirect(base_url('admin/day'));
            }
        }
    }
}