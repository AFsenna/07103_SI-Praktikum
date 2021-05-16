<?php
class AuthModel
{
    /** untuk mengatur tampilan awal */
    public function index()
    {
        require_once("View/auth/index.php");
    }

    /** untuk mengatur ke halaman login untuk aslab */
    public function login_aslab()
    {
        require_once("View/auth/login_aslab.php");
    }

    /** untuk mengatur ke halaman login untuk praktikan*/
    public function login_praktikan()
    {
        require_once("View/auth/login_praktikan.php");
    }

    /** untuk mengatur tampilan daftar */
    public function daftarPraktikan()
    {
        require_once("View/auth/daftar_praktikan.php");
    }

    public function prosesAuthAslab($npm, $password)
    {
        $sql = "SELECT * FROM aslab WHERE npm ='$npm' and password = '$password'";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    /** untuk authentication aslab*/
    public function authAslab()
    {
        $npm = $_POST['npm'];
        $password = $_POST['password'];
        $data = $this->prosesAuthAslab($npm, $password);

        if ($data) {
            $_SESSION['role'] = 'aslab';
            $_SESSION['aslab'] = $data;
            header("location: index.php?page=aslab&aksi=view&pesan=Berhasil Login");
        } else {
            header("location: index.php?page=auth&aksi=loginAslab&pesan=Password atau NPM salah !!");
        }
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

    /* Function authPraktikan untuk authentication praktikan */
    public function authPraktikan()
    {
        $npm = $_POST['npm'];
        $password = $_POST['password'];
        $data = $this->prosesAuthPraktikan($npm, $password);
        if ($data) {
            $_SESSION['role'] = 'praktikan';
            $_SESSION['praktikan'] = $data;
            header("location: index.php?page=praktikan&aksi=view&pesan=Berhasil Login");
        } else {
            header("location: index.php?page=auth&aksi=loginPraktikan&pesan=Password aatau NPM anda salah !!");
        }
    }

    public function logout()
    {
        session_destroy();
        header("location: index.php?page=auth&aksi=view&pesan=Berhasil Logout !!");
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

    /**
     * Function store berfungsi untuk memproses data untuk di tambahkan
     * Fungsi ini membutuhkan data nama,npm,password,notelp dengan metode http request POST
     */

    public function storePraktikan()
    {
        $nama = $_POST['nama'];
        $npm = $_POST['npm'];
        $no_hp = $_POST['no_hp'];
        $password = $_POST['password'];
        if ($this->prosesStorePraktikan($nama, $npm, $no_hp, $password)) {
            header("location: index.php?page=auth&aksi=view&pesan=Berhasil Daftar");
        } else {
            header("location: index.php?page=auth&aksi=daftar&pesan=Gagal Daftar");
        }
    }
}
