<?php

class AuthController extends Controller {

    public function showLogin() {
        $this->view('auth/login', ['message' => '']);
    }

    public function login() {

        $message  = '';
        $username = trim($_POST['login_email'] ?? '');
        $password = $_POST['login_password'] ?? '';

        if ($username == '' || $password == '') {
            $message = 'Please enter your username and password.';

        } else {

            $db   = Database::connect();
            $stmt = $db->prepare("
                SELECT AdminID, Username, PasswordHash
                FROM Admins
                WHERE Username = ?
            ");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['PasswordHash'])) {

                $_SESSION['admin_id']   = $admin['AdminID'];
                $_SESSION['admin_name'] = $admin['Username'];

                $this->redirect('/?page=admin');

            } else {
                $message = 'Incorrect username or password.';
            }
        }

        $this->view('auth/login', ['message' => $message]);
    }

    public function logout() {
        session_destroy();
        $this->redirect('/?page=login');
    }

    public function showRegister() {
        $this->view('auth/register', ['message' => '']);
    }

    public function register() {

        $message  = '';
        $username = trim($_POST['first_name'] ?? '') . ' ' . trim($_POST['last_name'] ?? '');
        $email    = trim($_POST['register_email'] ?? '');
        $password = $_POST['register_password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        if ($username == ' ' || $email == '' || $password == '') {
            $message = 'Please fill in all fields.';

        } else if ($password !== $confirm) {
            $message = 'Passwords do not match.';

        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $db   = Database::connect();

            $stmt = $db->prepare("
                INSERT INTO Admins (Username, PasswordHash)
                VALUES (?, ?)
            ");
            $stmt->execute([$email, $hash]);
            $message = 'Account created. You can now log in.';
        }

        $this->view('auth/register', ['message' => $message]);
    }
}