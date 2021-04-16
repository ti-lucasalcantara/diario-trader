<?php

function datePTBRtoENUS($date = null)
{
    if ( ! $date ){
        return false;
    }
    $explode = explode("/", $date);
    return $explode[2]."-".$explode[1]."-".$explode[0];
}


function valueToDecimal($value = null)
{
    if ( ! $value ){
        return false;
    }
    return trim(str_replace('R$', '', str_replace(',', '.', str_replace('.', '', $value))));
}