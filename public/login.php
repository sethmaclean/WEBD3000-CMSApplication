<?php require_once('../private/initialize.php'); ?>

<?php

session_start();

if(!$_POST['username'] || !$_POST['password']) {
    header('Location: index.php');
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$admin = find_admin_by_username($username);

// find the admin by username. if it equals 'admin', direct them to the admin page
// if it doesn't, direct them to the contacts page
if($admin) {
    if(password_verify($password, $admin['password'])) {
        log_in_admin($admin);
        if($_SESSION['username'] === 'admin') {
            redirect_to(url_for('/staff/admin/index.php'));
            exit;
        } else { 
            redirect_to(url_for('/staff/contacts/index.php'));
            exit;
        }
    } else {
        redirect_to(url_for('index.php'));
    }
} else {
    redirect_to(url_for('index.php'));
}


        