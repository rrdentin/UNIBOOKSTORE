<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $timestamp = now(); // Ambil timestamp saat ini

        DB::table('penerbits')->insert([
            [
                'id_penerbit' => 'SP01',
                'nama' => 'Penerbit Informatika',
                'alamat' => 'Jl. Buah Batu No. 121',
                'kota' => 'Bandung',
                'telepon' => '0813-2220-1946',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_penerbit' => 'SP02',
                'nama' => 'Andi Offset',
                'alamat' => 'Jl. Suryalaya IX No.3',
                'kota' => 'Bandung',
                'telepon' => '0878-3903-0688',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_penerbit' => 'SP03',
                'nama' => 'Danendra',
                'alamat' => 'Jl Moch. Toha 44',
                'kota' => 'Bandung',
                'telepon' => '022-5201215',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ]);

        DB::table('bukus')->insert([
            [
                'id_buku' => 'K1001',
                'kategori' => 'Keilmuan',
                'nama_buku' => 'Analisis & Perancangan Sistem Informasi',
                'harga' => 50000,
                'stok' => 60,
                'id_penerbit' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_buku' => 'K1002',
                'kategori' => 'Keilmuan',
                'nama_buku' => 'Artificial Intelligence',
                'harga' => 45000,
                'stok' => 60,
                'id_penerbit' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_buku' => 'K2003',
                'kategori' => 'Keilmuan',
                'nama_buku' => 'Autocad 3 Dimensi',
                'harga' => 40000,
                'stok' => 25,
                'id_penerbit' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_buku' => 'B1001',
                'kategori' => 'Bisnis',
                'nama_buku' => 'Bisnis Online',
                'harga' => 75000,
                'stok' => 9,
                'id_penerbit' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_buku' => 'K3004',
                'kategori' => 'Keilmuan',
                'nama_buku' => 'Cloud Computing Technology',
                'harga' => 85000,
                'stok' => 15,
                'id_penerbit' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_buku' => 'B1002',
                'kategori' => 'Bisnis',
                'nama_buku' => 'Etika Bisnis dan Tanggung Jawab Sosial',
                'harga' => 67500,
                'stok' => 20,
                'id_penerbit' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_buku' => 'N1001',
                'kategori' => 'Novel',
                'nama_buku' => 'Cahaya Di Penjuru Hati',
                'harga' => 68000,
                'stok' => 10,
                'id_penerbit' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id_buku' => 'N1002',
                'kategori' => 'Novel',
                'nama_buku' => 'Aku Ingin Cerita',
                'harga' => 48000,
                'stok' => 12,
                'id_penerbit' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ]);
    }
}
