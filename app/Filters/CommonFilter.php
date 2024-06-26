<?php
namespace App\Filters;

use App\Libraries\SearchIndividu;
use App\Libraries\SearchLecture;
use App\Libraries\TranslateId;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CommonFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!isset($_SESSION["searchIndividu"])) {
            $_SESSION["searchIndividu"] = new SearchIndividu();
        }
        if (!isset($_SESSION["searchLecture"])) {
            $_SESSION["searchLecture"] = new SearchLecture();
        }
        /*
         * Initialisations des traducteurs d'identifiants
         */
        $traducteurs = array(
            "it_individu" => "individu_id",
            "it_experimentation" => "exp_id",
            "it_piece" => "piece_id",
            "it_peche" => "peche_id",
            "it_photo" => "photo_id",
            "it_photolecture" => "photolecture_id",
            "it_piecemetadata" => "piecemetadata_id"
        );
        foreach ($traducteurs as $key => $value) {
            if (!isset($_SESSION[$key])) {
                $_SESSION[$key] = new TranslateId($value);
            }
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}