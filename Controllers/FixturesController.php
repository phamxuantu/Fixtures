<?php
session_start();
require_once('Models/FixturesModel.php');
require_once('Views/FixturesView.php');
require_once('Models/Data.php');
include 'Models/Soccerseason.php';
include 'Models/Team.php';
include_once 'pagination.php';

class FixturesController
{
    public $config;
    public $baseUri;
    public $reqPrefs = array();

    public function __construct()
    {
        $this->config = parse_ini_file('config.ini', true);

        // some lame hint for the impatient
        if ($this->config['authToken'] == 'YOUR_AUTH_TOKEN' || !isset($this->config['authToken'])) {
            exit('Get your API-Key first and edit config.ini');
        }

        $this->baseUri = $this->config['baseUri'];

        $this->reqPrefs['http']['method'] = 'GET';
        $this->reqPrefs['http']['header'] = 'X-Auth-Token: ' . $this->config['authToken'];
    }

    public function login()
    {
        $fxView = new FixturesView();
        $fxView->login();
    }

    public function checkLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = array('username' => $username,
            'password' => $password,);
        $fxModel = new FixturesModel();
        $check = $fxModel->checkLogin($user);
        if ($check) {
            $_SESSION['username'] = $username;
            header("location: index.php?action=home");
        } else {
            echo '<script type="text/javascript">alert("Wrong username or password !!!!")</script>';
            $this->login();
        }
    }

    public function logout()
    {
        unset($_SESSION['username']);
        header('location: index.php?action=login');
    }

    public function getSoccerseason()
    {
        $resource = 'soccerseasons/';
        $response = file_get_contents($this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs));
        $result = json_decode($response);
        $fxModel = new FixturesModel();
        $league = $fxModel->getLeague();
        $fxView = new FixturesView();
        $fxView->showLeague($result, $league);
    }

    public function home()
    {
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $fxModel = new FixturesModel();
            $league = $fxModel->getLeague();
            $fxView = new FixturesView();
            $fxView->sidebar($league, $username);
            $news = '';
            $page = '';
            if (isset($_GET['current'])) {
                if ($_GET['current'] == 'News') {
                    $config = array(
                        'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
                        'total_record' => $fxModel->count_all_data('news'), // tổng số thành viên
                        'limit' => 5,
                        'link_full' => 'index.php?action=getNews&page={page}',
                        'link_first' => 'index.php?action=getNews',
                        'range' => 3
                    );
                    $paging = new Pagination();
                    $paging->init($config);
                    $limit = $paging->get_config('limit');
                    $start = $paging->get_config('start');
                    $news = $fxModel->get_all_data($limit, $start, 'news');
                    $page = $paging->html();
                }
            } else {
                $news = '';
                $page = '';
            }
            $fxView->home($league, $news, $page);
        }else {
            echo '<script type="text/javascript">alert("You are not logged in, please log in to use!!")</script>';
            $this->login();
        }
    }

    public function getDataL()
    {
        $fxModel = new FixturesModel();
        $league = $fxModel->getLeague();
        $fxView = new FixturesView();
        $fxView->notify($league);
    }

    public function getTeams()
    {
        $id = $_GET['id'];
        $resource = 'soccerseasons/' . $id . '/teams';
        $response = file_get_contents($this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs));
        $result = json_decode($response);
        $teams = $result->teams;
//        $fxModel = new FixturesModel();
//        $teams = $fxModel -> getTeams($id);
        $fxView = new FixturesView();
        $fxView->showTeams($teams);
    }

    public function getFixtures()
    {
        $id = $_GET['id'];
        $resource = 'soccerseasons/' . $id;
        $response = file_get_contents($this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs));
        $result = json_decode($response);
        $soccerSeason = new Soccerseason($result);
        if (isset($_GET['matchDay'])) {
            $mathchDay = $_GET['matchDay'];
        } else {
            $mathchDay = $soccerSeason->getCurrentMatchDay();
        }
        $fixtures = $soccerSeason->getFixturesByMatchday($mathchDay);
        $resourceTeam = 'soccerseasons/' . $id . '/teams';
        $responseTeam = file_get_contents($this->baseUri . $resourceTeam, false,
            stream_context_create($this->reqPrefs));
        $resultTeam = json_decode($responseTeam);
        $teams = $resultTeam->teams;
        $numberOfMatchdays = $result->numberOfMatchdays;
