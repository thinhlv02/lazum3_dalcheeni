<?php

Class Card extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('card_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $card = $this->card_model->get_list();
        $this->data['res'] = $card;

        $this->data['temp'] = 'admin/card/card';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddcard')) {
            $name = $this->input->post('txtName');
            $displayName = $this->input->post('displayName');
            $info = $this->input->post('info');
            $dataSubmit = array(
                'name' => $name,
                'displayName' => $displayName,
                'info' => $info
            );
//            prev($dataSubmit);
//            die();
            if ($this->card_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm thẻ thành công!');
                redirect(base_url('admin/card'));
            } else {
                $this->session->set_flashdata('message', 'Thêm thẻ thất bại!');
                redirect(base_url('admin/card'));
            }

        }
        $this->data['temp'] = 'admin/card/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $card_id = $this->uri->segment(4);
        $card_id = intval($card_id);
        //pre($card_id);
        $card = $this->card_model->get_info($card_id);
        if ($card == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/card'));
        } else {
            $this->data['card'] = $card;
        }

        if ($this->input->post('btnUpdatecard')) {
            $name = $this->input->post('txtName');
            $displayName = $this->input->post('displayName');
            $info = $this->input->post('info');

            $dataSubmit = array(
                'name' => $name,
                'displayName' => $displayName,
                'info' => $info
            );
            if ($this->card_model->update($card_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin thẻ thành công!');
                redirect(base_url('admin/card'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin thẻ thất bại!');
                redirect(base_url('admin/card'));
            }
        }

        $this->data['temp'] = 'admin/card/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $card_id = $this->uri->segment(4);
        $card_id = intval($card_id);
        $card = $this->card_model->get_info($card_id);

        if ($card == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin thẻ!');
            redirect(base_url('admin/card'));
        } else {
            if ($this->card_model->delete($card_id)) {
                $img = './upload/' . $card->img;
                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa thẻ thành công!');
                redirect(base_url('admin/card'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/card'));
            }
        }
    }
}