<main>
    <div class="form-wrapper">
        <h1>Вход</h1>
        <div class="message"><?= $message ?? '' ?></div>
        <form method="POST" action="/admin" name="form-login">
            <label for="login">Логин</label>
            <input type="text" name="login" class="input light">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="input light">
            <input type="submit" value="Войти" class="button light border">
        </form>
    </div>
</main>