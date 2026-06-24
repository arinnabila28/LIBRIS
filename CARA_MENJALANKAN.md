# 📚 Cara Menjalankan Web "LIBRIS"

Halo! Ini panduan **super lengkap** buat menjalankan web perpustakaan **LIBRIS**
di laptop/komputer kamu, walaupun kamu belum pernah ngoding sama sekali.
Ikuti **urut dari atas ke bawah**, jangan dilompati. Santai aja, kira-kira 15–20 menit. 🙂

> Web ini dibuat pakai **PHP (CodeIgniter 4)** + **database MySQL**.
> Supaya bisa jalan, kita butuh aplikasi yang namanya **Laragon** (gratis) yang isinya
> sudah lengkap: PHP + MySQL + phpMyAdmin jadi satu. Tinggal pasang sekali.

---

## 🧰 ISTILAH SINGKAT (biar nggak bingung)
- **Laragon** = aplikasi yang menyalakan "mesin" web di komputer kita.
- **Database** = tempat menyimpan data (daftar buku, anggota, dll). Kita pakai **MySQL**.
- **phpMyAdmin** = halaman buat mengatur database lewat klik-klik (nggak perlu ngetik kode).
- **Terminal** = kotak hitam tempat mengetik perintah. Jangan takut, cuma copy-paste 1 baris.
- **localhost** = alamat web yang jalan di komputer sendiri (bukan internet).

---

## ✅ LANGKAH 1 — Pasang Laragon (sekali aja)

1. Buka browser, pergi ke: **https://laragon.org/download/**
2. Klik **Download Laragon - Full** (yang versi Full, supaya lengkap).
3. Buka file yang ter-download, klik **Next → Next → Install** sampai selesai
   (biarkan semua pengaturan default, nggak usah diubah).
4. Setelah selesai, buka aplikasi **Laragon**.
5. Klik tombol **"Start All"** (warna biru, di pojok kanan bawah jendela Laragon).
   - Kalau muncul jendela izin Windows Firewall → klik **Allow / Izinkan**.
   - Kalau berhasil, tombolnya berubah jadi **"Stop All"** dan ada tulisan **Apache** & **MySQL** menyala. ✔️

> 💡 Kalau kamu sudah punya **XAMPP**, sebenarnya juga bisa, tapi **Laragon lebih gampang**.
> Saran saya pakai Laragon biar nggak ribet.

---

## ✅ LANGKAH 2 — Taruh folder proyek di tempat yang benar

1. **Extract** file ini (kalau masih berbentuk `.zip`, klik kanan → **Extract All**).
2. Setelah di-extract, kamu akan punya folder bernama **`DAMNPAP-main`**.
3. **Pindahkan / copy** folder `DAMNPAP-main` itu ke dalam folder:
   ```
   C:\laragon\www
   ```
   Jadi hasil akhirnya kira-kira: `C:\laragon\www\DAMNPAP-main`
   (Folder `www` ini tempat khusus Laragon menyimpan proyek web.)

---

## ✅ LANGKAH 3 — Membuat database & memasukkan datanya

Di sini kita buat "wadah" database lalu mengisinya dengan data yang sudah saya siapkan
di file **`database/ci4.sql`**.

1. Pastikan Laragon masih menyala (Langkah 1 nomor 5).
2. Di jendela Laragon, klik tombol **"Database"** (atau klik **Menu → MySQL → phpMyAdmin**).
   Browser akan terbuka ke halaman **phpMyAdmin**.
   - Kalau diminta login: **Username = `root`**, **Password dikosongkan**, lalu klik **Go**.
3. **Buat database baru:**
   - Di sisi kiri, klik **"New"** (atau "Baru").
   - Ketik nama database persis: **`ci4`** (huruf kecil semua).
   - Klik **Create / Buat**.
4. **Masukkan datanya:**
   - Klik database **`ci4`** yang baru dibuat (di daftar sebelah kiri).
   - Klik tab **"Import"** di bagian atas.
   - Klik **"Choose File / Pilih File"**, lalu arahkan ke file:
     `C:\laragon\www\DAMNPAP-main\database\ci4.sql`
   - Scroll ke bawah, klik tombol **"Import / Go"**.
   - Tunggu sampai muncul tulisan hijau **"berhasil / successful"**. ✔️

> Sekarang database sudah berisi data contoh (buku, anggota, akun login, dll).

---

## ✅ LANGKAH 4 — Cek pengaturan (biasanya sudah benar)

Biasanya **nggak perlu diubah** kalau pakai Laragon. Tapi kalau nanti ada error database,
cek file ini:

1. Buka folder `C:\laragon\www\DAMNPAP-main`.
2. Cari file bernama **`.env`** (tanpa nama, cuma titik-env).
3. Klik kanan file itu → **Open with / Buka dengan** → **Notepad**.
4. Pastikan baris-baris ini seperti di bawah (Laragon default password-nya kosong):
   ```
   database.default.database = ci4
   database.default.username = root
   database.default.password =
   database.default.hostname = localhost
   ```
