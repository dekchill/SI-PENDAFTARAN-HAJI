<?php

namespace Config;

//require "In_query.php";

class Query_builder implements Query
{
    private $v_db, $v_table, $v_select, $v_join, $v_where, $v_order_by, $v_query;

    public function _construct($dataKoneksi)
    {
        // print_r($dataKoneksi);
        $this->v_db = new \mysqli($dataKoneksi['host'], $dataKoneksi['user'], $dataKoneksi['password'], $dataKoneksi['dbname']);
    }
    public function table($table)
    {
        $this->v_table = $table;
        return $this;
    }
    public function select($select)
    {
        $this->v_select = $select;
        return $this;
    }
    public function join($join, $joinOn, $typeJoin)
    {
        $this->v_join = $typeJoin . "JOIN" . $join . $joinOn;
        // LEFT JOIN pengunjung on pengunjung.no = pengunjung.no
        return $this;
    }
    public function where($where)
    {
        if (is_array($where)) {
            $this->v_where = "WHERE";
            foreach ($where as $key => $value) {
                $this->v_where .= $key . " = " . $value;
                if ($key == array_key_last($where)) {
                    $this->v_where .= "";
                } else {
                    $this->v_where .= " AND ";
                }
            }
            // where kode = 1 and nama = A
        } else {
            $this->v_where = $where;
        }
        return $this;
    }
    public function orderBy($order, $type = null)
    {
        if ($type == null) {
            $this->v_order_by = " ORDER BY " . $order . " ASC ";
        } else {
            $this->v_order_by = " ORDER BY " . $order . " ". $type;
        }
        return $this;
    }
    public function get()
    {
        $this->v_query = " SELECT ";
        if (!empty($this->v_select)) {
            $this->v_query .= $this->v_select . " ";
        } else {
            $this->v_query .= " * ";
        }

        $this->v_query .= " FROM " . $this->v_table . " "; //select no, pendaftaran 

        if (!empty($this->v_join)) {
            $this->v_query .= $this->v_join . " ";
        }

        if (!empty($this->v_where)) {
            $this->v_query .= $this->v_where . " ";
        }

        if (!empty($this->v_order_by)) {
            $this->v_query .= $this->v_order_by . " "; //select * from pendaftaran where order_by no asc/ desc
        }

        return $this;
    }
    public function result()
    {

        $data = $this->v_db->query($this->v_query);
        $rows = array();
        while ($row = $data->fetch_object()) {
            $rows[] = $row;
        }
        return(object) $rows;
    }
    public function resultArray()
    {

        $data = $this->v_db->query($this->v_query);
        $rows = array();
        while ($row = $data->fetch_array()) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function row()
    {
    }
    public function rowArray()
    {
    }
}