<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $members = [
            ['name_member'=>'Budi Santoso',    'email_member'=>'budi.santoso@email.com',    'contact_member'=>'081234567801','status_member'=>'Aktif'],
            ['name_member'=>'Ani Rahayu',      'email_member'=>'ani.rahayu@email.com',      'contact_member'=>'081234567802','status_member'=>'Aktif'],
            ['name_member'=>'Rudi Hermawan',   'email_member'=>'rudi.hermawan@email.com',   'contact_member'=>'081234567803','status_member'=>'Aktif'],
            ['name_member'=>'Dewi Kusuma',     'email_member'=>'dewi.kusuma@email.com',     'contact_member'=>'081234567804','status_member'=>'Aktif'],
            ['name_member'=>'Siti Aminah',     'email_member'=>'siti.aminah@email.com',     'contact_member'=>'081234567805','status_member'=>'Aktif'],
            ['name_member'=>'Agus Pratama',    'email_member'=>'agus.pratama@email.com',    'contact_member'=>'081234567806','status_member'=>'Aktif'],
            ['name_member'=>'Rina Wulandari',  'email_member'=>'rina.wulandari@email.com',  'contact_member'=>'081234567807','status_member'=>'Aktif'],
            ['name_member'=>'Hendra Kurniawan','email_member'=>'hendra.kurniawan@email.com','contact_member'=>'081234567808','status_member'=>'Aktif'],
            ['name_member'=>'Maya Sari',       'email_member'=>'maya.sari@email.com',       'contact_member'=>'081234567809','status_member'=>'Aktif'],
            ['name_member'=>'Dian Permata',    'email_member'=>'dian.permata@email.com',    'contact_member'=>'081234567810','status_member'=>'Aktif'],
            ['name_member'=>'Fajar Nugroho',   'email_member'=>'fajar.nugroho@email.com',   'contact_member'=>'081234567811','status_member'=>'Aktif'],
            ['name_member'=>'Lestari Putri',   'email_member'=>'lestari.putri@email.com',   'contact_member'=>'081234567812','status_member'=>'Aktif'],
            ['name_member'=>'Wahyu Setiawan',  'email_member'=>'wahyu.setiawan@email.com',  'contact_member'=>'081234567813','status_member'=>'Aktif'],
            ['name_member'=>'Nita Anggraini',  'email_member'=>'nita.anggraini@email.com',  'contact_member'=>'081234567814','status_member'=>'Nonaktif'],
            ['name_member'=>'Bayu Adi',        'email_member'=>'bayu.adi@email.com',        'contact_member'=>'081234567815','status_member'=>'Aktif'],
        ];

        foreach ($members as $member) {
            $this->db->table('members')->insert(array_merge($member, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
