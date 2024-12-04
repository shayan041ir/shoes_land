<?php

class AdminController
{
    public function dashboard()
    {
        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // اعتبارسنجی کاربر
            require_once __DIR__ . '/../models/Admin.php';
            $adminModel = new Admin();
            if ($adminModel->authenticate($username, $password)) {
                $_SESSION['admin_logged_in'] = true;
                header('Location: /admin/dashboard');
                exit;
            } else {
                $error = "نام کاربری یا رمز عبور اشتباه است.";
            }
        }
        require_once __DIR__ . '/../views/admin/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: /admin/login');
        exit;
    }
}
