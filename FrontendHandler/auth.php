<?php

session_start();

function auth ()
{
    if (isset($_SESSION['email'])){
        return true;
    }else {
        return false;
    }
}