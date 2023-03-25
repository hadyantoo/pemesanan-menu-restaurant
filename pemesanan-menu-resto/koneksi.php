<?php

class database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "restaurant";
    protected $koneksi;

    function __construct()
    {
        $this->koneksi = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->koneksi == false) die("tidak dapat tersambung ke database" . $this->koneksi->connect_error());
        return $this->koneksi;
    }
}
