<?php

namespace Master;

use Config\Query_builder;

class admin
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('admin')->get()->resultArray();
        $res = ' <a href="?target=admin&act=tambah_admin" class="btn btn-info btn-sm">Tambah admin</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>id</th>
                    <th>nama_admin</th>
                    <th>password</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                    <td width="10">' . $no . '</td>
                    <td width="2000">' . $r['id_admin'] . '</td>
                    <td>' . $r['nama_admin'] . '</td>
                    <td width="200">' . $r['password'] . '</td>
                    <td width="150">
                        <a href="?target=admin&act=edit_admin&id=' . $r['id'] . '" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <a href="?target=admin&act=delete_admin&id=' . $r['id'] . '" class="btn btn-danger btn-sm">
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
        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=admin&act=simpan_admin" method="post">
                    <div class="mb-3">
                        <label for="id" class="form-label">id</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="mb-3">
                        <label for="nama_admin" class="form-label">nama_admin</label>
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">password</label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="password" id="password1" value="1">
                            <label for="password1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="password" id="password0" value="0">
                            <label for="password0" class="form-check-label">
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
        $id = $_POST['id'];
        $nama_admin = $_POST['nama_admin'];
        $password = $_POST['password'];

        $data = array(
            'id' => $id,
            'nama_admin' => $nama_admin,
            'password' => $password
        );
        return $this->db->table('admin')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('admin')->where("id='$id'")->get()->rowArray();

        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=admin&act=update_admin" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id'] . '">
                    <div class="mb-3">
                        <label for="id" class="form-label">id</label>
                        <input type="text" class="form-control" id="id" name="id" value="' . $r['id'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="nama_admin" class="form-label">nama_admin</label>
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="' . $r['nama_admin'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">password</label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="password" id="password1" value="1" ' . $this->cekRadio($r['password'], 1) . '>
                            <label for="password1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="password" id="password0" value="0" ' . $this->cekRadio($r['password'], 0) . '>
                            <label for="password0" class="form-check-label">
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
        $id = $_POST['id'];
        $nama_admin = $_POST['nama_admin'];
        $password = $_POST['password'];

        $data = array(
            'id' => $id,
            'nama_admin' => $nama_admin,
            'password' => $password,
        );

        return $this->db->table('admin')->where("id='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('admin')->where("id='$id'")->delete();
    }
}
