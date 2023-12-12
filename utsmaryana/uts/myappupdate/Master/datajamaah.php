<?php

namespace Master;

use Config\Query_builder;

class datajamaah
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('datajamaah')->get()->resultArray();
        $res = ' <a href="?target=datajamaah&act=tambah_datajamaah" class="btn btn-info btn-sm">Tambah datajamaah</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>id_jamaah</th>
                    <th>nama_jamaah</th>
                    <th>ttl_jamaah</th>
                    <th>alamat</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($datajamaah as $r) {
            $res .= '<tr>
                    <td width="10">' . $no . '</td>
                    <td width="250">' . $r['id_jamaah'] . '</td>
                    <td>' . $r['nama_jamaah'] . '</td>
                    <td width="200">' . $r['ttl_jamaah'] . '</td>
                    <td width="200">' . $r['alamat'] . '</td>
                    <td width="150">
                        <a href="?target=datajamaah&act=edit_datajamaah&id=' . $r['id_jamaah'] . '" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <a href="?target=datajamaah&act=delete_datajamaah&id=' . $r['id_jamaah'] . '" class="btn btn-danger btn-sm">
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
        $res = '<a href="?target=datajamaah" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=datajamaah&act=simpan_datajamaah" method="post">
                    <div class="mb-3">
                        <label for="id_jamaah" class="form-label">id_jamaah</label>
                        <input type="text" class="form-control" id="id_jamaah" name="id_jamaah">
                    </div>
                    <div class="mb-3">
                        <label for="nama_jamaah" class="form-label">nama_jamaah</label>
                        <input type="text" class="form-control" id="nama_jamaah" name="nama_jamaah">
                    </div>
                    <div class="mb-3">
                        <label for="ttl_jamaah" class="form-label">ttl_jamaah</label>
                        <label for="alamat" class="form-label">alamat</label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="ttl_jamaah" id="ttl_jamaah1" value="1">
                            <label for="ttl_jamaah1" class="form-check-label">
                            <input type="radio" class="form-check-input" name="alamat" id="alamat1" value="1">
                            <label for="alamat1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="ttl_jamaah" id="ttl_jamaah0" value="0">
                            <label for="ttl_jamaah0" class="form-check-label">
                            <input type="radio" class="form-check-input" name="alamat" id="alamat0" value="0">
                            <label for="alamat0" class="form-check-label">
                                P
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }

    public function simpan()
    {
        $id_jamaah = $_POST['id_jamaah'];
        $nama_jamaah = $_POST['nama_jamaah'];
        $ttl_jamaah = $_POST['ttl_jamaah'];
        $alamat = $_POST['alamat'];

        $data = array(
            'id_jamaah' => $id_jamaah,
            'nama_jamaah' => $nama_jamaah,
            'ttl_jamaah' => $ttl_jamaah,
            'alamat' => $alamat
        );
        return $this->db->table('datajamaah')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('datajamaah')->where("id_jamaah='$id'")->get()->rowArray();

        $res = '<a href="?target=datajamaah" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=datajamaah&act=update_datajamaah" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_jamaah'] . '">
                    <div class="mb-3">
                        <label for="id_jamaah" class="form-label">id_jamaah</label>
                        <input type="text" class="form-control" id="id_jamaah" name="id_jamaah" value="' . $r['id_jamaah'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="nama_jamaah" class="form-label">nama_jamaah</label>
                        <input type="text" class="form-control" id="nama_jamaah" name="nama_jamaah" value="' . $r['nama_jamaah'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="ttl_jamaah" class="form-label">ttl_jamaah</label>
                        <label for="alamat" class="form-label"><label for="alamat" class="form-label">alamat</label></label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="ttl_jamaah" id="ttl_jamaah1" value="1" ' . $this->cekRadio($r['ttl_jamaah'], 1) . '>
                            <label for="ttl_jamaah1" class="form-check-label">
                            <input type="radio" class="form-check-input" name="alamat" id="alamat1" value="1" ' . $this->cekRadio($r['alamat'], 1) . '>
                            <label for="alamat1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="ttl_jamaah" id="ttl_jamaah0" value="0" ' . $this->cekRadio($r['ttl_jamaah'], 0) . '>
                            <label for="ttl_jamaah0" class="form-check-label">
                            <input type="radio" class="form-check-input" name="alamat" id="alamat0" value="0" ' . $this->cekRadio($r['alamat'], 0) . '>
                            <label for="alamat0" class="form-check-label">
                                P
                            </label>
                        </div>
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
        $id_jamaah = $_POST['id_jamaah'];
        $nama_jamaah = $_POST['nama_jamaah'];
        $ttl_jamaah = $_POST['ttl_jamaah'];
        $alamat = $_POST['alamat'];

        $data = array(
            'id_jamaah' => $id_jamaah,
            'nama_jamaah' => $nama_jamaah,
            'ttl_jamaah' => $ttl_jamaah,
            'alamat' => $alamat
        );

        return $this->db->table('datajamaah')->where("id_jamaah='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('datajamaah')->where("id_jamaah='$id'")->delete();
    }
}
