<?php



class View_Login
{
    public function show_login()
    {
        require_once 'config/config.php';
        include 'res/templates/login.php';
    }

    public function show_register()
    {
        require_once 'config/config.php';
        include 'res/templates/register.php';
    }

    public function test_result()
    {
        require_once 'config/config.php';
        include 'res/templates/teacher01/add_question.html';
        // include 'res/templates/test_result.php';
    }
}
