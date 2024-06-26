<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Piece as LibrariesPiece;

class Piece extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesPiece();
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
    function exportCS()
    {
        return $this->lib->exportCS();
    }
}
