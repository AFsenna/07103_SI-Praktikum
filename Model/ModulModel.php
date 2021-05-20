<?php
class ModulModel
{
    /**
     * Function get berfungsi untuk mengambil seluruh data modul
     * Data berasal dari table modul
     */

    public function get()
    {
        $sql = "SELECT modul.id as id , 
        praktikum.nama as praktikum , 
        praktikum.status as status , 
        modul.nama as nama FROM modul
        JOIN praktikum ON modul.praktikum_id = praktikum.id
        WHERE praktikum.status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function prosesStore berfungsi untuk menambahkan data modul ke database
     * @param String modul berisi nama modul
     * @param String idPraktikum berisi id praktikum 
     */

    public function prosesStore($modul, $idPraktikum)
    {
        $sql = "INSERT INTO modul(nama,praktikum_id) VALUES ('$modul',$idPraktikum)";
        return koneksi()->query($sql);
    }

    /**
     * Function delete berfungsi untuk menghapus data modul dari database
     * @param Integer id berisi id modul
     */

    public function prosesDelete($id)
    {
        $sql = "DELETE FROM modul WHERE id = $id";
        return koneksi()->query($sql);
    }

    /**
     * Function get berfungsi untuk mengambil seluruh data praktikum yang aktif
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
     * Function getLastData berfungsi untuk mengambil data modul paling akhir
     */

    public function getLastData()
    {
        $sql = "SELECT modul.id AS id, modul.nama AS nama FROM modul
         JOIN praktikum ON modul.praktikum_id=praktikum.id
         WHERE praktikum.status = 1
         ORDER BY id DESC LIMIT 1";

        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }
}
