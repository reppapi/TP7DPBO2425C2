<?php include __DIR__ . '/header.php'; ?>

<h2>Registrasi User Baru</h2>

<?php if (isset($error_message)): ?>
    <div class="alert">
        <?= $error_message ?>
    </div>
<?php endif; ?>

<form action="index.php?page=users&action=register" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required>

    <label>Email:</label><br>
    <input type="email" name="email" required>

    <label>Password:</label><br>
    <input type="password" name="password" required>

    <button type="submit">Daftar Sekarang</button>
    
    <a href="index.php?page=home">Batal</a>
</form>

<?php include __DIR__ . '/footer.php'; ?>