<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Metadatatype as LibrariesMetadatatype;

class Metadatatype extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesMetadatatype();
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
    function copy()
    {
        return $this->lib->copy();
    }
    function getSchema()
    {
        return $this->lib->getSchema();
    }
    function isArray()
    {
        return $this->lib->isArray();
    }
    function export()
    {
        return $this->lib->export();
    }
    function import()
    {
        return $this->lib->import();
    }
}
