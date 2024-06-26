<?php

namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Photo as LibrariesPhoto;

class Photo extends PpciController
{
    protected $lib;
    function __construct()
    {
        $this->lib = new LibrariesPhoto();
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
    function getPhoto()
    {
        return $this->lib->getPhoto();
    }
    function getThumbnail()
    {
        return $this->lib->getThumbnail();
    }
}
