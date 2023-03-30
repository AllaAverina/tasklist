<main>
    <div class="form-wrapper">
        <a href="/" class="button light">⟵Назад</a>
        <h1>Новая задача</h1>
        <div class="message"><?= $message ?? '' ?></div>
        <form method="POST" action="/tasks/add" name="add-task" class="add-task">
            <label>Имя</label>
            <input type="text" name="username" class="input light" value="<?= htmlspecialchars((isset($task)) ? $task->getUsername() : '', ENT_QUOTES) ?>">
            <label>Email</label>
            <input type="email" name="email" class="input light" value="<?= htmlspecialchars((isset($task)) ? $task->getEmail() : '', ENT_QUOTES) ?>">
            <label>Текст задачи</label>
            <textarea name="text" class="text light border"><?= htmlspecialchars((isset($task)) ? $task->getText() : '', ENT_QUOTES) ?></textarea>
            <input type="submit" value="Добавить" class="button light border">
        </form>
    </div>
</main>