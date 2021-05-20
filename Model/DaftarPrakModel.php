<?php
class DaftarPrakModel
{
    /**
     * Function get berfungsi untuk mengambil seluruh data praktikan yang telah mendaftar praktikum
     */

    public function get()
    {
        $sql = "SELECT daftarprak.id as idDaftar,
         daftarprak.praktikan_id as idPraktikan,
         praktikan.nama as namaPraktikan,
         daftarprak.status as status, 
         praktikum.nama as namaPraktikum FROM daftarprak
         JOIN praktikan ON praktikan.id = daftarprak.praktikan_id
         JOIN praktikum ON praktikum.id = daftarprak.praktikum_id
         WHERE praktikum.status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * @param Integer id berisi id
     * @param Integer idAslab berisi id aslab
     * Function prosesVerif berfungsi unuk update status pada database menjadi telah diverifikasi
     */

    public function prosesVerif($id, $idAslab)
    {
        $sql = "UPDATE daftarprak SET status=1,aslab_id = $idAslab WHERE id = $id";
        $query = koneksi()->query($sql);
        return $query;
    }

    /**
     * @param Integer id berisi id
     * @param Integer idPraktikan berisi id praktikan
     * Function prosesUnVerif unuk membatalkan status verifikasi
     */

    public function prosesUnVerif($id, $idPraktikan)
    {
        $sqlDelete = "DELETE FROM nilai WHERE praktikan_id = $idPraktikan";
        koneksi()->query($sqlDelete);
        $sqlUpdate = "UPDATE daftarprak SET status=0, aslab_id = NULL WHERE id = $id";
        $query = koneksi()->query($sqlUpdate);
        return $query;
    }
}
