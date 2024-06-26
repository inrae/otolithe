<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Espece as LibrariesEspece;

class Espece extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesEspece();
    }
    function list()
    {
        return $this->lib->list();
    }
    function change()
    {
        return $this->lib->change();
    }
    function write()
    {
        return $this->lib->write();
    }
    function delete()
    {
        return $this->lib->delete();
    }
    function searchAjax()
    {
        return $this->lib->searchAjax();
    }
}
