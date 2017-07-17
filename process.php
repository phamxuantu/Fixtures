<?php
class Run
{
    function run()
    {
        require_once('Controllers/FixturesController.php');
        $fxController = new FixturesController();
        if (isset($_GET['action'])) {
            $fxController->$_GET['action']();
        } else {
            $fxController->home();
        }
    }
}
?>