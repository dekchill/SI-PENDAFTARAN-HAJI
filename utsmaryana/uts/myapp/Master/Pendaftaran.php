<?php

namespace Master;

use Config\Query_builder;

class pendaftaran
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        return $data = $this->db->table('pendaftaran')->get()->resultArray();
    }
}
