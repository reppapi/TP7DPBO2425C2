<?php include __DIR__ . '/header.php'; ?>

<h2>Edit Mood Type</h2>

<form action="index.php?page=moods&action=update" method="POST">

    <input type="hidden" name="mood_id" value="<?= htmlspecialchars($mood['mood_id']) ?>">

    <p>
        <label>Nama Mood:</label><br>
        <input type="text" name="mood_name" value="<?= htmlspecialchars($mood['mood_name']) ?>" required>
    </p>

    <p>
        <label>Warna Mood (Klik kotak untuk ganti):</label><br>
        <input type="color" name="mood_color" value="<?= htmlspecialchars($mood['mood_color']) ?>" style="cursor: pointer;" title="Klik di sini untuk memilih warna mood">
    </p>

    <p>
        <button type="submit">Simpan Perubahan</button>
        <a href="index.php?page=moods" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none;">Batal</a>
    </p>
</form>

<?php include __DIR__ . '/footer.php'; ?>