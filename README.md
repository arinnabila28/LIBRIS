# LIBRIS — Perpustakaan Digital

> Aplikasi perpustakaan (CodeIgniter 4) — dulu **"Cyber Shelf"**, sudah **di-rebrand total** jadi **LIBRIS**: premium, minimalis, tenang (vibe Apple / Linear / Raycast). Hijau hutan + cream, font Geist.

Dokumen ini = **konteks handoff** untuk melanjutkan kerja di sesi baru.

---

## 1. Status singkat

- ✅ **Rebrand LIBRIS SELESAI** — sisi **publik** + **admin**.
- ✅ **Backend / business logic NOL diubah** — yang dirombak murni lapisan UI/UX (view + CSS + branding).
- Semua halaman sudah diverifikasi render (lint PHP bersih + cek DOM + HTTP 200 di `localhost:8081`).

---

## 2. Menjalankan (Windows / Laragon)

```powershell
# dari root project
C:\laragon\bin\php\php-8.4.12-Win32-vs17-x64\php.exe spark serve --port 8081
```

- Wajib **port 8081** — `app.baseURL` di `.env` terkunci ke `http://localhost:8081/`.
- Butuh **MySQL** (Laragon) dengan database **`ci4`** (lihat `database/ci4.sql`).
- Buka: **http://localhost:8081**

> Ada `.claude/launch.json` (config preview, name `libris`, `autoPort:false`) untuk tooling.

**Login admin:** `admin@cybershelf.test` / `admin123`
> ⚠️ Email `admin@cybershelf.test` itu **kredensial login** (ada di DB + seeder) — **jangan diganti**, bukan branding. Pengguna biasa bisa daftar sendiri lewat `/register`.

**Catatan teknis penting:**
- **CSRF dinonaktifkan** global (form pakai `csrf_field()` tapi token tidak divalidasi).
- Admin masih pakai **AdminLTE + Bootstrap + jQuery** (struktur & JS-nya dipertahankan: collapse sidebar, AJAX tabel, modal) — hanya **CSS-nya yang di-override total** jadi LIBRIS.

---

## 3. Tech stack

| | |
|---|---|
| Framework | CodeIgniter 4.7 · PHP 8.4 |
| DB | MySQL (db `ci4`) |
| Auth | Custom session auth (bukan Shield). Filter `auth` + `role:admin`. 2 role: `admin`, `user` |
| Icons | Tabler Icons (lokal `public/assets/tabler/`) + Font Awesome (admin, via AdminLTE) |
| Fonts | **Geist** + **Geist Mono** (Google Fonts) |
| Admin UI | AdminLTE (struktur/JS) + override CSS LIBRIS |
| Chart | Chart.js 4 (CDN) di dashboard |

---

## 4. Design System "LIBRIS"

**Warna** (eksak, dari design system milik user):

| Token | Hex |
|---|---|
| Forest (primary) | `#224B29` |
| Accent / hover | `#2F6B3C` |
| Tint (fill lembut) | `#EAF1E9` |
| Paper (bg) | `#FAFAF8` |
| Surface (card) | `#FFFFFF` |
| Ink (teks) | `#18241B` |
| Muted (teks sekunder) | `#6B7280` |
| Border | `#ECECEC` |
| Amber (warning/denda) | `#8A5A1A` / bg `#F3EAD6` |

- **Tidak ada biru.** Hijau = satu-satunya aksen. Gradient hanya glow hijau tipis.
- **Tipografi:** Geist (UI/heading, tracking heading `-.02em`), Geist Mono (angka/label/metadata uppercase). Tanpa serif.
- **Radius:** 9–18px. **Shadow:** lembut berlapis (`0 1px 3px`, `0 8px 24px`, `0 20px 48px` dgn alpha rendah). **Spacing:** kelipatan 4px, whitespace lega. **Motion:** 140–240ms `cubic-bezier(.2,.6,.2,1)`, hover lift + shadow.
- **Container** konten max-width **1280px**, navbar disejajarkan ke container yg sama.
- **Sampul buku:** pakai gambar asli (`public/uploads/covers/`) kalau ada; kalau tidak → **fallback sampul terdesain** (warna tonal di-cycle dari `id_book`, judul+penulis di-typeset). Tonal: `#244B29 #2A2A28 #3a7d4a #C9B79A #1d3b24 #D7E0CE #ECE7DA`.
- **Rating:** bintang hijau (Tabler `ti-star` / `ti-star-filled`), helper inline `libStars()`.

