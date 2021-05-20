<?php
class PraktikanModel
{
    /**
     * Function get berfungsi untuk mengambil seluruh data praktikan
     * @param integer id berisi id praktikan
     */

    public function get($id)
    {
        $sql = "SELECT * FROM praktikan WHERE id = $id";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    /**
     * Function getPraktikum berfungsi untuk mengambil seluruh data praktikum yang aktif
     */

    public function getPraktikum()
    {
        $sql = "SELECT * FROM praktikum WHERE status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function getPendaftaranPraktikum berfungsi untuk mengambil data pendaftaran praktikum praktikan
     * @param integer idPraktikan berisi id praktikan
     */

    public function getPendaftaranPraktikum($idPraktikan)
    {
        $sql = "SELECT daftarprak.id as idDaftar,
             praktikum.nama as namaPraktikum,
             praktikum.id as idPraktikum,
             daftarprak.status as status FROM daftarprak
             JOIN praktikum on praktikum.id = daftarprak.praktikum_id
             WHERE daftarprak.praktikan_id = $idPraktikan";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function getmodul berfungsi untuk mengambil data modul dari praktikum yang aktif
     */

    public function getModul($idPraktikum)
    {
        $sql = "SELECT modul.id as idModul,
               modul.nama as namaModul FROM modul
               JOIN praktikum on praktikum.id = modul.praktikum_id
               WHERE modul.praktikum_id = $idPraktikum";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function getNilaiPraktikan berfungsi untuk mengambil data nilai praktikan di tiap" praktikum
     * @param integer idPraktikan berisi id praktikan
     * @param integer idPraktikum berisi id praktikum
     */

    public function getNilaiPraktikan($idPraktikan, $idPraktikum)
    {
        $sql = "SELECT * FROM nilai
                JOIN modul on modul.id = nilai.modul_id
                WHERE praktikan_id = $idPraktikan
                AND praktikum_id = $idPraktikum
                ORDER BY modul.id";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function update berfungsi untuk update data praktikan pada database
     * @param String $nama berisi nama praktikan
     * @param String $npm berisi npm praktikan
     * @param String $password berisi password praktikan
     * @param String $no_hp berisi nomor telp praktikan
     * @param Integer $id berisi id praktikan
     */

    public function prosesUpdate($nama, $npm, $password, $no_hp, $id)
    {
        $sql = "UPDATE praktikan 
         SET nama = '$nama', npm = '$npm', password = '$password', nomor_hp = '$no_hp'
         WHERE id = $id";
        $query = koneksi()->query($sql);
        return $query;
    }

    /**
     * Function storePraktikum berfungsi untuk input data daftar praktikum ke database
     * @param Integer $idPraktikan berisi id praktikan
     * @param Integer $idPraktikum berisi id praktikum
     */

    public function prosesStorePraktikum($idPraktikan, $idPraktikum)
    {
        $sql = "INSERT INTO daftarprak(praktikan_id,praktikum_id,status)
         VALUES($idPraktikan,$idPraktikum,0)";
        $query = koneksi()->query($sql);
        return $query;
    }
}
