<?php

Class Student extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('student_model');
//        get list branch
        $this->load->model('card_model');
        $this->load->model('start_model');
        $this->load->model('day_model');
        $student_card = $this->card_model->get_list();
        $this->data['student_card'] = $student_card;

        $this->load->model('branch_model');
        $room_branch = $this->branch_model->get_list();
        $this->data['room_branch'] = $room_branch;

        $start = $this->start_model->get_list();
        $this->data['start'] = $start;

        $day = $this->day_model->get_list();
        $this->data['day'] = $day;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

//        $student = $this->student_model->get_list();
        $student = $this->student_model->demo();
        $this->data['student'] = $student;
//        pre($student);

        $this->data['temp'] = 'admin/student/student';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddstudent')) {
            $name = $this->input->post('txtName');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $address = $this->input->post('address');

            $from = $this->input->post('txtFrom');
            $from = new DateTime($from);
            $from = $from->getTimestamp();

            $to = $this->input->post('txtTo');
            $to = new DateTime($to);
            $to = $to->getTimestamp();
//            pre($to);

            $card = $this->input->post('card');
            $start = $this->input->post('start');
            $branch_id = $this->input->post('branch_id');
            $day = $this->input->post('day');
            $ban = $this->input->post('ban');
            $dataSubmit = array(
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'card_start' => $from,
                'card_end' => $to,
                'card_id' => $card,
                'start' => $start,
                'branch_id' => $branch_id,
                'day' => $day,
                'ban' => $ban
            );
//            pre($dataSubmit);
//            die();
            if ($this->student_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm học viên thành công!');
                redirect(base_url('admin/student'));
            } else {
                $this->session->set_flashdata('message', 'Thêm học viên thất bại!');
                redirect(base_url('admin/student'));
            }

        }
        $this->data['temp'] = 'admin/student/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $student_id = $this->uri->segment(4);
        $student_id = intval($student_id);
        //pre($student_id);
        $student = $this->student_model->get_info($student_id);
        if ($student == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/student'));
        } else {
            $this->data['student'] = $student;
        }

        if ($this->input->post('btnUpdatestudent')) {
            $name = $this->input->post('txtName');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            $from = $this->input->post('txtFrom');
            $from = new DateTime($from);
            $from = $from->getTimestamp();
            $to = $this->input->post('txtTo');
            $to = new DateTime($to);
            $to = $to->getTimestamp();
            $card = $this->input->post('card');
            $start = $this->input->post('start');
            $branch_id = $this->input->post('branch_id');
            $day = $this->input->post('day');
            $ban = $this->input->post('ban');
            $dataSubmit = array(
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'card_start' => $from,
                'card_end' => $to,
                'card_id' => $card,
                'start' => $start,
                'branch_id' => $branch_id,
                'day' => $day,
                'ban' => $ban
            );
            if ($this->student_model->update($student_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin học viên thành công!');
                redirect(base_url('admin/student'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin học viên thất bại!');
                redirect(base_url('admin/student'));
            }
        }

        $this->data['temp'] = 'admin/student/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $student_id = $this->uri->segment(4);
        $student_id = intval($student_id);
        $student = $this->student_model->get_info($student_id);

        if ($student == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin học viên!');
            redirect(base_url('admin/student'));
        } else {
            if ($this->student_model->delete($student_id)) {
                $img = './upload/' . $student->img;
                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa học viên thành công!');
                redirect(base_url('admin/student'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/student'));
            }
        }
    }
}