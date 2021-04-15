<?php
class PraktikumModel
{
    /**
     * Function get berfungsi untuk mengambil seluruh data dari database
     */

     public function get(){
         $sql = "SELECT * FROM praktikum";
         $query = koneksi()->query($sql);
         $hasil = [];
         while($data = $query->fetch_assoc()){
             $hasil[] = $data;
         }
         return $hasil;
     }

     /**
      * Function index berfungsi untuk mengatur tampilan awal
      */

      public function index(){
          $data = $this->get();
          extract($data);
          require_once("View/praktikum/index.php");
      }
}