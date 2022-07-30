<?php

function is_connect () {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connect']);
}

function user_connect () {
    if (!is_connect()){
        header('Location: /viewLogin.php');
        exit();
    }
}

function connect ($user){
    session_start();
    $_SESSION['connect'] = $user;

}
function getConnect(){
    session_start();
    return  $_SESSION['connect'];
}

