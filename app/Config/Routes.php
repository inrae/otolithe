<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->add('individuList', 'Individu::list');
$routes->add('individuDisplay', 'Individu::display');
$routes->add('individuChange', 'Individu::change');
$routes->post('individuWrite', 'Individu::write');
$routes->post('individuDelete', 'Individu::delete');
$routes->add('individuGetListEspece', 'Individu::listEspece');
$routes->add('pieceDisplay', 'Piece::display');
$routes->add('pieceChange', 'Piece::change');
$routes->post('pieceWrite', 'Piece::write');
$routes->post('pieceDelete', 'Piece::delete');
$routes->add('pieceList', 'Piece::list');
$routes->add('pieceExportCS', 'Piece::exportCS');
$routes->add('photoDisplay', 'Photo::display');
$routes->add('photoChange', 'Photo::change');
$routes->post('photoWrite', 'Photo::write');
$routes->post('photoDelete', 'Photo::delete');
$routes->add('photoGetPhoto', 'Photo::getPhoto');
$routes->add('photoGetThumbnail', 'Photo::getThumbnail');
$routes->add('lecteurList', 'Lecteur::list');
$routes->add('lecteurChange', 'Lecteur::change');
$routes->post('lecteurWrite', 'Lecteur::write');
$routes->post('lecteurDelete', 'Lecteur::delete');
$routes->add('lecteurListFromExp', 'Lecteur::listFromExp');
$routes->add('parametres', 'Index::index');
$routes->add('experimentationList', 'Experimentation::list');
$routes->add('experimentationChange', 'Experimentation::change');
$routes->post('experimentationWrite', 'Experimentation::write');
$routes->post('experimentationDelete', 'Experimentation::delete');
$routes->add('piecetypeList', 'Piecetype::list');
$routes->add('piecetypeChange', 'Piecetype::change');
$routes->post('piecetypeWrite', 'Piecetype::write');
$routes->post('piecetypeDelete', 'Piecetype::delete');
$routes->add('remarkabletypeList', 'RemarkableType::list');
$routes->add('remarkabletypeChange', 'RemarkableType::change');
$routes->post('remarkabletypeWrite', 'RemarkableType::write');
$routes->post('remarkabletypeDelete', 'RemarkableType::delete');
$routes->add('photolectureDisplay', 'Photolecture::display');
$routes->add('photolectureChange', 'Photolecture::change');
$routes->post('photolectureWrite', 'Photolecture::write');
$routes->add('photolectureDelete', 'Photolecture::delete');
$routes->add('photolectureList', 'Photolecture::list');
$routes->add('photolectureExport', 'Photolecture::export');
$routes->add('photolectureSwap', 'Photolecture::swap');
$routes->add('especeList', 'Espece::list');
$routes->add('especeChange', 'Espece::change');
$routes->post('especeWrite', 'Espece::write');
$routes->post('especeDelete', 'Espece::delete');
$routes->add('especeSearchAjax', 'Espece::searchAjax');
$routes->add('importChange', 'Import::change');
$routes->add('importControl', 'Import::control');
$routes->add('importImport', 'Import::import');
$routes->add('metadatatypeList', 'Metadatatype::list');
$routes->add('metadatatypeChange', 'Metadatatype::change');
$routes->post('metadatatypeWrite', 'Metadatatype::write');
$routes->post('metadatatypeDelete', 'Metadatatype::delete');
$routes->add('metadatatypeCopy', 'Metadatatype::copy');
$routes->add('metadatatypeGetschema', 'Metadatatype::getSchema');
$routes->add('metadatatypeIsarray', 'Metadatatype::isArray');
$routes->add('metadatatypeExport', 'Metadatatype::export');
$routes->add('metadatatypeImport', 'Metadatatype::import');
$routes->add('piecemetadataChange', 'Piecemetadata::change');
$routes->post('piecemetadataWrite', 'Piecemetadata::write');
$routes->post('piecemetadataDelete', 'Piecemetadata::delete');
$routes->add('piecemetadataImport', 'Piecemetadata::import');
$routes->add('piecemetadataDisplay', 'Piecemetadata::display');
$routes->add('piecemetadataExport', 'Piecemetadata::export');

/**
 * Submenus
 */
$routes->add('parametre', '\Ppci\Controllers\Utils::submenu/parametre');
$routes->add('read', '\Ppci\Controllers\Utils::submenu/read');
$routes->add('help', '\Ppci\Controllers\Utils::submenu/help');
