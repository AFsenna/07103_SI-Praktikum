<?php

/**
 * Function koneksi digunakan untuk membuat koneksi ke database
 * dengan tablespace 'db_pendaftaranpraktikum'
 * @return new mysqli digunakan untuk mengembalikan nilai object pada file mysql
 */

function koneksi()
{
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_database = "db_pendaftaranpraktikum";
    try {
        return new mysqli($db_host, $db_user, $db_password, $db_database);
    } catch (Exception $e) {
        echo "Terjadi Kesalahan koneksi database";
    }
}
