<?php

Class Test extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->data['temp'] = 'admin/test';
        $this->load->view('admin/layout', $this->data);
    }
}