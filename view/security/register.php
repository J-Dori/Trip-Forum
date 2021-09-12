<h1>INSCRIPTION</h1>

<form action="?ctrl=security&action=register" method="post">
    <p>
        <input type="text" name="username" id="username" placeholder="Pseudo..." required>
    </p>
    <p>
        <input type="email" name="email" id="email" placeholder="E-mail..." required>
    </p>
    <p>
        <input type="password" name="password" id="password" placeholder="Mot de passe..." required>
    </p>
    <p>
        <input type="password" name="password_repeat" id="password_repeat" placeholder="Répétez le mot de passe..." required>
    </p>
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <p><input type="submit" value="Inscription"></p>
</form>
