<?php
require_once 'model/login/login.model.php';

class LoginController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new LoginModel();
    }
    
    public function Index(){
        require_once 'view/login/index.php';
    }
}
?> 