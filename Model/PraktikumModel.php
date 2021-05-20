<?php
class PraktikumModel
{
    /**
     * Function get berfungsi untuk mengambil seluruh data dari database
     * data yang diambil berasal dari table praktikum
     */

    public function get()
    {
        $sql = "SELECT * FROM praktikum";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function prosesStore berfungsi untuk input data praktikum
     * @param String $nama berisi nama praktikum
     * @param String $tahun berisi nama praktikum
     */

    public function prosesStore($nama, $tahun)
    {
        $sql = "INSERT INTO praktikum(nama,tahun) VALUES('$nama','$tahun')";
        return koneksi()->query($sql);
    }

    /**
     * Function update berfungsi untuk mengubah data di database
     * @param String $nama berisi data nama
     * @param String $tahun berisi data tahun
     * @param Integer $id berisi id dari suatu data di database
     */

    public function storeUpdate($nama, $tahun, $id)
    {
        $sql = "UPDATE praktikum SET nama='$nama',tahun='$tahun' WHERE id=$id";
        return koneksi()->query($sql);
    }


    /**
     * Function Aktifkan ini untuk merubah salah satu field di database
     * @param Integer $id berisi id dari suatu data di database
     */

    public function prosesAktifkan($id)
    {
        koneksi()->query(("UPDATE praktikum SET status=0"));
        //merubah status praktikum ysng aktif menjadi tidak aktif
        $sql = "UPDATE praktikum SET status=1 WHERE id = $id";
        return koneksi()->query($sql);
    }

    /**
     * Function nonAktifkan ini untuk merubah salah satu field di database
     * @param Integer $id berisi id dari suatu data di database
     */

    public function prosesNonAktifkan($id)
    {
        $sql = "UPDATE praktikum SET status=0 WHERE id = $id";
        return koneksi()->query($sql);
    }

    /**
     * Function getById berfungsi untuk mengambil satu data dari database
     * @param Integer $id berisi id dari suatu data di database
     */

    public function getById($id)
    {
        $sql = "SELECT * FROM praktikum WHERE id = $id";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }
}
