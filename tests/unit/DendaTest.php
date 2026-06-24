<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;

/**
 * Uji rumus denda keterlambatan (lib_hitung_denda).
 * Tarif diberikan eksplisit agar tes tidak bergantung pada database.
 */
final class DendaTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        helper('lib');
    }

    public function testKembaliSebelumJatuhTempoTidakKenaDenda(): void
    {
        $this->assertSame(0, lib_hitung_denda('2026-06-20', '2026-06-18', 1000));
    }

    public function testKembaliTepatHariJatuhTempoTidakKenaDenda(): void
    {
        $this->assertSame(0, lib_hitung_denda('2026-06-20', '2026-06-20', 1000));
    }

    public function testTelatSatuHari(): void
    {
        $this->assertSame(1000, lib_hitung_denda('2026-06-20', '2026-06-21', 1000));
    }

    public function testTelatTigaHari(): void
    {
        $this->assertSame(3000, lib_hitung_denda('2026-06-20', '2026-06-23', 1000));
    }

    public function testTarifBerbeda(): void
    {
        // telat 5 hari × Rp2.000
        $this->assertSame(10000, lib_hitung_denda('2026-06-20', '2026-06-25', 2000));
    }

    public function testTanggalKembaliKosongTidakKenaDenda(): void
    {
        $this->assertSame(0, lib_hitung_denda(null, '2026-06-25', 1000));
    }
}
