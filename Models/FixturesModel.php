<?php
require_once('dbconnect.php');

class FixturesModel extends DB_Connect
{
    public function checkLogin($user){
        $con = $this->connect();
        $result = $con->query('SELECT * FROM users');
        $users = array();
        if ($result->num_rows > 0) {
            while ($u = $result->fetch_assoc()) {
                $users[] = $u;
            }
        }
        foreach ($users as $u):
            if (($user['username'] == $u['username']) && ($user['password'] == $u['password']) && ($u['role'] == 0) && ($u['block'] == 0)) {
                return $check = true;
            }
        endforeach;
    }

    public function getTeams($id)
    {
        $sql = 'SELECT * FROM `teams` WHERE `idL`=' . $id;
        $con = $this->connect();
        $rs = $con->query($sql);
        $teams = array();
        if ($rs->num_rows > 0) {
            while ($t = $rs->fetch_assoc()) {
                $teams[] = $t;
            }
        }
        return $teams;
    }

    public function getFixtures($id)
    {
        $sql = 'SELECT * FROM `fixtures` WHERE `idL`=' . $id;
        $con = $this->connect();
        $rs = $con->query($sql);
        $fixtures = array();
        if ($rs->num_rows > 0) {
            while ($fx = $rs->fetch_assoc()) {
                $fixtures[] = $fx;
            }
        }
        return $fixtures;
    }

    public function getLeague()
    {
        $sql = 'SELECT * FROM `league`';
        $con = $this->connect();
        $rs = $con->query($sql);
        $league = array();
        if ($rs->num_rows > 0) {
            while ($lg = $rs->fetch_assoc()) {
                $league[] = $lg;
            }
        }
        return $league;
    }

    public function addData($id)
    {
        $con = $this->connect();
        $league = $this->getLeague();
        $rs = true;
        $check = false;
        foreach ($league as $lg) :
            if ($id == $lg['idL']) {
                $check = true;
                break;
            } else {
                $check = false;
            }
        endforeach;
        if ($check) {
            $sql = "UPDATE `league` SET `public` = '1' WHERE `league`.`idL` =" . $id . ";";
            $rs = $con->query($sql);
            return $rs;
        } else {
            $strL = file_get_contents('http://api.football-data.org/v1/soccerseasons');
            $jsonL = json_decode($strL, true);
            for ($i = 0; $i < count($jsonL); $i++) {
                if ($jsonL[$i]['id'] == $id) {
                    $sqlL = "INSERT INTO `league` (`id`, `idL`, `name`, `numberOfMatchdays`, `numberOfTeams`, `numberOfGames`, `public`)
                    VALUES (NULL, '" . $id . "', '" . $jsonL[$i]['caption'] . "', '" . $jsonL[$i]['numberOfMatchdays'] . "', '" . $jsonL[$i]['numberOfTeams'] . "', '" . $jsonL[$i]['numberOfGames'] . "', '1');";
                    $rs = $con->query($sqlL) AND $rs;
                    $strT = file_get_contents($jsonL[$i]['_links']['teams']['href']);
                    $jsonT = json_decode($strT, true);
                    for ($j = 0; $j < count($jsonT['teams']); $j++) {
                        $idT = split('/', $jsonT['teams'][$j]['_links']['self']['href'])[count(split('/', $jsonT['teams'][$j]['_links']['self']['href'])) - 1];
                        $sqlT = "INSERT INTO `teams` (`id`, `idT`, `idL`, `name`, `sname`, `logo`, `players`, `fixtures`)
                    VALUES (NULL, '" . $idT . "', '" . $id . "', '" . $jsonT['teams'][$j]['name'] . "', '" . $jsonT['teams'][$j]['shortName'] . "', '" . $jsonT['teams'][$j]['crestUrl'] . "', '" . $jsonT['teams'][$j]['_links']['players']['href'] . "', '" . $jsonT['teams'][$j]['_links']['fixtures']['href'] . "');";
                        $rs = $con->query($sqlT) AND $rs;
                    }
                    $sqlF = "INSERT INTO `fixtures` (`id`, `idL`, `fixtures`, `leagueTable`)
                    VALUES (NULL, '" . $id . "', '" . $jsonL[$i]['_links']['fixtures']['href'] . "', '" . $jsonL[$i]['_links']['leagueTable']['href'] . "');";
                    $rs = $con->query($sqlF) AND $rs;
                }
            }
            return $rs;
        }
    }

    public function deleteData($id)
    {
        $sql = "UPDATE `league` SET `public` = '0' WHERE `league`.`idL` =" . $id . ";";
        $con = $this->connect();
        $rs = $con->query($sql);
        return $rs;
    }

    public function getUser()
    {
        $sql = 'SELECT * FROM users, role WHERE users.role = role.idR';
        $con = $this->connect();
        $rs = $con->query($sql);
        $users = array();
        if ($rs->num_rows > 0) {
            while ($u = $rs->fetch_assoc()) {
                $users[] = $u;
            }
        }
        return $users;
    }

