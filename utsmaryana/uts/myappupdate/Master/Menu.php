<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/utsmaryana/myappupdate/index.php?target=";
        $data = [
            array('text' => 'Home', 'link' => $base . 'home'),
            array('text' => 'Pendaftaran', 'link' => $base . 'pendaftaran'),
            array('text' => 'admin', 'link' => $base . 'admin'),
            array('text' => 'Paket', 'link' => $base . 'Paket'),
            array('text' => 'datajamaah', 'link' => $base . 'datajamaah')
        ];
        return $data;
    }
}
