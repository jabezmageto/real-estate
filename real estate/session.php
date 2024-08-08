<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUser() {
    return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username']
    ];
}

function loginUser($id, $username) {
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $username;
}

function logoutUser() {
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
}
?>
