<?php
class AuthModel
{

    public function prosesAuthAslab($npm, $password)
    {
        $sql = "SELECT * FROM aslab WHERE npm ='$npm' and password = '$password'";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    /** 
     * untuk cek data dari database berdasarkan
     * @param String $npm berisi npm
     * @param String $password berisi password
     */

    public function prosesAuthPraktikan($npm, $password)
    {
        $sql = "SELECT * FROM praktikan WHERE npm='$npm' and password='$password'";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    /**
     * Function store berfungsi untuk menambahkan data ke database
     * @param String $nama berisi data nama
     * @param String $npm berisi data npm
     * @param String $no_hp berisi data nomor hp
     * @param String $password berisi data password
     */

    public function prosesStorePraktikan($nama, $npm, $no_hp, $password)
    {
        $sql = "INSERT INTO praktikan(nama,npm,nomor_hp,password)
         VALUE('$nama','$npm','$no_hp','$password')";
        return koneksi()->query($sql);
    }
}
