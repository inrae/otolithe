<?php
namespace App\Controllers;

use \Ppci\Controllers\PpciController;
use App\Libraries\Individu as LibrariesIndividu;

class Individu extends PpciController {
protected $lib;
function __construct() {
$this->lib = new LibrariesIndividu();
}
function list() {
return $this->lib->list();
}
function display() {
return $this->lib->display();
}
function change() {
return $this->lib->change();
}
function write() {
return $this->lib->write();
}
function delete() {
return $this->lib->delete();
}
function listEspece() {
return $this->lib->listEspece();
}
}
