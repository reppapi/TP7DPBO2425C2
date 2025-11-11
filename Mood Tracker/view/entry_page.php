<?php include __DIR__ . '/header.php'; ?>

<h2>Catatan Mood Harian</h2>

<form action="index.php?page=entries&action=create" method="POST">
    <p>
        <label>Tanggal:</label><br>
        <input type="date" name="entry_date" required>
    </p>
    <p>
        <label>Mood:</label><br>
        <select name="mood_id" required>
            <option value="">-- Pilih Mood --</option>
            <?php foreach ($moods as $m): ?>
                <option value="<?= $m['mood_id'] ?>"><?= htmlspecialchars($m['mood_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label>Catatan:</label><br>
        <textarea name="note" rows="3" placeholder="Tulis perasaan kamu hari ini..."></textarea>
    </p>
    <p>
        <button type="submit">Tambah Catatan</button>
    </p>
</form>

<hr>

<h3>Riwayat Catatan harian dan Mood Kamu</h3>
<table border="0" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 20%;">Tanggal</th>
            <th style="width: 15%;">Mood</th>
            <th>Catatan</th>
            <th style="width: 20%; text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($entries)): ?>
            <?php foreach ($entries as $e): ?>
            <tr>
                <td><strong><?= date('d M Y', strtotime($e['entry_date'])) ?></strong></td>
                <td>
                    <span style="background-color: <?= htmlspecialchars($e['mood_color']) ?>; color: #fff; padding: 6px 12px; border-radius: 20px; font-size: 0.85em; font-weight: bold; display: inline-block; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        <?= htmlspecialchars($e['mood_name']) ?>
                    </span>
                </td>
                <td style="line-height: 1.5;"><?= nl2br(htmlspecialchars($e['note'])) ?></td>
                <td style="text-align: center;">
                    <a href="index.php?page=entries&action=edit&id=<?= $e['entry_id'] ?>">Edit</a>
                    <a href="index.php?page=entries&action=delete&id=<?= $e['entry_id'] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4" style="text-align: center; padding: 30px; opacity: 0.7; font-style: italic;">Belum ada catatan mood saat ini.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include __DIR__ . '/footer.php'; ?>