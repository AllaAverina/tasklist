<a href="/tasks/add" class="button dark">Добавить задачу</a>
<div class="container">
    <?php foreach ($tasks as $task) : ?>
        <div class="task dark">
            <?php if ($task->getStatus() == true) : ?>
                <p class="complited">Отредактировано администратором</p>
            <?php endif; ?>
            <p>Создал(-а): <?= htmlspecialchars($task->getUsername(), ENT_QUOTES) ?></p>
            <p>Email: <?= htmlspecialchars($task->getEmail(), ENT_QUOTES) ?></p>
            <p>Дата: <?= htmlspecialchars($task->getDate(), ENT_QUOTES) ?></p>
            <p class="text light"><?= htmlspecialchars($task->getText(), ENT_QUOTES) ?></p>
        </div>
    <?php endforeach; ?>
</div>