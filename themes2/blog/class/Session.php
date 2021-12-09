<?php

/**
 * Created by PhpStorm.
 * User: 555
 * Date: 26.03.2019
 * Time: 17:53
 */
class Session
{
    public function __construct()
    {
        @session_start();
        $this->FilterPortfolio();
    }

    private function FilterPortfolio()
    {
        if(empty($_SESSION['filter-portfolio'])){
            $_SESSION['filter-portfolio'] = array(
                'active' => 0,
                'sort' => 'all'
            );
        }
        if(empty($_SESSION['portfolio_page'])){
            $_SESSION['portfolio_page'] = 10;
        }
    }
}

new Session();