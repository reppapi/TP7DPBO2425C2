<?php include __DIR__ . '/header.php'; ?>

<h2>Kelola Mood</h2>

<form action="index.php?page=moods&action=create" method="POST">
    <p>
        <label>Nama Mood:</label><br>
        <input type="text" name="mood_name" placeholder="Contoh: Senang, Sedih..." required>
    </p>
    <p>
        <label>Warna Mood (Klik kotak untuk ganti warna):</label><br>
        <input type="color" name="mood_color" value="#3b82f6" style="cursor: pointer;" title="Klik di sini untuk memilih warna mood">
    </p>
    <p>
        <button type="submit">Tambah Mood</button>
    </p>
</form>

<hr>

<h3>Daftar Mood</h3>
<table border="0" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Nama Mood</th>
            <th>Warna</th>
            <th style="text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($moods)): ?>
            <?php foreach ($moods as $m): ?>
            <tr>
                <td><strong><?= htmlspecialchars($m['mood_name']) ?></strong></td>
                <td>
                    <div style="width: 30px; height: 30px; background:<?= htmlspecialchars($m['mood_color']) ?>; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 0 5px rgba(0,0,0,0.2);"></div>
                </td>
                <td style="text-align: center;">
                    <a href="index.php?page=moods&action=edit&id=<?= $m['mood_id'] ?>">Edit</a>
                    <a href="index.php?page=moods&action=delete&id=<?= $m['mood_id'] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3" style="text-align: center; padding: 30px; opacity: 0.7;">Belum ada data mood.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include __DIR__ . '/footer.php'; ?>