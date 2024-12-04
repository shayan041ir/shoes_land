<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    public function register($data) {
        $user = new User();
        if ($user->create($data)) {
            header('Location: /login.php');
        } else {
            echo "Error: Could not register user.";
        }
    }

    public function login($email, $password) {
        $user = new User();
        $userData = $user->getByEmail($email);

        if ($userData && password_verify($password, $userData['password'])) {
            $_SESSION['user'] = $userData;
            header('Location: /user_dashboard.php');
        } else {
            echo "Invalid credentials.";
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        header('Location: /login.php');
    }

    public function orderHistory($userId) {
        $user = new User();
        return $user->getOrderHistory($userId);
    }
}
