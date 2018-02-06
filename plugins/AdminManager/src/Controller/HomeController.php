<?php
namespace AdminManager\Controller;


class HomeController extends AdminController
{
    public function home()
    {
        error_log(print_r("Runni111ng", true), 3, '/var/www/DEV_JP/logs/debug.txt');
    }
}
