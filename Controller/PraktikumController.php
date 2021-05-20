<?php
class PraktikumController
{
    private $model;

    /**
     * Function ini adalah constructor yang berguna menginisialisasi obyek praktikum Model
     */

    public function __construct()
    {
        $this->model = new PraktikumModel();
    }

    /**
     * Function index berfungsi untuk mengatur tampilan awal
     */

    public function index()
    {
        $data = $this->model->get();
        extract($data);
        require_once("View/praktikum/index.php");
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

        if ($this->model->prosesStore($nama, $tahun)) {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Menambah Data");
        } else {
            header("location: index.php?page=praktikum&aksi=create&pesan=gagal Menambah Data");
        }
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

        if ($this->model->storeUpdate($nama, $tahun, $id)) {
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
        if ($this->model->prosesAktifkan($id)) {
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
        if ($this->model->prosesNonAktifkan($id)) {
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
        $data = $this->model->getById($id);
        extract($data);
        require_once("View/praktikum/edit.php");
    }
}