**Logo = "Aperture"** (mark abstrak: 6 garis membentuk iris/lensa). Aset di `public/assets/`:
`libris-mark.svg` (forest) · `libris-mark-reversed.svg` (cream) · `libris-mark-ink.svg` · `libris-icon.svg` (app-icon) · `libris-lockup.svg` · `libris-favicon.png`.
Di navbar dirender sebagai **inline SVG** (symbol `#ap-mark`) biar tajam & ikut `currentColor`.

---

## 5. Struktur view (yang sudah jadi LIBRIS)

**Publik** — extend `app/Views/layouts/public_template.php` (design system + navbar mark Aperture + footer + `showToast` + ⌘K→katalog):
- `landing page/index.php` — hero coded + dinding sampul (ganti gambar Canva lama)
- `home/index.php` — "Buku Pekan Ini" (focal) + grid + strip koleksi
- `katalog/index.php` — filter rail + focal "paling dicari" + grid
- `katalog/detail.php` — cover + aksi (baca/pinjam/wishlist/share) + bibliografi + ulasan + serupa
- `diskusi/index.php` (feed) · `diskusi/room.php` (thread + ringkasan rating + distribusi)
- `user/wishlist.php` · `user/pinjaman_saya.php` · `user/profile.php` — pakai tab bar **"Perpustakaan Saya"** (`.mylib-tabs`). *Belum digabung jadi satu route — masih 3 halaman terpisah.*
- `baca/read.php` — reader distraction-free (standalone)
- `auth/login.php` · `auth/register.php` — single-column tenang (standalone)

**Admin** — extend `app/Views/layouts/template.php` (struktur AdminLTE):
- `layouts/partials/head.php` — **token LIBRIS + override CSS semua komponen AdminLTE/Bootstrap** (card/table/btn/form/modal/badge/sidebar/navbar). Kunci di sini.
- `layouts/partials/sidebar.php` — sidebar ramping putih + mark Aperture
- `layouts/partials/navbar.php` — topbar + command pill ⌘K + avatar dropdown
- `layouts/partials/footer.php` — LIBRIS
- `dashboard.php` — greeting + 4 KPI cards + Chart.js area hijau + jatuh tempo + aktivitas
- CRUD: `books/` `members/` `peminjaman/` `pengembalian/` `pengajuan/` — **markup tidak disentuh**, ikut LIBRIS via cascade `head.php` (AJAX tabel + modal tetap jalan).

> `app/Views/partials/hearts.php` & `app/Views/user/home.php` = **orphan** (tidak dipakai route aktif). Bisa diabaikan/dihapus.

---

## 6. Gotchas / hal yang perlu diingat

- **baseURL terkunci 8081** → asset (Tabler/favicon) pakai `base_url()` absolut; serve di port lain → asset 404.
- **Icon-font fix:** jangan pernah set `font-family` di selector universal `*::before/*::after` — itu menimpa glyph Tabler/FontAwesome jadi kotak. Set di `body`/list elemen saja.
- **Alias legacy** di `head.php` (`--y2k-*`, `--green`, dll.) sengaja dipetakan ke nilai LIBRIS supaya `var()` sisa di halaman lama tetap resolve. Aman dihapus pelan-pelan saat markup-nya dirapikan.
- Tabel admin **dimuat via AJAX** (`$('#viewDataTabel').load('list/books/table')`), modal create/edit via AJAX → Bootstrap modal. Jangan buang jQuery/AdminLTE JS (`layouts/partials/script.php`).

---

## 7. Sisa / ide lanjutan (belum dikerjakan)

- **Fitur Jurnal (Google Scholar)** — diminta dosen, masih *parked*. Opsi: redirect ke `scholar.google.com/scholar?q=` (cepat) **atau** CrossRef/DOAJ API (lebih proper). Belum diputuskan.
- **Gabung "Perpustakaan Saya"** jadi satu route bertab (sekarang 3 halaman terpisah — butuh sedikit kerja controller).
- **Continue reading / progress** di Home (perlu data progress baca; sekarang belum ada).
- **Command palette ⌘K admin** masih dekoratif (belum ada backend search admin).
- **`writable/uploads/books/sample.pdf`** — placeholder PDF isinya masih teks "Cyber Shelf" (regenerate berisiko korupsi xref; biarkan, admin upload PDF asli).
- **`CARA_MENJALANKAN.md`** — panduan setup lama (untuk teman non-IT, vibe tema lama). Tidak dipakai app.

---

## 8. Verifikasi cepat (smoke test)

```powershell
# lint satu file
C:\laragon\bin\php\php-8.4.12-Win32-vs17-x64\php.exe -l app\Views\home\index.php
```
Cek manual di browser: `/` (landing) · `/home` · `/katalog` · `/katalog/1` · `/diskusi` · `/login` · `/dashboard` (admin).
