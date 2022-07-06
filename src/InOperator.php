<?php

namespace MarceloChia;

define('LIMIT', 10);

class InOperator
{    
    public static function create(array $data, string $field, bool $withQuote = false): string
    {
        $inOperator = "";
        $addOr = ") or $field in (";
        $quotes = $withQuote ? "'" : "";
        
        if (count($data) === 0) {
            return "('')";
        }
        
        $count = 0;
        
        for ($i=0; $i < count($data); $i++) {
            if ($count < LIMIT) {
                $inOperator .= $quotes.$data[$i].$quotes.',';
            } else {
                $count = 0;
                $inOperator = rtrim($inOperator,',');
                $inOperator .= $addOr;
                $inOperator .= $quotes.$data[$i].$quotes.',';
            }
            $count++;
        }
        
        $inOperator = rtrim($inOperator,',');
        $inOperator = "($inOperator)";
    
        return $inOperator;
    }
}
