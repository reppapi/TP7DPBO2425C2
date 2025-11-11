<?php include __DIR__ . '/header.php'; ?>

<h2>Login User</h2>

<?php if (isset($error_message)): ?>
    <div class="alert">
         <?= $error_message ?>
    </div>
<?php endif; ?>

<?php if (isset($success_message)): ?>
    <div class="alert success-alert">
         <?= $success_message ?>
    </div>
<?php endif; ?>

<form action="index.php?page=users&action=login" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required>

    <label>Password:</label><br>
    <input type="password" name="password" required>

    <button type="submit">Masuk</button>
    <p style="text-align: center; margin-top: 20px;">
        Belum punya akun? <a href="index.php?page=users&action=showRegister" style="display: inline;">Daftar di sini</a>
    </p>
</form>

<?php include __DIR__ . '/footer.php'; ?>