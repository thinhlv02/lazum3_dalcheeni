<?php

Class MY_Controller extends CI_Controller
{
    public $data = array();

    function __construct()
    {
        parent::__construct();
        $new_url = $this->uri->segment(1);
        //pre ($new_url);
        switch ($new_url) {
            case 'admin' : {
                $this->load->model('menu_access_model');
                $this->_check_login();
                $this->data['admin'] = $this->session->userdata('admin');
                if ($this->session->userdata('admin')) {
                    /*lưu session menu_access*/
                    $input = array();
                    $input['where'] = array(
                        'employee_id' => $this->session->userdata('admin')->employee_id
                    );
                    $menu_access = $this->menu_access_model->get_list($input);
                    $access = array();
                    foreach ($menu_access as $value) {
                        $access[$value->menu_id] = $value->access;
                    }

//                $this->data['menu_access'] = $this->session->userdata('admin');

                    $this->session->set_userdata('menu_access', $access);
//                $access = $this->session->userdata('menu_access');
//                pre($access[1]);

                    /*lưu session menu_access*/
                }
                break;
            }

            default: {
//                $this->load->model('content_model');
//                $content = $this->content_model->get_info(1);
//                $this->data['content'] = $content;

//                $this->load->model('event_model');
//                $list_event = $this->event_model->get_list();
//                $now = new DateTime();
//                $now = $now->getTimestamp();
//                $count_event = 0;
//                foreach ($list_event as $value) {
//                    if ($now >= $value->time_from && $now <= $value->time_to) {
//                        $count_event++;
//                    }
//                }
//                $this->data['count_event'] = $count_event;

//                $this->load->model('notice_model');
//                $input_notice = array();
//                $input_notice['limit'] = array('4', '0');
//                $notice_right = $this->notice_model->get_list($input_notice);
//                $this->data['notice_right'] = $notice_right;
//                $this->load->model('chart_money_model');
//                $input_tbl_chart_money = array();
//                $input_tbl_chart_money['limit'] = array('4', '0');
//                $input_tbl_chart_money = $this->chart_money_model->get_list($input_tbl_chart_money);
//                $this->data['chart_money_model'] = $input_tbl_chart_money;

//                promotion ở index
//                $this->load->model('promotion_model');
//                $input_promotion = array();
//                $input_promotion['limit'] = array('2', '0');
//                $promotion_footer = $this->promotion_model->get_list($input_promotion);
//                $this->data['promotion_footer'] = $promotion_footer;
            }
        }
    }

    private function _check_login()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);

        $login = $this->session->userdata('login');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if (!$login && $controller != 'login') {
            redirect(base_url('admin/login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if ($login && $controller == 'login') {
            redirect(base_url('admin/employee'));
        }
    }
}