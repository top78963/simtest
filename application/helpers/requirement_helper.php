<?php
function quest1($text) {
    $text = trim($text);
    $a = explode(',', $text);
    return $a;
}

function rq1($a_var) {
    // check input number
    if (count($a_var) != 3) {
        return FALSE;
    }
    // check int
    foreach ($a_var as $value) {
        if ((int) $value != $value) {
            return FALSE;
        }
    }

    // check Less than Zero
    foreach ($a_var as $value) {
        if ($value <= 0) {
            return FALSE;
        }
    }

    return TRUE;
}

function rq2($a_var) {
    $max = max($a_var);
    $key = array_search($max, $a_var);
    unset($a_var[$key]);
    $sum = array_sum($a_var);
//echo $sum;
    if ($max >= $sum) {
        return FALSE;
    }
    return TRUE;
}

function rq3($a_var) {
    $temp_a = array_unique($a_var);

    if (count($temp_a) == 1) {
        return FALSE;
    }
    return TRUE;
}

function rq4($a_var) {
    $temp_a = array_unique($a_var);

    if (count($temp_a) == 2) {
        return FALSE;
    }
    return TRUE;
}

function rq5($a_var) {
    $temp_a = array_unique($a_var);

    if (count($temp_a) == 3) {
        return FALSE;
    }
    return TRUE;
}

function rq6($a_var) {
    if (($a_var) < 200) {
        return FALSE;
    }

    return TRUE;
}

function rq7($a_var) {
    if (($a_var) < 200) {
        return FALSE;
    }

    return TRUE;
}