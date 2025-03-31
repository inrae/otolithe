<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table piecetype
 *
 * @author quinton
 *
 */
class RemarkableType extends PpciModel
{
    function __construct()
    {
        $this->table = "remarkable_type";
        $this->fields = array(
            "remarkable_type_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "remarkable_type_name" => array(
                "type" => 0,
                "requis" => 1
            ),
            "sort_order" => array(
                "type" => 1,
                "defaultValue" => 1
            )
        );
        parent::__construct();
    }
    function getList(string $order = ""): array
    {
        $sql = "select remarkable_type_id, remarkable_type_name, sort_order
                    from remarkable_type";
        if (empty($order)) {
            $sql .= " order by sort_order";
        } else {
            $sql .= " order by $order";
        }
        return $this->getListParam($sql);
    }
    /**
     * Format the list to search the name from the id
     *
     * @return array
     */
    function getAsArray():array {
        $data = $this->getList();
        $arr = [];
        foreach ($data as $row) {
            $arr[$row["remarkable_type_id"]] = $row["remarkable_type_name"];
        }
        return $arr;
    }
}
