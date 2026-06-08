<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;

class AuthController extends Controller
{
    protected string $layout = 'admin';

    public function actionLogin(): string
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (Auth::attempt(trim($_POST['email'] ?? ''), $_POST['password'] ?? '')) {
                $this->redirect('admin/dashboard');
            }
            $error = 'Email yoki parol noto‘g‘ri.';
        }

        return $this->render('admin/login', ['error' => $error]);
    }

    public function actionLogout(): never
    {
        Auth::logout();
        $this->redirect('auth/login');
    }
}
