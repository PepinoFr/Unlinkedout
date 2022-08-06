<?php

function is_connect() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connect']);
}

function user_connect() {
    if (!is_connect()){
        header('Location: /viewLogin.php');
        exit();
    }
}

function connect($user) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['connect'] = $user;

}

function getConnect() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!empty($_SESSION['connect']) )
    return  $_SESSION['connect'];
}
function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['connect']);
    exit( header('Location: http://localhost/Unlinkedout/accueil'));

}

function authorized($user,$element) {
    return $element->getAuthor()== $user->getId() || $user->getRole() == 2;
}

