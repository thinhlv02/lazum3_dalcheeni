<?php

Class Content extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('content_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post('btnUpdateLink')) {
            $linkAndroid = $this->input->post('txtAndroid');
            $linkiOS = $this->input->post('txtIOS');
            $hotline = $this->input->post('txtHotline');
            $email = $this->input->post('txtEmail');
            $footer = $this->input->post('txtFooter');
            $dataUpdate = array(
                'linkAndroid' => $linkAndroid,
                'linkiOS' => $linkiOS,
                'hotline' => $hotline,
                'email' => $email,
                'footer' => $footer
            );
            if ($this->content_model->update(1, $dataUpdate)) {
                $this->session->set_flashdata('message', 'Cập nhật nội dung thành công!');
                redirect(base_url('admin/content'));
            } else {
                $this->session->set_flashdata('message', 'Cập nhật nội dung thất bại!');
                redirect(base_url('admin/content'));
            }
        }

        $content = $this->content_model->get_info(1);
        $this->data['content'] = $content;

        $this->data['temp'] = 'admin/content/content';
        $this->load->view('admin/layout', $this->data);
    }

    function slide()
    {
        $content = $this->content_model->get_info(1);
        $this->data['content'] = $content;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $list_slide = $content->slide;
        $list_slide = explode('/', $list_slide);
        $this->data['list_slide'] = $list_slide;

        if ($this->input->post('btnAddSlide')) {
            $config['upload_path'] = './public/images/slide';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '900';
            $config['max_width'] = '2000';
            $config['max_height'] = '1500';

            $this->load->library("upload", $config);
            if ($this->upload->do_upload('slideUpload')) {
                $img_name = $this->upload->data()['file_name'];
                $list_slide[] = $img_name;
                $slide = implode('/', $list_slide);

                $dataSubmit = array('slide' => $slide);
                if ($this->content_model->update(1, $dataSubmit)) {
                    $this->session->set_flashdata('message', 'Thêm slide thành công!');
                    redirect(base_url('admin/content/slide'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm slide thất bại!');
                    redirect(base_url('admin/content/slide'));
                }
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect(base_url('admin/content/slide'));
            }
        }

        $this->data['temp'] = 'admin/content/slide';
        $this->load->view('admin/layout', $this->data);
    }

    function delSlide()
    {
        $content = $this->content_model->get_info(1);
        $pos = $this->uri->segment(4);
        $list_slide = $content->slide;
        $list_slide = explode('/', $list_slide);
        if ($pos >= sizeof($list_slide)) {
            $this->session->set_flashdata('message', 'Không tồn tại slide này!');
            redirect(base_url('admin/content/slide'));
        } else {
            $old_img = './public/images/slide' . $list_slide[$pos];
            unset($list_slide[$pos]);
            $slide = implode('/', $list_slide);
            $dataSubmit = array('slide' => $slide);
            if ($this->content_model->update(1, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Xóa slide thành công!');
                unlink($old_img);
                redirect(base_url('admin/content/slide'));
            } else {
                $this->session->set_flashdata('message', 'Xóa slide thất bại!');
                redirect(base_url('admin/content/slide'));
            }
        }
    }

}