<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ── Publik ──────────────────────────────────────────────────────────
$routes->get('/', 'Home::index');

// ── Autentikasi ─────────────────────────────────────────────────────
$routes->get('login', 'AuthController::showLogin');
$routes->post('login', 'AuthController::login');
$routes->get('register', 'AuthController::showRegister');
$routes->post('register', 'AuthController::register');
$routes->get('logout', 'AuthController::logout');

// ── Katalog publik (boleh tanpa login) ──────────────────────────────
$routes->get('katalog', 'KatalogController::index');
$routes->get('katalog/(:num)', 'KatalogController::detail/$1');

// ── Diskusi & Rating (lihat publik; tulis/hapus wajib login) ─────────
$routes->get('diskusi', 'DiskusiController::index');
$routes->post('diskusi/simpan', 'DiskusiController::simpan', ['filter' => 'auth']);
$routes->get('diskusi/hapus/(:num)', 'DiskusiController::hapus/$1', ['filter' => 'auth']);
$routes->get('diskusi/(:num)', 'DiskusiController::room/$1');

// ── Beranda / Home (publik, tampil setelah landing) ─────────────────
$routes->get('home', 'Home::beranda');

// ── Halaman institusional (publik) ──────────────────────────────────
$routes->get('visi-misi', 'PageController::visiMisi');
$routes->get('literasi', 'PageController::literasi');
$routes->get('kontak', 'PageController::kontak');

// ── Berita & Dokumen (publik) ───────────────────────────────────────
$routes->get('berita', 'BeritaController::index');
$routes->get('berita/file/(:num)', 'BeritaController::file/$1');
$routes->get('berita/(:segment)', 'BeritaController::detail/$1');

// ── Jurnal (publik; baca PDF wajib login) ───────────────────────────
$routes->get('jurnal', 'JurnalController::index');
$routes->get('jurnal/file/(:num)', 'JurnalController::file/$1', ['filter' => 'auth']);
$routes->get('jurnal/(:segment)', 'JurnalController::detail/$1');

// ── Area User (wajib login) ─────────────────────────────────────────
$routes->get('profil', 'UserController::profile', ['filter' => 'auth']);
$routes->post('profil', 'UserController::updateProfile', ['filter' => 'auth']);
$routes->post('pinjam/ajukan', 'PinjamController::ajukan', ['filter' => 'auth']);
$routes->post('pinjam/kembalikan', 'PinjamController::kembalikan', ['filter' => 'auth']);
$routes->get('pinjaman-saya', 'PinjamController::saya', ['filter' => 'auth']);
$routes->post('wishlist/toggle', 'WishlistController::toggle', ['filter' => 'auth']);
$routes->get('wishlist', 'WishlistController::saya', ['filter' => 'auth']);
$routes->get('baca/file/(:num)', 'BacaController::file/$1', ['filter' => 'auth']);
$routes->get('baca/(:num)', 'BacaController::index/$1', ['filter' => 'auth']);

