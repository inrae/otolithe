<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Photolecture as LibrariesPhotolecture;

class Photolecture extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesPhotolecture();
    }
    function display()
    {
        return $this->lib->display();
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
    function list()
    {
        return $this->lib->list();
    }
    function export()
    {
        return $this->lib->export();
    }
    function swap()
    {
        return $this->lib->swap();
    }
}
