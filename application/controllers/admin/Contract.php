<?php

Class Contract extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('contract_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $contract = $this->contract_model->get_list();
        $this->data['res'] = $contract;

        $this->data['temp'] = 'admin/contract/contract';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddcontract')) {
            $name = $this->input->post('txtName');
            $dataSubmit = array(
                'name' => $name
            );
//            prev($dataSubmit);
//            die();
            if ($this->contract_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm các loại hợp đồng mới thành công!');
                redirect(base_url('admin/contract'));
            } else {
                $this->session->set_flashdata('message', 'Thêm các loại hợp đồng mới thất bại!');
                redirect(base_url('admin/contract'));
            }

        }
        $this->data['temp'] = 'admin/contract/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $contract_id = $this->uri->segment(4);
        $contract_id = intval($contract_id);
        //pre($contract_id);
        $contract = $this->contract_model->get_info($contract_id);
        if ($contract == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/contract'));
        } else {
            $this->data['contract'] = $contract;
        }

        if ($this->input->post('btnUpdatecontract')) {
            $name = $this->input->post('txtName');
            $dataSubmit = array(
                'name' => $name
            );
//            pre($dataSubmit);
            if ($this->contract_model->update($contract_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin các loại hợp đồng mới thành công!');
                redirect(base_url('admin/contract'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin các loại hợp đồng mới thất bại!');
                redirect(base_url('admin/contract'));
            }
        }

        $this->data['temp'] = 'admin/contract/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $contract_id = $this->uri->segment(4);
        $contract_id = intval($contract_id);
        $contract = $this->contract_model->get_info($contract_id);

        if ($contract == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin các loại hợp đồng mới!');
            redirect(base_url('admin/contract'));
        } else {
            if ($this->contract_model->delete($contract_id)) {
                $img = './upload/' . $contract->img;
                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa các loại hợp đồng mới thành công!');
                redirect(base_url('admin/contract'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/contract'));
            }
        }
    }
}