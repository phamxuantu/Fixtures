<?php
    class FixturesView{
        public function home($league){
            require_once ('Templates/home.php');
        }

        public function showTeams($teams){
            require_once ('Templates/listTeams.php');
        }

        public function showFixtures($fixtures, $teams){
            require_once ('Templates/listFixtures.php');
        }

        public function sidebar($league){
            require_once ('Templates/sidebar.php');
        }

        public function notify($rs){
            require_once ('Templates/notify.php');
        }

        public function updateSidebar($league){
            require_once ('Templates/updateSidebar.php');
        }

        public function showUsers($users){
            require_once ('Templates/listUsers.php');
        }

        public function idUser($rs){
            require_once ('Templates/idUser.php');
        }

        public function showNews($news){
            require_once ('Templates/listNews.php');
        }
    }
?>