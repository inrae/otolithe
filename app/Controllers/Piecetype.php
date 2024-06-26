<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Piecetype as LibrariesPiecetype;

class Piecetype extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesPiecetype();
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
}
