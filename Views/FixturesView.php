<?php
    class FixturesView{
        public function login(){
            require_once ('Templates/login.php');
        }

        public function home($league, $news, $page){
            require_once ('Templates/home.php');
        }

        public function showTeams($teams){
            require_once ('Templates/listTeams.php');
        }

        public function showFixtures($fixtures, $teams, $mathchDay, $numberOfMatchdays, $id){
            require_once ('Templates/listFixtures.php');
        }

        public function showTable($table){
            require_once ('Templates/dataTable.php');
        }

        public function sidebar($league, $username){
            require_once ('Templates/sidebar.php');
        }

        public function notify($rs){
            require_once ('Templates/notify.php');
        }

        public function updateSidebar($league){
            require_once ('Templates/updateSidebar.php');
        }

        public function showUsers($users, $page, $username){
            require_once ('Templates/listUsers.php');
        }

        public function idUser($rs){
            require_once ('Templates/idUser.php');
        }

        public function showNews($news, $page){
            require_once ('Templates/listNews.php');
        }

        public function showFormAddNews(){
            require_once ('Templates/formAddNews.php');
        }

        public function detailNews($news){
            require_once ('Templates/detailNews.php');
        }

        public function showFormEditNews($news){
            require_once ('Templates/formEditNews.php');
        }

        public function showLeague($result, $league){
            require_once ('Templates/listLeague.php');
        }
    }
?>