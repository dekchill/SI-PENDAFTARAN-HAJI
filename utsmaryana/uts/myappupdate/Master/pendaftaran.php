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
        $data = $this->db->table('pendaftaran')->get()->resultArray();
        $res = ' <a href="?target=pendaftaran&act=tambah_pendaftaran" class="btn btn-info btn-sm">Tambah pendaftaran</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>KTP</th>
                    <th>Ijazah</th>
                    <th>nomorvalidasi</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                    <td width="10">' . $no . '</td>
                    <td width="250">' . $r['foto'] . '</td>
                    <td>' . $r['ktp'] . '</td>
                    <td width="200">' . $r['ijazah'] . '</td>
                    <td width="200">' . $r['nomorvalidasi'] . '</td>
                    <td width="150">
                        <a href="?target=pendaftaran&act=edit_pendaftaran&id=' . $r['foto'] . '" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <a href="?target=pendaftaran&act=delete_pendaftaran&id=' . $r['foto'] . '" class="btn btn-danger btn-sm">
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
        $res = '<a href="?target=pendaftaran" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=pendaftaran&act=simpan_pendaftaran" method="post">
                    <div class="mb-3">
                        <label for="foto" class="form-label">foto</label>
                        <input type="text" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="mb-3">
                        <label for="ktp" class="form-label">ktp</label>
                        <input type="text" class="form-control" id="ktp" name="ktp">
                    </div>
                    <div class="mb-3">
                        <label for="ijazah" class="form-label">ijazah</label>
                        <label for="nomorvalidasi" class="form-label">nomorvalidasi</label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="ijazah" id="ijazah1" value="1">
                            <label for="ijazah1" class="form-check-label">
                            <input type="radio" class="form-check-input" name="nomorvalidasi" id="nomorvalidasi1" value="1">
                            <label for="nomorvalidasi1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="ijazah" id="ijazah0" value="0">
                            <label for="ijazah0" class="form-check-label">
                            <input type="radio" class="form-check-input" name="nomorvalidasi" id="nomorvalidasi0" value="0">
                            <label for="nomorvalidasi0" class="form-check-label">
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
        $foto = $_POST['foto'];
        $ktp = $_POST['ktp'];
        $ijazah = $_POST['ijazah'];
        $nomorvalidasi = $_POST['nomorvalidasi'];

        $data = array(
            'foto' => $foto,
            'ktp' => $ktp,
            'ijazah' => $ijazah,
            'nomorvalidasi' => $nomorvalidasi
        );
        return $this->db->table('pendaftaran')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('pendaftaran')->where("foto='$id'")->get()->rowArray();

        $res = '<a href="?target=pendaftaran" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=pendaftaran&act=update_pendaftaran" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['foto'] . '">
                    <div class="mb-3">
                        <label for="foto" class="form-label">foto</label>
                        <input type="text" class="form-control" id="foto" name="foto" value="' . $r['foto'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="ktp" class="form-label">ktp</label>
                        <input type="text" class="form-control" id="ktp" name="ktp" value="' . $r['ktp'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="ijazah" class="form-label">ijazah</label>
                        <label for="nomorvalidasi" class="form-label"><label for="nomorvalidasi" class="form-label">nomorvalidasi</label></label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="ijazah" id="ijazah1" value="1" ' . $this->cekRadio($r['ijazah'], 1) . '>
                            <label for="ijazah1" class="form-check-label">
                            <input type="radio" class="form-check-input" name="nomorvalidasi" id="nomorvalidasi1" value="1" ' . $this->cekRadio($r['nomorvalidasi'], 1) . '>
                            <label for="nomorvalidasi1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="ijazah" id="ijazah0" value="0" ' . $this->cekRadio($r['ijazah'], 0) . '>
                            <label for="ijazah0" class="form-check-label">
                            <input type="radio" class="form-check-input" name="nomorvalidasi" id="nomorvalidasi0" value="0" ' . $this->cekRadio($r['nomorvalidasi'], 0) . '>
                            <label for="nomorvalidasi0" class="form-check-label">
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
        $foto = $_POST['foto'];
        $ktp = $_POST['ktp'];
        $ijazah = $_POST['ijazah'];
        $nomorvalidasi = $_POST['nomorvalidasi'];

        $data = array(
            'foto' => $foto,
            'ktp' => $ktp,
            'ijazah' => $ijazah,
            'nomorvalidasi' => $nomorvalidasi
        );

        return $this->db->table('pendaftaran')->where("foto='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('pendaftaran')->where("foto='$id'")->delete();
    }
}
