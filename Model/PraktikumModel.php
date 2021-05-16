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
     * Function index berfungsi untuk mengatur tampilan awal
     */

    public function index()
    {
        $data = $this->get();
        extract($data);
        require_once("View/praktikum/index.php");
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
     * Function create berfungsi untuk mengatur tampilan tambah data
     */

    public function create()
    {
        require_once("View/praktikum/create.php");
    }

    /**
     * Function store berfungsi untuk memproses data untuk di tambahkan
     * Fungsi ini membutuhkan data nama,npm,email,dengan metode http request POST
     */

    public function store()
    {
        $nama = $_POST['nama'];
        $tahun = $_POST['tahun'];

        if ($this->prosesStore($nama, $tahun)) {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Menambah Data");
        } else {
            header("location: index.php?page=praktikum&aksi=create&pesan=gagal Menambah Data");
        }
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

    /**
     * Function update berfungsi untuk memproses data untuk di update
     * Fungsi ini membutuhkan data nama,tahun dengan metode http request POST
     */

    public function update()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $tahun = $_POST['tahun'];

        if ($this->storeUpdate($nama, $tahun, $id)) {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Mengubah Data");
        } else {
            header("location: index.php?page=praktikum&aksi=edit&pesan=Gagal Mengubah Data&id=$id");
        }
    }

    /**
     * Function aktifkan berfungsi untuk memproses update salah satu field data
     * Function ini membutuhkan data $id dengan metode http request GET
     */

    public function aktifkan()
    {
        $id = $_GET['id'];
        if ($this->prosesAktifkan($id)) {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Mengaktifkan Data");
        } else {
            header("location: index.php?page=praktikum&aksi=view&pesan=Gagal Mengaktifkan Data&id=$id");
        }
    }

    /**
     * Function nonaktifkan berfungsi untuk memproses update salah satu field data
     * Function ini membutuhkan data id dengan metode http request GET
     */

    public function nonAktifkan()
    {
        $id = $_GET['id'];
        if ($this->prosesNonAktifkan($id)) {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil non-Aktifkan Data");
        } else {
            header("location: index.php?page=praktikum&aksi=view&pesan=Gagal Mengaktifkan Data&id=$id");
        }
    }

    /**
     * function ini berfungsi untuk menampilkan halaman edit
     * juga mengambil salah satu data dari database berdasarkan id
     * function membutuhkan data id dengan metode http request GET
     */

    public function edit()
    {
        $id = $_GET['id'];
        $data = $this->getById($id);
        extract($data);
        require_once("View/praktikum/edit.php");
    }
}
