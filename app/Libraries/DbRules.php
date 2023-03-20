<?php

namespace App\Libraries;

use Config\Database;

class DbRules {
    
    public function is_unique_two(?string $str, string $field, array $data) : bool
    {
        [$field, $secondField, $secondValue] = array_pad(explode(',', $field), 3, null);

        sscanf($field, '%[^.].%[^.]', $table, $field);

        $row = Database::connect($data['DBGroup'] ?? null)
            ->table($table)
            ->select('1')
            ->where($field, $str)
            ->where($secondField, $secondValue)
            ->limit(1);

        return $row->get()->getRow() === null;
    }
    
    public function is_unique_three(?string $str, string $field, array $data) : bool
    {
        [$field, $secondField, $secondValue, $thirdField, $thirdValue] = array_pad(explode(',', $field), 5, null);

        sscanf($field, '%[^.].%[^.]', $table, $field);

        $row = Database::connect($data['DBGroup'] ?? null)
            ->table($table)
            ->select('1')
            ->where($field, $str)
            ->where($secondField, $secondValue)
            ->where($thirdField, $thirdValue)
            ->limit(1);

        return $row->get()->getRow() === null;
    }
    
}
