<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Lecteur as LibrariesLecteur;

class Lecteur extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesLecteur();
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
    function listFromExp()
    {
        return $this->lib->listFromExp();
    }
}
