<?php
require_once('dbConnect.php');
class Data extends DB_Connect
{
    public function getFixtures()
    {
        $str = file_get_contents('https://fantasy.premierleague.com/drf/fixtures/');
        $json = json_decode($str, true);
        $rs = true;
        $con = $this->connect();
        for ($i = 0; $i < count($json); $i++){
            $date = $json[$i]['deadline_time'];
            if($json[$i]['finished'] == true){
                $stt = "Đã thi đấu";
            }else{
                $stt = "Chưa thi đấu";
            }
            $sql = "INSERT INTO `fixtures` (`id`, `Date`, `Status`, `AScore`, `HScore`, `id_a`, `id_h`) 
                    VALUES ('". $json[$i]['id'] ."', '". strtotime(split("T", $date)[0]) ."', '". $stt ."', '". $json[$i]['team_a_score'] ."', '". $json[$i]['team_h_score'] ."', '". $json[$i]['team_a'] ."', '". $json[$i]['team_h'] ."');";
            $rs = $con -> query($sql) AND $rs;
        }
        return $rs;
    }

    public function getTeams()
    {
        $str = file_get_contents('https://fantasy.premierleague.com/drf/teams/');
        $json = json_decode($str, true);
        $rs = true;
        $con = $this->connect();
        for ($i = 0; $i < count($json); $i++){
            $sname = $json[$i]['short_name'];
            $sql = "INSERT INTO `teams` (`id`, `idT`, `idL`, `name`, `sname`, `logo`) 
                    VALUES (NULL, '". $json[$i]['id'] ."', '1', '". $json[$i]['name'] ."', '". $sname ."', 'images/". strtolower($sname) .".png');";
            $rs = $con -> query($sql) AND $rs;
        }
        return $rs;
    }

    public function getLeague(){
        $str = file_get_contents('http://api.football-data.org/v1/soccerseasons');
        $json = json_decode($str, true);
        $rs = true;
        $con = $this->connect();
        $con -> query('DELETE FROM `league`');
        for ($i = 0; $i < count($json); $i++){
            $sql = "INSERT INTO `league` (`id`, `idL`, `name`, `numberOfMatchdays`, `numberOfTeams`, `numberOfGames`)
                    VALUES (NULL, '". $json[$i]['id'] ."', '". $json[$i]['caption'] ."', '". $json[$i]['numberOfMatchdays'] ."', '". $json[$i]['numberOfTeams'] ."', '". $json[$i]['numberOfGames'] ."');";
            $rs = $con -> query($sql) AND $rs;
        }
        return $rs;
    }
}
?>