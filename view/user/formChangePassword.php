<h1>CHANGE PASSWORD</h1>

<form action="?ctrl=security&action=changePassword" method="post">
    <p>
        <input type="password" name="password" id="password" placeholder="Actual password " required>
    </p>
    <p>
        <input type="password" name="password_new" id="password_new" placeholder="New password" required>
    </p>
    <p>
        <input type="password" name="password_repeat" id="password_repeat" placeholder="Repeat new password" required>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    </p>
    
    <p><input type="button" value="Cancel"></p>
    <p><input type="submit" value="Save changes"></p>
</form>