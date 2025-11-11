--
-- Struktur tabel untuk `users`
-- (Menyimpan data login pengguna)
--
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(120) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

--
-- Struktur tabel untuk `mood_types`
-- (Menyimpan pilihan master mood)
--
CREATE TABLE mood_types (
  mood_id INT AUTO_INCREMENT PRIMARY KEY,
  mood_name VARCHAR(50) NOT NULL,
  mood_color VARCHAR(7), -- hex color optional, contoh #F4A261
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

--
-- Struktur tabel untuk `mood_entries`
-- (Menyimpan catatan mood harian pengguna)
--
CREATE TABLE mood_entries (
  entry_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  mood_id INT NOT NULL,
  entry_date DATE NOT NULL,
  note TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  
  -- Foreign key
  CONSTRAINT fk_entry_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  CONSTRAINT fk_entry_mood FOREIGN KEY (mood_id) REFERENCES mood_types(mood_id) ON DELETE RESTRICT
);

--
-- Data Dummy untuk tabel `users`
-- (Membuat akun 'coba' dengan password '123456')
--
INSERT INTO 
    users (username, email, password) 
VALUES 
    ('coba', 'coba@example.com', '123456');

--
-- Data Dummy untuk tabel `mood_types`
--
INSERT INTO 
    mood_types (mood_name, mood_color) 
VALUES
    ('Senang', '#FFD700'),
    ('Sedih', '#1E90FF'),
    ('Marah', '#DC2626'),
    ('Tenang', '#34D399'),
    ('Biasa Saja', '#9CA3AF');

--
-- Data Dummy untuk tabel `mood_entries`
-- (Menggunakan user_id = 1 dari akun 'coba' dan mood_id dari atas)
--
INSERT INTO 
    mood_entries (user_id, mood_id, entry_date, note) 
VALUES
    (1, 1, '2025-11-10', 'Besok mau jajan eskrim yey!! seneng banget'),
    (1, 3, '2025-11-09', 'Pulpen aku dipinjem temen, ga di balik balikin'),
    (1, 5, '2025-11-08', 'Hari ini biasa aja, diam di rumah doang'),
    (1, 2, '2025-11-07', 'Gantungan kunci aku jatuh gatau di mana, sedihh :(');