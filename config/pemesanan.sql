CREATE DATABASE IF NOT EXISTS futsal;
USE futsal;

DROP TABLE IF EXISTS pemesanan;
CREATE TABLE pemesanan (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nomorhp VARCHAR(20) NOT NULL,
    waktubermain VARCHAR(20) NOT NULL,
    tglpesan DATE NOT NULL,
    jam_mulai TIME NOT NULL,
    durasi INT NOT NULL,
    airmineral INT DEFAULT 0,
    diskon FLOAT DEFAULT 0,
    final INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contoh data
INSERT INTO pemesanan (nama, nomorhp, waktubermain, tglpesan, jam_mulai, durasi, airmineral, diskon, final) VALUES
('Januar', '081234567890', 'Pagi', '2024-07-18', '08:00:00', 4, 25000, 0.1, 460000);
