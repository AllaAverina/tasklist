<?php

namespace Controllers;

use Models\TaskActiveRecord;
use View\View;
use Exceptions\{NotFoundException, InvalidArgumentException, NotAuthorizedException};

class TasksController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function getPage(int $currentPage = 1): void
    {
        $sort = $_GET['sort'] ?? '';
        $order = $_GET['order'] ?? '';
        $itemsPerPage = 3;
        $tasks = TaskActiveRecord::getSortedTasks($currentPage, $itemsPerPage, $sort, $order);

        if ($tasks == null && $currentPage != 1) {
            throw new NotFoundException();
        }

        $pagesCount = TaskActiveRecord::getPagesCount($itemsPerPage);
        $template = (AdminController::isAdmin()) ? 'tasklist/edit' : 'tasklist/tasks';
        $queryLink = (empty($_GET)) ? '' : '?' . http_build_query($_GET);

        $this->view->renderHtml($template, 'tasklist', [
            'title' => 'Список задач',
            'tasks' => $tasks,
            'currentPage' => $currentPage,
            'pagesCount' => $pagesCount,
            'queryLink' => $queryLink
        ]);
    }

    public function add(): void
    {
        if (!empty($_POST)) {
            $task = new TaskActiveRecord();
            $task->setUsername($_POST['username'] ?? '');
            $task->setEmail($_POST['email'] ?? '');
            $task->setText($_POST['text'] ?? '');
            try {
                $task->save();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('tasklist/add', 'default', [
                    'title' => 'Добавить задачу',
                    'message' => $e->getMessage(),
                    'task' => $task
                ]);
                return;
            }
            header('Location: /');
            exit;
        }
        $this->view->renderHtml('tasklist/add', 'default', ['title' => 'Добавить задачу']);
    }

    public function edit(int $id): void
    {
        if (AdminController::isAdmin()) {
            $task = TaskActiveRecord::getById($id);
            $task->setStatus($_POST['status'] ?? '');
            $task->setText($_POST['text'] ?? '');
            $task->save();
            $this->goBack();
        }
        throw new NotAuthorizedException();
    }

    public function delete(int $id): void
    {
        if (AdminController::isAdmin()) {
            $task = TaskActiveRecord::getById($id);
            $task->delete();
            $this->goBack();
        }
        throw new NotAuthorizedException();
    }

    private function goBack(): void
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
