<?php
/**
 * Created by PhpStorm.
 * User: Huong
 * Date: 4/11/2015
 * Time: 2:58 PM
 */

Class UsersController extends AppController {
    var $name = "Users";
    var $layout = false; //khoong su dung layout mac dinh cua cake (dung file css rieng)
    var $helpers = array("Html");
    var $component = array("Session");
    var $_sessionUsername = "Username";

    //
    function view() {
        if(!$this->session->read($this->_sessionUsername))
            $this->redirect("login");
        else
            $this->render("/users/index");
    }

    //
    function login(){
        $error = "";
        if($this->Session->read($this->_sessionUsername))
            $this->redirect("view");
        if(isset($_POST['ok'])) {
            $username = $_POST('username');
            $password = $_POST('password');
        }
    }



}