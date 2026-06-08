<?php

namespace App\Core;

class Controller
{
    protected string $layout = 'main';

    protected function render(string $view, array $params = []): string
    {
        extract($params, EXTR_SKIP);
        ob_start();
        require dirname(__DIR__, 2) . '/views/' . $view . '.php';
        $content = ob_get_clean();

        ob_start();
        require dirname(__DIR__, 2) . '/views/layouts/' . $this->layout . '.php';
        return ob_get_clean();
    }

    protected function redirect(string $route): never
    {
        header('Location: ?r=' . $route);
        exit;
    }

    protected function e(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }

    protected function csrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    protected function csrfInput(): string
    {
        return '<input type="hidden" name="_csrf" value="' . $this->e($this->csrfToken()) . '">';
    }

    protected function verifyCsrf(): void
    {
        $token = $_POST['_csrf'] ?? '';
        if (!is_string($token) || !hash_equals($this->csrfToken(), $token)) {
            http_response_code(419);
            exit('CSRF token xatosi. Sahifani yangilab qayta urinib ko‘ring.');
        }
    }
}
