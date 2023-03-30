<?php

use Controllers\{TasksController, AdminController};

return [
    '~^/tasks/add$~' => ['controller' => TasksController::class, 'action' => 'add'],
    '~^/tasks/(\d+)/edit$~' => ['controller' => TasksController::class, 'action' => 'edit'],
    '~^/tasks/(\d+)/delete$~' => ['controller' => TasksController::class, 'action' => 'delete'],
    '~^/admin$~' => ['controller' => AdminController::class, 'action' => 'auth'],
    '~^/admin/logout$~' => ['controller' => AdminController::class, 'action' => 'logout'],
    '~^/(\d+)$~' => ['controller' => TasksController::class, 'action' => 'getPage'],
    '~^/$~' => ['controller' => TasksController::class, 'action' => 'getPage']
];