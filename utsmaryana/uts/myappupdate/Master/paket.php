<?php

namespace Master;

use Config\Query_builder;

class paket
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('paket')->get()->resultArray();
        $res = ' <a href="?target=paket&act=tambah_paket" class="btn btn-info btn-sm">Tambah paket</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>paket_biasa</th>
                    <th>paket_plus</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($datapaket as $r) {
            $res .= '<tr>
                    <td width="10">' . $no . '</td>
                    <td width="250">' . $r['paket_biasa'] . '</td>
                    <td>' . $r['paket_plus'] . '</td>
                    <td width="150">
                        <a href="?target=paket&act=edit_paket&id=' . $r['paket_biasa'] . '" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <a href="?target=paket&act=delete_paket&id=' . $r['paket_biasa'] . '" class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>
                </tr>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }

    public function tambah()
    {
        $res = '<a href="?target=paket" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=paket&act=simpan_paket" method="post">
                    <div class="mb-3">
                        <label for="paket_biasa" class="form-label">paket_biasa</label>
                        <input type="text" class="form-control" id="paket_biasa" name="paket_biasa">
                    </div>
                    <div class="mb-3">
                        <label for="paket_plus" class="form-label">paket_plus</label>
                        <input type="text" class="form-control" id="paket_plus" name="paket_plus">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }

    public function simpan()
    {
        $paket_biasa = $_POST['paket_biasa'];
        $paket_plus = $_POST['paket_plus'];

        $data = array(
            'paket_biasa' => $paket_biasa,
            'paket_plus' => $paket_plus,
        );
        return $this->db->table('paket')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('paket')->where("paket_biasa='$id'")->get()->rowArray();

        $res = '<a href="?target=paket" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=paket&act=update_paket" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['paket_biasa'] . '">
                    <div class="mb-3">
                        <label for="paket_biasa" class="form-label">paket_biasa</label>
                        <input type="text" class="form-control" id="paket_biasa" name="paket_biasa" value="' . $r['paket_biasa'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="paket_plus" class="form-label">paket_plus</label>
                        <input type="text" class="form-control" id="paket_plus" name="paket_plus" value="' . $r['paket_plus'] . '">
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>';
        return $res;
    }

    public function cekRadio($val1, $val2)
    {
        if ($val1 == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $paket_biasa = $_POST['paket_biasa'];
        $paket_plus = $_POST['paket_plus'];

        $data = array(
            'paket_biasa' => $paket_biasa,
            'paket_plus' => $paket_plus,
        );

        return $this->db->table('paket')->where("paket_biasa='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('paket')->where("paket_biasa='$id'")->delete();
    }
}