//        $fxModel = new FixturesModel();
//        $fixtures = $fxModel -> getFixtures($id);
//        $teams = $fxModel -> getTeams($id);
        $fxView = new FixturesView();
        $fxView->showFixtures($fixtures, $teams, $mathchDay, $numberOfMatchdays, $id);
    }

    public function getTable()
    {
        $id = $_GET['id'];
        $resource = 'soccerseasons/' . $id . '/leagueTable';
        $response = file_get_contents($this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs));
        $result = json_decode($response);
        $table = $result->standing;
        $fxView = new FixturesView();
        $fxView->showTable($table);
    }

    public function getLeague()
    {
        $fxModel = new FixturesModel();
        $league = $fxModel->getLeague();
        $fxView = new FixturesView();
        $fxView->sidebar($league);
    }

    public function addData()
    {
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $rs = $fxModel->addData($id);
        $fxView = new FixturesView();
        $fxView->notify($rs);
    }

    public function deleteData()
    {
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $rs = $fxModel->deleteData($id);
        $fxView = new FixturesView();
        $fxView->notify($rs);
    }

    public function getUser()
    {
        $username = $_SESSION['username'];
        $fxModel = new FixturesModel();
        $config = array(
            'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
            'total_record' => $fxModel->count_all_data('users'), // tổng số thành viên
            'limit' => 5,
            'link_full' => 'index.php?action=getUser&page={page}',
            'link_first' => 'index.php?action=getUser',
            'range' => 3
        );
        $paging = new Pagination();
        $paging->init($config);
        $limit = $paging->get_config('limit');
        $start = $paging->get_config('start');
        $users = $fxModel->get_all_data($limit, $start, 'users');
        $page = $paging->html();
        $fxView = new FixturesView();
        $fxView->showUsers($users, $page, $username);
    }

    public function addUser()
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $u = array('name' => $name,
            'username' => $username,
            'password' => $password,
            'phone' => $phone,
            'email' => $email,);
        $fxModel = new FixturesModel();
        $rs = $fxModel->addUser($u);
        if ($rs != 0) {
            $this->getUser();
        }
    }

    public function editUser()
    {
        $id = $_POST['idE'];
        $name = $_POST['nameE'];
        $phone = $_POST['phoneE'];
        $email = $_POST['emailE'];
        if(isset($_POST['roleE'])){
            if ($_POST['roleE'] == "Admin") {
                $role = "0";
            } else {
                $role = "1";
            }
        }else{
            $role = '';
        }
        if (isset($_POST['block'])) {
            $block = 1;
        } else {
            $block = 0;
        }
        if (0 < $_FILES['avatar']['error']) {
            $destination = '';
        } else {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = getdate();
            $currentDate = $now["mday"] . "-" . $now["mon"] . "-" . $now["year"];
            $currentTime = $now["hours"] . "-" . $now["minutes"] . "-" . $now["seconds"];
            $path_parts = pathinfo($_FILES["avatar"]["name"]);
            $extension = $path_parts['extension'];
            $destination = "images/" . $id . "_" . $currentDate . "_" . $currentTime . "." . $extension;
            if (is_dir('images')) {
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $destination);
            } else {
                mkdir('images');
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $destination);
            }
        }
        $u = array('id' => $id,
            'name' => $name,
            'phone' => $phone,
            'role' => $role,
            'email' => $email,
            'block' => $block,
            'avatar' => $destination);
        $fxModel = new FixturesModel();
        $rs = $fxModel->editUser($u);
        $fxView = new FixturesView();
        $fxView->notify($rs);
    }

    public function deleteUser()
    {
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $rs = $fxModel->deleteUser($id);
        $fxView = new FixturesView();
        $fxView->notify($rs);
    }

    public function getNews()
    {
        $fxModel = new FixturesModel();
        $config = array(
            'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
            'total_record' => $fxModel->count_all_data('news'), // tổng số thành viên
            'limit' => 5,
            'link_full' => 'index.php?action=getNews&page={page}',
            'link_first' => 'index.php?action=getNews',
            'range' => 3
        );
        $paging = new Pagination();
        $paging->init($config);
        $limit = $paging->get_config('limit');
        $start = $paging->get_config('start');
        $news = $fxModel->get_all_data($limit, $start, 'news');
        $page = $paging->html();
        $fxView = new FixturesView();
        $fxView->showNews($news, $page);
    }

