<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Experimentation as LibrariesExperimentation;

class Experimentation extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesExperimentation();
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