5. Kalau MySQL di komputermu pakai password, tulis password-nya setelah `password =`.
   Lalu **Save** (Ctrl+S). Kalau nggak ada yang diubah, tutup aja.

---

## ✅ LANGKAH 5 — Menyalakan webnya

1. Buka folder `C:\laragon\www\DAMNPAP-main`.
2. **Klik kanan di area kosong** di dalam folder itu → pilih **"Laragon Terminal"**
   (atau **"Open ... Terminal here"** / "Git Bash Here").
   → akan muncul **kotak hitam (terminal)**.

   > Kalau tidak ada pilihan "Laragon Terminal", buka aplikasi **Laragon → Menu → Terminal**,
   > lalu ketik: `cd C:\laragon\www\DAMNPAP-main` kemudian tekan **Enter**.

3. Di terminal itu, **ketik / copy-paste** baris berikut, lalu tekan **Enter**:
   ```
   php spark serve --port 8081
   ```
4. Kalau berhasil, akan muncul tulisan seperti:
   `CodeIgniter ... server started on http://localhost:8081`
5. **JANGAN tutup kotak hitam itu** selama kamu memakai webnya
   (kalau ditutup, webnya mati).

> ⚠️ **WAJIB pakai port 8081.** Jangan diganti angkanya. Web ini sudah diatur untuk
> alamat `http://localhost:8081`. Kalau pakai angka lain, beberapa tabel tidak akan muncul.

---

## ✅ LANGKAH 6 — Buka webnya & login

1. Buka browser (Chrome/Edge), ketik di kolom alamat:
   **http://localhost:8081**
   lalu tekan **Enter**.
2. Akan muncul **halaman pembuka (landing page)**. Klik tombolnya untuk masuk.
3. Untuk login, pakai akun berikut:

   | Mau jadi apa | Email                      | Password   |
   |--------------|----------------------------|------------|
   | **Admin**    | `admin@cybershelf.test`    | `admin123` |
   | **User biasa** | Daftar sendiri lewat tombol **Register / Daftar** | (buat sendiri) |

   - **Admin** → masuk ke **Dashboard** (bisa kelola buku, anggota, peminjaman).
   - **User** → bisa lihat katalog, simpan wishlist, pinjam buku, ikut diskusi & kasih rating.

🎉 **Selesai! Webnya sudah jalan.**

---

## 🔁 Cara menjalankan lagi di lain waktu
Kalau besok mau buka lagi, cukup:
1. Buka **Laragon** → klik **"Start All"**.
2. Buka terminal di folder `DAMNPAP-main` (Langkah 5 no. 2).
3. Ketik lagi: `php spark serve --port 8081`
4. Buka `http://localhost:8081`.

Untuk **mematikan**: tutup kotak hitam (terminal), lalu di Laragon klik **"Stop All"**.

---

## 🆘 KALAU ADA MASALAH (Troubleshooting)

**1. Di terminal muncul: `php is not recognized` / `'php' bukan perintah...`**
→ Berarti terminalnya bukan dari Laragon. Tutup, lalu buka **Laragon → Menu → Terminal**,
ketik `cd C:\laragon\www\DAMNPAP-main`, baru jalankan `php spark serve --port 8081`.

**2. Muncul error database / "Unable to connect to database"**
→ Pastikan di Laragon **MySQL menyala** (tombol "Start All" sudah ditekan).
→ Pastikan sudah bikin database `ci4` dan import `ci4.sql` (Langkah 3).
→ Cek lagi file `.env` (Langkah 4).

**3. Halaman tampil tapi sebagian tabel/data kosong**
→ Hampir pasti karena **port-nya bukan 8081**. Tutup terminal, jalankan ulang dengan
`php spark serve --port 8081` (harus 8081).

**4. Muncul "Address already in use" / port 8081 dipakai**
→ Ada terminal lama yang masih jalan. Tutup semua kotak hitam, lalu jalankan lagi.

**5. Tombol "Laragon Terminal" tidak ada saat klik kanan**
→ Pakai cara alternatif: **Laragon → Menu → Terminal**, lalu
`cd C:\laragon\www\DAMNPAP-main` → Enter → jalankan perintahnya.

---

## ℹ️ Sekilas isi proyek (buat yang penasaran)
- `app/` — kode utama buatan kami (logika web, halaman, dll).
- `public/` — bagian yang tampil di browser (gambar, ikon, tema dashboard).
- `database/ci4.sql` — data yang kita import tadi.
- `.env` — pengaturan koneksi database.

Kalau butuh bantuan, hubungi yang mengirim file ini ya. Selamat mencoba! ✨
