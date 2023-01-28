<?php

namespace App\Libraries;

class Lib_halaman
{
    function info($parameter)
    {
        $data['parameter'] = $parameter;
        return view('komponen/halaman_info', $data);
    }
}
