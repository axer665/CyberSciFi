<?php
namespace Core\Models;

use Core\Database\BaseMysql;

class Model
{
    protected string $table;
    public function __construct($name)
    {
        $this->table = $name;
    }

    public function updateData(array $dataForSet, array $dataForWhere) {
        $set = " ";
        $where = " ";

        $iterationSet = 1;
        $iterationWhere = 1;

        foreach ($dataForSet AS $column => $value) {
            if ($iterationSet < count($dataForSet)) {
                $set .= $column . " = " . "'{$value}', ";
            } else {
                $set .= $column . " = " . "'{$value}' ";
            }
            $iterationSet++;
        }

        foreach ($dataForWhere AS $column => $value) {
            if ($iterationWhere < count($dataForWhere)) {
                $where .= $column . " = " . "'{$value}' AND ";
            } else {
                $where .= $column . " = " . "'{$value}' ";
            }
        }

        $query = 	"	
                UPDATE
                    {$this->table} 
                SET
                    {$set}
                WHERE 
                    {$where}
                
            ";

        BaseMysql::freeQueryFeed($query);
    }

    public function insertData(array $data) {
        $columns = [];
        $values = [];
        foreach ($data AS $column => $value) {
            $columns[] = $column;
            $values[] = $value;
        }

        //$columnsString = "'";
        $columnsString = implode(",", $columns );
        //$columnsString .= "'";

        $valuesString = "'";
        $valuesString .= implode("','", $values );
        $valuesString .= "'";

        $query = 	"	
                INSERT INTO
                    {$this->table} 
                    ({$columnsString})
                VALUES 
                    ({$valuesString})
                
            ";

        $result = BaseMysql::freeQueryFeed($query);
    }

    public function getAllData() {
        $query = 	"	
                SELECT
                    *
                FROM
                    {$this->table}
            ";
        $result = BaseMysql::freeQueryDataback($query);
        return $result;
    }

    public function getAllDataWhere($column, $value)
    {
        $query = 	"	
                SELECT
                    *
                FROM
                    {$this->table}
                WHERE 
                    {$column} = '{$value}'
            ";
        $result = BaseMysql::freeQueryDataback($query);
        return $result;
    }

    public function getAllDataWheres(array $data)
    {
        $whereBuilder = "";
        $iteration = 1;
        foreach ($data AS $column => $value) {
            if ($iteration < count($data)) {
                $whereBuilder .= "{$column} = '{$value}' AND ";
            } else {
                $whereBuilder .= "{$column} = '{$value}' ";
            }
            $iteration++;
        }
        $query = 	"	
                SELECT
                    *
                FROM
                    {$this->table}
                WHERE 
                    {$whereBuilder}
            ";
        $result = BaseMysql::freeQueryDataback($query);
        return $result;
    }


}