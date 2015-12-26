<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class College extends CI_Controller {

    private $use;

    public function __construct(){

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/college_lib_ad');

        $session = new class_sessions_admin();

        if(!$session->get_login_admin_in()){

            redirect('admin/home/login');
        }
    }

    public function index(){

        $session = new class_sessions_admin();

        if($session->get_login_admin_in()){

            $page= new render_admin();

            $page->page_college();
        }else{

            redirect('admin/home/login');
        }
    }

    public function ajax_all(){

        $lib = new college_lib_ad();

        $lib->find_all_ajax();


    }

    public function remove(){


        $lib = new college_lib_ad();

        $lib->remove();

    }

    public function update(){

        $lib = new college_lib_ad();

        $lib->update();
    }

    public function insert(){
        $lib = new college_lib_ad();

        $lib->insert();


    }

    public function update_status(){
        $lib = new college_lib_ad();

        $lib->update_status();
    }

    public function ajax_students(){
        $lib = new college_lib_ad();

        $lib->ajax_students();
    }

    public function ajax_find_students(){
        $lib = new college_lib_ad();

        $lib->ajax_find_students();
    }

    public function view_student(){

        $session = new class_sessions_admin();

        if($session->get_login_admin_in()){

            $page= new render_admin();

            $page->page_college_view_student();
        }else{

            redirect('admin/home/login');
        }

    }



}