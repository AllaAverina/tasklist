<?php

namespace Controllers;

use Models\AdminModel;
use View\View;
use Exceptions\InvalidArgumentException;

class AdminController
{
    protected $view;
    protected $model;

    public function __construct()
    {
        $this->model = new AdminModel();
        $this->view = new View();
    }

    public static function isAdmin(): bool
    {
        session_start();
        return $_SESSION['admin'] ?? false;
    }

    public function auth(): void
    {
        if (!empty($_POST)) {
            try {
                $this->model->auth($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('admin/form', 'default', ['title' => 'Панель администратора', 'message' => $e->getMessage()]);
                return;
            }
            session_start();
            $_SESSION['admin'] = true;
            header('Location: /');
            exit;
        }
        $this->view->renderHtml('admin/form', 'default', ['title' => 'Панель администратора']);
    }

    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}
