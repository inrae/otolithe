<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Piecemetadata as LibrariesPiecemetadata;

class Piecemetadata extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesPiecemetadata();
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
    function import()
    {
        return $this->lib->import();
    }
    function display()
    {
        return $this->lib->display();
    }
    function export()
    {
        return $this->lib->export();
    }
}
