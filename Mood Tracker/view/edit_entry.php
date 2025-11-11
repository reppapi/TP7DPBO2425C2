<?php include __DIR__ . '/header.php'; ?>

<h2>Edit Catatan Mood Harian</h2>

<form action="index.php?page=entries&action=update" method="POST">
    
    <input type="hidden" name="entry_id" value="<?= htmlspecialchars($entry['entry_id']) ?>">
    
    <p>
        <label>Tanggal:</label><br>
        <input type="date" name="entry_date" value="<?= htmlspecialchars($entry['entry_date']) ?>" required>
    </p>
    
    <p>
        <label>Mood:</label><br>
        <select name="mood_id" required>
            <option value="">-- Pilih Mood --</option>
            <?php foreach ($moods as $m): ?>
                <option value="<?= $m['mood_id'] ?>" <?= ($m['mood_id'] == $entry['mood_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($m['mood_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    
    <p>
        <label>Catatan:</label><br>
        <textarea name="note" rows="3" cols="50" placeholder="Tulis perasaan kamu hari ini..."><?= htmlspecialchars($entry['note']) ?></textarea>
    </p>

    <p>
        <button type="submit">Simpan Perubahan</button>
        <a href="index.php?page=entries">Batal</a>
    </p>
</form>

<?php include __DIR__ . '/footer.php'; ?>