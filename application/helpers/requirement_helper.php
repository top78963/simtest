<?php

function make_predic($data) {
    if ($data['actual'] == $data['expected']) {
        $data['predictable'] = TRUE;
        $data['message'] .= ' เก่งมากExpectedถูกแล้วละ';
    } else {
        $data['message'] .= ' อ่อนหัด Expected ผิด';
    }
    return $data;
}

function quest1($text) {
    $text = trim($text);
    $a = explode(' ', $text);

    return $a;
}

function rq1($a_var, $exp_options, $expected) {
    $data = array(
        'expected' => $expected,
        'actual' => '',
        'predictable' => FALSE,
        'message' => '',
        'input' => $a_var,
        'discover_bug' => FALSE
    );
    // check input number

    if (count($a_var) != 3) {
        $data['actual'] = 0;
        $data['message'] = 'ข้อมูลไม่ครบ';
        $data['discover_bug'] = TRUE;
        return make_predic($data);
    }
    // check int

    return $data;
}

function rq2($a_var, $exp_options, $expected) {
    $data = array(
        'expected' => $expected,
        'actual' => '',
        'predictable' => FALSE,
        'message' => '',
        'input' => $a_var,
        'discover_bug' => FALSE
    );
    foreach ($a_var as $value) {
        if (!is_numeric($value)) {
            $data['actual'] = 1;
            $data['message'] = 'ไม่เป็นจำนวนเต็ม';
            $data['discover_bug'] = TRUE;
            return make_predic($data);
        }
    }
    return $data;
}

function rq3($a_var, $exp_options, $expected) {
    $data = array(
        'expected' => $expected,
        'actual' => '',
        'predictable' => FALSE,
        'message' => '',
        'input' => $a_var,
        'discover_bug' => FALSE
    );

    foreach ($a_var as $value) {

        if ($value <= 0) {

            $data['actual'] = 2;
            $data['message'] = 'น้อยกว่า 0';
            $data['discover_bug'] = TRUE;
            return make_predic($data);
        }
    }
    return $data;
}

/**
 * เป็นสามเหลี่ยม
 * @param type $a_var
 * @return boolean
 */
function rq4($a_var, $exp_options, $expected) {
    $data = array(
        'expected' => $expected,
        'actual' => '',
        'predictable' => FALSE,
        'message' => 'ไม่เป็นสามเหลี่ยม',
        'input' => $a_var,
        'discover_bug' => FALSE
    );
    $max = max($a_var);
    $key = array_search($max, $a_var);
    unset($a_var[$key]);
    $sum = array_sum($a_var);
//echo $sum;
    if ($max >= $sum) {
        $data['actual'] = 1;
        $data['message'] = 'ไม่เป็นสามเหลี่ยม';
        $data['discover_bug'] = TRUE;
        return make_predic($data);
    }
}

/**
 * เป็นสามเหลี่ยมด้านเท่า
 * @param type $a_var
 * @return boolean
 */
function rq5($a_var, $exp_options, $expected) {
    $data = array(
        'expected' => $expected,
        'actual' => '',
        'predictable' => FALSE,
        'message' => 'ไม่เป็นสามเหลี่ยม',
        'input' => $a_var,
        'discover_bug' => FALSE
    );
    $temp_a = array_unique($a_var);
    if (count($temp_a) == 1) {
        $data['actual'] = 2;
        $data['message'] = 'เป็นสามเหลี่ยมด้านเท่า';
        $data['discover_bug'] = TRUE;
        return make_predic($data);
    }

    return $data;
}

/**
 * หน้าจั่ว
 * @param type $a_var
 * @return boolean
 */
function rq6($a_var, $exp_options, $expected) {
    $data = array(
        'expected' => $expected,
        'actual' => '',
        'predictable' => FALSE,
        'message' => '',
        'input' => $a_var,
        'discover_bug' => FALSE
    );
    $temp_a = array_unique($a_var);

    if (count($temp_a) == 2) {
        $data['actual'] = 3;
        $data['message'] = 'เป็นสามเหลี่ยมหน้าจั่ว';
        $data['discover_bug'] = TRUE;
        return make_predic($data);
    }
    return TRUE;
}

/**
 * สามเหลี่ยมด้านไม่เท่า
 * @param type $a_var
 * @return boolean
 */
function rq7($a_var, $exp_options, $expected) {
    $data = array(
        'expected' => $expected,
        'actual' => '',
        'predictable' => FALSE,
        'message' => 'ไม่เป็นสามเหลี่ยมหน้าจั่ว',
        'input' => $a_var,
        'discover_bug' => FALSE
    );
    $temp_a = array_unique($a_var);

    if (count($temp_a) == 3) {
        $data['actual'] = 4;
        $data['message'] = 'เป็นสามเหลี่ยมด้านไม่เท่า';
        $data['discover_bug'] = TRUE;
        return make_predic($data);
    }
    return $data;
}
