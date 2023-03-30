<a href="/admin/logout" class="button dark logout">Выйти</a>
<div class="container">
    <?php foreach ($tasks as $task) : ?>
        <div class="task dark">
            <a href="/tasks/<?= $task->getId() ?>/delete" class="button light delete">Удалить</a>
            <p>Создал(-а): <?= htmlspecialchars($task->getUsername(), ENT_QUOTES) ?></p>
            <p>Email: <?= htmlspecialchars($task->getEmail(), ENT_QUOTES) ?></p>
            <p>Дата: <?= htmlspecialchars($task->getDate(), ENT_QUOTES) ?></p>
            <form method="POST" action="/tasks/<?= $task->getId() ?>/edit">
                <input type="hidden" name="status" value="0">
                <?php if ($task->getStatus() == true) : ?>
                    <label style="color: #5e5">Статус: Выполнено
                        <input type="checkbox" name="status" checked>
                    </label>
                <?php else : ?>
                    <label>Статус: Выполняется
                        <input type="checkbox" name="status" value="1">
                    </label>
                <?php endif; ?>
                <textarea name="text" class="text light"><?= htmlspecialchars($task->getText(), ENT_QUOTES) ?></textarea>
                <input type="submit" value="Сохранить" class="button light">
            </form>
        </div>
    <?php endforeach; ?>
</div>