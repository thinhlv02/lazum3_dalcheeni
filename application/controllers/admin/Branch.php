<?php

Class Branch extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('branch_model');
        $this->load->model('week_model');
        $this->load->model('schedule_week_model');
    }

    function index()
    {
//        $input = array();
//        $input['where']['id >'] = 22;
//        $add = $this->branch_model->get_list($input);
//        foreach ($add as $key => $value2) {
//            $dataSubmit = array(
//                'branch_id' => $value2->id,
//                'week_id' => 3
//            );
//            $this->schedule_week_model->create($dataSubmit);
//        }


        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $branch = $this->branch_model->get_list();
        $this->data['res'] = $branch;

        $this->data['temp'] = 'admin/branch/branch';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddbranch')) {
            $name = $this->input->post('address');
            $dataSubmit = array(
                'name' => $name
            );
//            prev($dataSubmit);
//            die();
            $id_branch = $this->branch_model->create($dataSubmit);
            if ($id_branch > 0) {
//                insert thêm branch_id vào schedule_week
                $week = $this->week_model->get_list();
                foreach ($week as $value) {
                    $dataSubmit = array(
                        'branch_id' => $id_branch,
                        'week_id' => $value->id
                    );
                    $this->schedule_week_model->create($dataSubmit);
                }
//                pre($id_branch);
//                insert thêm branch_id vào schedule_week
                $this->session->set_flashdata('message', 'Thêm địa điểm thành công!');
                redirect(base_url('admin/branch'));
            } else {
                $this->session->set_flashdata('message', 'Thêm địa điểm thất bại!');
                redirect(base_url('admin/branch'));
            }

        }
        $this->data['temp'] = 'admin/branch/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $branch_id = $this->uri->segment(4);
        $branch_id = intval($branch_id);
        //pre($branch_id);
        $branch = $this->branch_model->get_info($branch_id);
        if ($branch == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/branch'));
        } else {
            $this->data['branch'] = $branch;
        }

        if ($this->input->post('btnUpdatebranch')) {
            $name = $this->input->post('txtName');

            $dataSubmit = array(
                'name' => $name
            );
            if ($this->branch_model->update($branch_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin địa điểm thành công!');
                redirect(base_url('admin/branch'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin địa điểm thất bại!');
                redirect(base_url('admin/branch'));
            }
        }

        $this->data['temp'] = 'admin/branch/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $branch_id = $this->uri->segment(4);
        $branch_id = intval($branch_id);
        $branch = $this->branch_model->get_info($branch_id);

        if ($branch == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin địa điểm!');
            redirect(base_url('admin/branch'));
        } else {
            if ($this->branch_model->delete($branch_id)) {
                $img = './upload/' . $branch->img;
                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa địa điểm thành công!');
                redirect(base_url('admin/branch'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/branch'));
            }
        }
    }
}