// ── Area Admin (role admin) ─────────────────────────────────────────
$routes->group('', ['filter' => 'role:admin'], static function ($routes) {

    $routes->get('dashboard', 'DashboardController::index');

    // Pengajuan masuk (approve/tolak)
    $routes->get('pengajuan', 'PengajuanController::index');
    $routes->get('pengajuan/setujui/(:num)', 'PengajuanController::setujui/$1');
    $routes->get('pengajuan/tolak/(:num)', 'PengajuanController::tolak/$1');

    // Buku
    $routes->get('books', 'BookController::index');
    $routes->get('list/books', 'BookController::index');
    $routes->get('list/books/table', 'BookController::ajaxTable');
    $routes->get('ajax/create/book', 'BookController::ajaxCreate');
    $routes->get('ajax/edit/book/(:num)', 'BookController::ajaxEdit/$1');
    $routes->get('create/book', 'BookController::create');
    $routes->post('create/book', 'BookController::store');
    $routes->get('edit/book/(:num)', 'BookController::edit/$1');
    $routes->post('update/book/(:num)', 'BookController::update/$1');
    $routes->get('delete/book/(:num)', 'BookController::delete/$1');
    $routes->get('book/trash', 'BookController::trash');
    $routes->get('restore/book/(:num)', 'BookController::restore/$1');
    $routes->get('purge/book/(:num)', 'BookController::purge/$1');

    // Subjek / Genre (master)
    $routes->get('kelola/subjek', 'SubjekController::index');
    $routes->post('kelola/subjek/simpan', 'SubjekController::store');
    $routes->get('kelola/subjek/hapus/(:num)', 'SubjekController::delete/$1');

    // Member
    $routes->get('list/members', 'MemberController::index');
    $routes->get('list/members/table', 'MemberController::ajaxTable');
    $routes->get('ajax/create/member', 'MemberController::ajaxCreate');
    $routes->get('ajax/edit/member/(:num)', 'MemberController::ajaxEdit/$1');
    $routes->post('create/member', 'MemberController::store');
    $routes->post('update/member/(:num)', 'MemberController::update/$1');
    $routes->get('delete/member/(:num)', 'MemberController::delete/$1');
    $routes->get('list/members/trash', 'MemberController::trash');
    $routes->get('restore/member/(:num)', 'MemberController::restore/$1');
    $routes->get('delete-permanent/member/(:num)', 'MemberController::deletePermanent/$1');

    // Peminjaman
    $routes->get('list/peminjaman', 'PeminjamanController::index');
    $routes->get('list/peminjaman/table', 'PeminjamanController::ajaxTable');
    $routes->get('ajax/create/peminjaman', 'PeminjamanController::ajaxCreate');
    $routes->get('ajax/edit/peminjaman/(:num)', 'PeminjamanController::ajaxEdit/$1');
    $routes->post('create/peminjaman', 'PeminjamanController::store');
    $routes->post('update/peminjaman/(:num)', 'PeminjamanController::update/$1');
    $routes->get('delete/peminjaman/(:num)', 'PeminjamanController::delete/$1');

    // Berita & Dokumen (kelola)
    $routes->get('kelola/berita', 'BeritaController::kelola');
    $routes->get('kelola/berita/baru', 'BeritaController::create');
    $routes->post('kelola/berita/simpan', 'BeritaController::store');
    $routes->get('kelola/berita/edit/(:num)', 'BeritaController::edit/$1');
    $routes->post('kelola/berita/update/(:num)', 'BeritaController::update/$1');
    $routes->get('kelola/berita/hapus/(:num)', 'BeritaController::delete/$1');

    // Jurnal (kelola)
    $routes->get('kelola/jurnal', 'JurnalController::kelola');
    $routes->get('kelola/jurnal/baru', 'JurnalController::create');
    $routes->post('kelola/jurnal/simpan', 'JurnalController::store');
    $routes->get('kelola/jurnal/edit/(:num)', 'JurnalController::edit/$1');
    $routes->post('kelola/jurnal/update/(:num)', 'JurnalController::update/$1');
    $routes->get('kelola/jurnal/hapus/(:num)', 'JurnalController::delete/$1');

    // Pengaturan sirkulasi (denda & lama pinjam)
    $routes->get('kelola/pengaturan', 'PengaturanController::index');
    $routes->post('kelola/pengaturan', 'PengaturanController::update');

    // Pengembalian
    $routes->get('list/pengembalian', 'PengembalianController::index');
    $routes->get('list/pengembalian/table', 'PengembalianController::ajaxTable');
    $routes->get('ajax/create/pengembalian', 'PengembalianController::ajaxCreate');
    $routes->get('ajax/edit/pengembalian/(:num)', 'PengembalianController::ajaxEdit/$1');
    $routes->get('pengembalian/hapus/(:num)', 'PengembalianController::hapus/$1');
    $routes->get('pengembalian/lunas/(:num)', 'PengembalianController::tandaiLunas/$1');
    $routes->post('create/pengembalian', 'PengembalianController::simpanPengembalian');
});