//    public function pagingNews(){
//        $fxModel = new FixturesModel();
//        $config = array(
//            'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
//            'total_record'  => $fxModel -> count_all_data('news'), // tổng số thành viên
//            'limit'         => 5,
//            'link_full'     => 'index.php?page={page}',
//            'link_first'    => 'index.php',
//            'range'         => 9
//        );
//        $paging = new Pagination();
//        $paging->init($config);
//        $limit = $paging->get_config('limit');
//        $start = $paging->get_config('start');
//        $data = $fxModel -> get_all_data($limit, $start, 'news');
//        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//            die (json_encode(array(
//                'data' => $data,
//                'paging' => $paging->html()
//            )));
//        }
//    }

    public function formAddNews()
    {
        $fxView = new FixturesView();
        $fxView->showFormAddNews();
    }

    public function addNews()
    {
        if ($_POST['confirmPost'] == 'Cancel') {
            header('location: index.php?action=home&current=News');
        } else {
            $allowedTags = '<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
            $allowedTags .= '<li><ol><ul><span><div><br><ins><del>';
            $title = $_POST['txtTitle'];
            $content = strip_tags(stripslashes($_REQUEST['txtContent']), $allowedTags);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = getdate();
            $currentDate = $now["mday"] . "-" . $now["mon"] . "-" . $now["year"];
            $currentTime = $now["hours"] . "-" . $now["minutes"] . "-" . $now["seconds"];
            $path_parts = pathinfo($_FILES["imgNews"]["name"]);
            $extension = $path_parts['extension'];
            $destination = "images/" . $currentDate . "_" . $currentTime . "." . $extension;
            if (is_dir('images')) {
                move_uploaded_file($_FILES["imgNews"]["tmp_name"], $destination);
            } else {
                mkdir('images');
                move_uploaded_file($_FILES["imgNews"]["tmp_name"], $destination);
            }
            $news = array('title' => $title,
                'content' => $content,
                'imgPost' => $destination,
                'datePost' => date('Y-m-d H:i:s'));
            $fxModel = new FixturesModel();
            $rs = $fxModel->addNews($news);
            if ($rs) {
                header('location: index.php?action=home&current=News');
            } else {
                echo 'failure';
            }
        }
    }

    public function detailNews()
    {
        if (isset($_GET['button'])) {
            $id = $_GET['id'];
            $button = $_GET['button'];
            $fxModel = new FixturesModel();
            $news = $fxModel->detailNews($id, $button);
            $fxView = new FixturesView();
            $fxView->detailNews($news);
        } else {
            $id = $_GET['id'];
            $button = '';
            $fxModel = new FixturesModel();
            $news = $fxModel->detailNews($id, $button);
            $fxView = new FixturesView();
            $fxView->detailNews($news);
        }
    }

    public function editNews()
    {
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $news = $fxModel->findNews($id);
        $fxView = new FixturesView();
        $fxView->showFormEditNews($news);
    }

    public function doEditNews()
    {
        if ($_POST['confirmEdit'] == 'Cancel') {
            header('location: index.php?action=home&current=News');
        } else {
            $id = $_POST['id'];
            $title = $_POST['txtTitle'];
            $content = $_POST['txtContent'];
            $linkImg = $_POST['linkImg'];
            if (0 < $_FILES['imgNews']['error']) {
            } else {
                $nameImg = split('/', $linkImg)[1];
                unlink($linkImg);
                move_uploaded_file($_FILES['imgNews']['tmp_name'], 'images/' . $nameImg);
            }
            $news = array('id' => $id,
                'title' => $title,
                'content' => $content,);
            $fxModel = new FixturesModel();
            $rs = $fxModel->editNews($news);
            if ($rs) {
                header('location: index.php?action=home&current=News');
            } else {
                echo 'failure';
            }
        }
    }

    public function deleteNews()
    {
        $id = $_GET['id'];
        $fxModel = new FixturesModel();
        $rs = $fxModel->deleteNews($id);
        $fxView = new FixturesView();
        $fxView->notify($rs);
    }

}