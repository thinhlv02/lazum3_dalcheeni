<?php

Class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
//        $this->load->model('event_model');
    }

    function index()
    {
        //$data = array();
//        khi vào trang chủ thì cho điều hướng về thẳng admin/home để vào cms
        redirect('admin/employee');

        $this->data['temp'] = 'site/home/home';
        $this->load->view('site/layout', $this->data);
    }

    function redeem()
    {
        $this->data['temp'] = 'site/guide/redeem';
        $this->load->view('site/layout', $this->data);
    }

    function guide()
    {
        $guide = $this->guide_model->get_list();
        $this->data['guide'] = $guide;
        $this->data['temp'] = 'site/guide/list_guide';
        $this->load->view('site/layout', $this->data);
    }

    function detail_guide($slug = '', $id = '')
    {
        $guide = $this->guide_model->get_info($id);
        if ($guide == null || create_slug($guide->name) != $slug) {
            echo 'Trang bạn yêu cầu không tồn tại. Vui lòng xem lại đường dẫn! <a href="' . base_url('huong-dan') . '">Quay lại trang hướng dẫn</a>';
        } else {
            $this->data['guide'] = $guide;
            $this->data['temp'] = 'site/guide/detail_guide';
            $this->load->view('site/layout', $this->data);
        }
    }

    function notice()
    {
        $notice = $this->notice_model->get_list();
        $this->data['notice'] = $notice;
        $this->data['temp'] = 'site/notice/notice';
        $this->load->view('site/layout', $this->data);
    }

    function detail_notice($slug = '', $id = '')
    {
        $notice = $this->notice_model->get_info($id);
        if ($notice == null || create_slug($notice->name) != $slug) {
            echo 'Trang bạn yêu cầu không tồn tại. Vui lòng xem lại đường dẫn! <a href="' . base_url('thong-bao') . '">Quay lại trang thông báo</a>';
        } else {
            $this->data['notice'] = $notice;
            $this->data['temp'] = 'site/notice/detail_notice';
            $this->load->view('site/layout', $this->data);
        }
    }

    function event()
    {
        $event = $this->event_model->get_list();
        $this->data['event'] = $event;
        $this->data['temp'] = 'site/event/event';
        $this->load->view('site/layout', $this->data);
    }

    function detail_event($slug = '', $id = '')
    {
        $event = $this->event_model->get_info($id);
        if ($event == null || create_slug($event->name) != $slug) {
            echo 'Trang bạn yêu cầu không tồn tại. Vui lòng xem lại đường dẫn! <a href="' . base_url('su-kien') . '">Quay lại trang sự kiện</a>';
        } else {
            $this->data['event'] = $event;
            $this->data['temp'] = 'site/event/detail_event';
            $this->load->view('site/layout', $this->data);
        }
    }

    function download()
    {
        $this->data['temp'] = 'site/download/download';
        $this->load->view('site/layout', $this->data);
    }

    function promotion()
    {
        $this->load->model('promotion_model');
//        $event = $this->event_model->get_list();
//        $this->data['event'] = $event;
//        $this->data['temp'] = 'site/event/event';
//        $this->load->view('site/layout', $this->data);

        $promotion = $this->promotion_model->get_list();
        $this->data['promotion'] = $promotion;
        $this->data['temp'] = 'site/promotion/promotion';
        $this->load->view('site/layout', $this->data);
    }

    function detail_promotion($slug = '', $id = '')
    {
        $this->load->model('promotion_model');
        $promotion = $this->promotion_model->get_info($id);
        if ($promotion == null || create_slug($promotion->name) != $slug) {
            echo 'Trang bạn yêu cầu không tồn tại xx. Vui lòng xem lại đường dẫn! <a href="' . base_url('promotion') . '">Quay lại trang sự kiện</a>';
        } else {
            $this->data['promotion'] = $promotion;
            $this->data['temp'] = 'site/promotion/detail_promotion';
            $this->load->view('site/layout', $this->data);
        }
    }
}