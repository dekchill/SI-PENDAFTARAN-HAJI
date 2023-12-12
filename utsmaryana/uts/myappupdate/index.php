<?php

use Master\pendaftaran;
use Master\Menu;
use Master\admin;
use Master\paket;
use Master\datajamaah;

include('autoload.php');
include('Config/Database.php');

$menu = new Menu();
$pendaftaran = new pendaftaran($dataKoneksi);
$admin = new admin($dataKoneksi);
$paket = new paket($dataKoneksi);
$datajamaah = new datajamaah($dataKoneksi);
//$Admin ->tambah()
$target = @$_GET['target'];
$act = @$_GET['act']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">WEBSITE BONDOWOSO</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        foreach ($menu->topMenu() as $r) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['link']; ?>" class="nav-link">
                                    <?php echo $r['text']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>

            <?php
            if (!isset($target) or $target == "home") {
                echo "Hai, Selamat Datang di Beranda";
                //====start content pendaftaran====
            } elseif ($target == "pendaftaran") {
                if ($act == "tambah_pendaftaran") {
                    echo $pendaftaran->tambah();
                } elseif ($act == "simpan_pendaftaran") {
                    if ($pendaftaran->simpan()) {
                        echo "<script>
                        alert ('pendaftaran Tersimpan')
                        window.location.href = '?target=pendaftaran'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('pendaftaran Gagal Tersimpan')
                        window.location.href = '?target=pendaftaran'
                        </script>";
                    }
                } elseif ($act == "edit_pendaftaran") {
                    $id = $_GET['id'];
                    echo $pendaftaran->edit($id);
                } elseif ($act == "update_pendaftaran") {
                    if ($pendaftaran->update()) {
                        echo "<script>
                        alert ('pendaftaran Diupdate')
                        window.location.href = '?target=pendaftaran'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('pendaftaran Gagal Diupdate')
                        window.location.href = '?target=pendaftaran'
                        </script>";
                    }
                } elseif ($act == "delete_pendaftaran") {
                    $id = $_GET['id'];
                    if ($pendaftaran->delete($id)) {
                        echo "<script>
                        alert ('pendaftaran Dihapus')
                        window.location.href = '?target=pendaftaran'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('pendaftaran Gagal Dihapus')
                        window.location.href = '?target=pendaftaran'
                        </script>";
                    }
                } else {
                    echo $pendaftaran->index();
                }
                //====And Content admin====
            } elseif ($target == "admin") {
                if ($act == "tambah_admin") {
                    echo $admin->tambah();
                } elseif ($act == "simpan_admin") {
                    if ($admin->simpan()) {
                        echo "<script>
                        alert ('admin Tersimpan')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('admin Gagal Tersimpan')
                        window.location.href = '?target=admin'
                        </script>";
                    }
                } elseif ($act == "edit_admin") {
                    $id = $_GET['id'];
                    echo $admin->edit($id);
                } elseif ($act == "update_admin") {
                    if ($admin->update()) {
                        echo "<script>
                        alert ('admin Diupdate')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('admin Gagal Diupdate')
                        window.location.href = '?target=admin'
                        </script>";
                    }
                } elseif ($act == "delete_admin") {
                    $id = $_GET['id'];
                    if ($admin->delete($id)) {
                        echo "<script>
                        alert ('admin Dihapus')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('admin Gagal Dihapus')
                        window.location.href = '?target=admin'
                        </script>";
                    }
                } else {
                    echo $admin->index();
                }
                
          //====start content paket====
        } elseif ($target == "paket") {
            if ($act == "tambah_paket") {
                echo $paket->tambah();
            } elseif ($act == "simpan_paket") {
                if ($paket->simpan()) {
                    echo "<script>
                    alert ('paket Tersimpan')
                    window.location.href = '?target=paket'
                    </script>";
                } else {
                    echo "<script>
                    alert ('paket Gagal Tersimpan')
                    window.location.href = '?target=paket'
                    </script>";
                }
            } elseif ($act == "edit_paket") {
                $id = $_GET['id'];
                echo $paket->edit($id);
            } elseif ($act == "update_paket") {
                if ($paket->update()) {
                    echo "<script>
                    alert ('paket Diupdate')
                    window.location.href = '?target=paket'
                    </script>";
                } else {
                    echo "<script>
                    alert ('paket Gagal Diupdate')
                    window.location.href = '?target=paket'
                    </script>";
                }
            } elseif ($act == "delete_paket") {
                $id = $_GET['id'];
                if ($paket->delete($id)) {
                    echo "<script>
                    alert ('paket Dihapus')
                    window.location.href = '?target=paket'
                    </script>";
                } else {
                    echo "<script>
                    alert ('paket Gagal Dihapus')
                    window.location.href = '?target=paket'
                    </script>";
                }
            } else {
                echo $paket->index();
            }
             //====And Content datajamaah====
                        } elseif ($target == "datajamaah") {
                            if ($act == "tambah_datajamaah") {
                                echo $datajamaah->tambah();
                            } elseif ($act == "simpan_datajamaah") {
                                if ($datajamaah->simpan()) {
                                    echo "<script>
                                    alert ('datajamaah Tersimpan')
                                    window.location.href = '?target=datajamaah'
                                    </script>";
                                } else {
                                    echo "<script>
                                    alert ('datajamaah Gagal Tersimpan')
                                    window.location.href = '?target=datajamaah'
                                    </script>";
                                }
                            } elseif ($act == "edit_datajamaah") {
                                $id = $_GET['id'];
                                echo $datajamaah->edit($id);
                            } elseif ($act == "update_datajamaah") {
                                if ($datajamaah->update()) {
                                    echo "<script>
                                    alert ('datajamaah Diupdate')
                                    window.location.href = '?target=datajamaah'
                                    </script>";
                                } else {
                                    echo "<script>
                                    alert ('datajamaah Gagal Diupdate')
                                    window.location.href = '?target=datajamaah'
                                    </script>";
                                }
                            } elseif ($act == "delete_datajamaah") {
                                $id = $_GET['id'];
                                if ($datajamaah->delete($id)) {
                                    echo "<script>
                                    alert ('datajamaah Dihapus')
                                    window.location.href = '?target=datajamaah'
                                    </script>";
                                } else {
                                    echo "<script>
                                    alert ('datajamaah Gagal Dihapus')
                                    window.location.href = '?target=datajamaah'
                                    </script>";
                                }
                            } else {
                                echo $datajamaah->index();
                            }
        }
            ?>
        </div>
    </div>
</body>

</html>