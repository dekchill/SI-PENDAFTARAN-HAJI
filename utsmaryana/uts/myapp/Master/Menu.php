<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/utsmaryana/index.php?target=";
        $data = [
            array('text' => 'Home', 'link' => $base . 'home'),
            array('text' => 'admin', 'link' => $base . 'admin'),
            array('text' => 'pendaftaran', 'link' => $base . 'pendaftaran'),
            array('text' => 'paket', 'link' => $base . 'paket'),
            array('text' => 'datajamaah', 'link' => $base . 'datajamaah'),
        ];
        return $data;
    }
}
