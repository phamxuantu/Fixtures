<?php
require_once ('Models/FixturesModel.php');
require_once('Views/FixturesView.php');
require_once ('Models/Data.php');
class FixturesController{
    public function home(){
        //$fxModel = new FixturesModel();
        $fxModel = new FixturesModel();
        $league = $fxModel -> getLeague();
        $fxView = new FixturesView();
        $fxView -> sidebar($league);
        $fxView -> home($league);
    }

    public function getDataL(){
        $fxModel = new FixturesModel();
        $league = $fxModel -> getLeague();
        $fxView = new FixturesView();
        $fxView -> notify($league);
    }

    public function getTeams(){
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $teams = $fxModel -> getTeams($id);
        $fxView = new FixturesView();
        $fxView->showTeams($teams);
    }

    public function getFixtures(){
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $fixtures = $fxModel -> getFixtures($id);
        $teams = $fxModel -> getTeams($id);
        $fxView = new FixturesView();
        $fxView -> showFixtures($fixtures, $teams);
    }

    public function getLeague(){
        $fxModel = new FixturesModel();
        $league = $fxModel -> getLeague();
        $fxView = new FixturesView();
        $fxView -> sidebar($league);
    }

    public function addData(){
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $rs = $fxModel -> addData($id);
        $fxView = new FixturesView();
        $fxView -> notify($rs);
    }

    public function deleteData(){
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $rs = $fxModel -> deleteData($id);
        $fxView = new FixturesView();
        $fxView -> notify($rs);
    }

    public function getUser(){
        $fxModel = new FixturesModel();
        $users = $fxModel -> getUser();
        $fxView = new FixturesView();
        $fxView -> showUsers($users);
    }

    public function addUser(){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        if($_POST['role'] == "Admin"){
            $role = "0";
        }else{
            $role = "1";
        }
        $u = array('name' => $name,
            'username' => $username,
            'password' => $password,
            'phone' => $phone,
            'role' => $role,
            'email' => $email,);
        $fxModel = new FixturesModel();
        $rs = $fxModel -> addUser($u);
        $fxView = new FixturesView();
        $fxView -> idUser($rs);
    }

    public function editUser(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        if($_POST['role'] == "Admin"){
            $role = "0";
        }else{
            $role = "1";
        }
        $u = array('id' => $id,
            'name' => $name,
            'phone' => $phone,
            'role' => $role,
            'email' => $email,);
        $fxModel = new FixturesModel();
        $rs = $fxModel -> editUser($u);
        $fxView = new FixturesView();
        $fxView -> notify($rs);
    }

    public function deleteUser(){
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $rs = $fxModel -> deleteUser($id);
        $fxView = new FixturesView();
        $fxView -> notify($rs);
    }

    public function getNews(){
        $fxModel = new FixturesModel();
        $news = $fxModel -> getNews();
        $fxView = new FixturesView();
        $fxView -> showNews($news);
    }

    public function addNews(){

    }
}