    public function addUser($u)
    {
        $con = $this->connect();
        $sql = "INSERT INTO `users` (`id`, `avatar`, `username`, `password`, `fullname`, `email`, `phone`, `role`, `block`) 
                VALUES (NULL, 'images/default.jpg','" . $u['username'] . "', '" . $u['password'] . "', '" . $u['name'] . "', '" . $u['email'] . "', '" . $u['phone'] . "', '1','0');";
        $rs = $con->query($sql);
        $id = array();
        if ($rs) {
            $sql_get_id = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
            $rs_id = $con->query($sql_get_id);
            if ($rs_id->num_rows > 0) {
                while ($r_i = $rs_id->fetch_assoc()) {
                    $id[] = $r_i;
                }
            }
        }
        return $id;
    }

    public function editUser($u)
    {
        if($u['role'] == ''){
            if ($u['avatar'] == '') {
                $sql = "UPDATE `users` SET `fullname` = '" . $u['name'] . "', `email` = '" . $u['email'] . "', `phone` = '" . $u['phone'] . "', `block` = '" . $u['block'] . "'
                WHERE `users`.`id` = " . $u['id'] . ";";
            } else {
                $sql = "UPDATE `users` SET `avatar` = '" . $u['avatar'] . "', `fullname` = '" . $u['name'] . "', `email` = '" . $u['email'] . "', `phone` = '" . $u['phone'] . "', `block` = '" . $u['block'] . "'
                WHERE `users`.`id` = " . $u['id'] . ";";
            }
        }else{
            if ($u['avatar'] == '') {
                $sql = "UPDATE `users` SET `fullname` = '" . $u['name'] . "', `email` = '" . $u['email'] . "', `phone` = '" . $u['phone'] . "', `role` = '" . $u['role'] . "', `block` = '" . $u['block'] . "'
                WHERE `users`.`id` = " . $u['id'] . ";";
            } else {
                $sql = "UPDATE `users` SET `avatar` = '" . $u['avatar'] . "', `fullname` = '" . $u['name'] . "', `email` = '" . $u['email'] . "', `phone` = '" . $u['phone'] . "', `role` = '" . $u['role'] . "', `block` = '" . $u['block'] . "'
                WHERE `users`.`id` = " . $u['id'] . ";";
            }
        }
        $con = $this->connect();
        $rs = $con->query($sql);
        return $rs;
    }

    public function deleteUser($id)
    {
        $sql = 'DELETE FROM `users` WHERE `users`.`id` = ' . $id . ';';
        $con = $this->connect();
        $rs = $con->query($sql);
        return $rs;
    }

//    public function getNews(){
//        $sql = 'SELECT * FROM news';
//        $con = $this->connect();
//        $rs = $con -> query($sql);
//        $news = array();
//        if($rs -> num_rows > 0){
//            while ($n = $rs -> fetch_assoc()){
//                $news[] = $n;
//            }
//        }
//        return $news;
//    }

    public function addNews($news)
    {
        $con = $this->connect();
        $sql = "INSERT INTO `news` (`id`, `imgPost`, `title`, `content`, `datePost`) 
                VALUES (NULL, '" . $news['imgPost'] . "', '" . $news['title'] . "', '" . $news['content'] . "', '" . $news['datePost'] . "');";
        $rs = $con->query($sql);
        return $rs;
    }

    public function detailNews($id, $button)
    {
        $con = $this->connect();
        $sql = 'SELECT * FROM news WHERE id=' . $id;
        $rs = $con->query($sql);
        if ($button == 'next') {
            while ($rs->num_rows == 0) {
                $rs = $con->query('SELECT * FROM news WHERE id=' . ((int)$id - 1));
            }
        }else {
            if ($button == 'previous') {
                while ($rs->num_rows == 0) {
                    $rs = $con->query('SELECT * FROM news WHERE id=' . ((int)$id + 1));
                }
            }
        }
        $news = array();
        if ($rs->num_rows > 0) {
            while ($n = $rs->fetch_assoc()) {
                $news[] = $n;
            }
        }
        return $news;
    }

    public function findNews($id){
        $con = $this->connect();
        $sql = 'SELECT * FROM news WHERE id=' . $id;
        $rs = $con->query($sql);
        $news = array();
        if ($rs->num_rows > 0) {
            while ($n = $rs->fetch_assoc()) {
                $news[] = $n;
            }
        }
        return $news;
    }

    public function deleteNews($id)
    {
        $con = $this->connect();
        $sql = 'DELETE FROM `news` WHERE `id` = ' . $id;
        $rs = $con->query($sql);
        return $rs;
    }

    public function editNews($news)
    {
        $sql = "UPDATE `news` SET `title` = '" . $news['title'] . "', `content` = '" . $news['content'] . "'
                WHERE `news`.`id` = " . $news['id'] . ";";
        $con = $this->connect();
        $rs = $con->query($sql);
        return $rs;
    }

    function count_all_data($table)
    {
        $sql = 'select count(*) as total from ' . $table;
        $con = $this->connect();
        $rs = $con->query($sql);
        if ($rs) {
            $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
            return $row['total'];
        }
        return 0;
    }

// Lấy danh sách thành viên
    function get_all_data($limit, $start, $table)
    {
        $con = $this->connect();
        if ($table == 'users') {
            $sql = 'select * from ' . $table . ', role WHERE users.role = role.idR limit ' . (int)$start . ',' . (int)$limit;
        } else {
            $sql = 'select * from ' . $table . ' ORDER BY id DESC limit ' . (int)$start . ',' . (int)$limit;
        }
        $query = mysqli_query($con, $sql);

        $result = array();

        if ($query) {
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $result[] = $row;
            }
        }

        return $result;
    }
}

?>