<?php

function mktimestamp($date_time) {
    //$date_time = '10/11/2012 22:11';
    if (count(explode(' ', $date_time)) < 2) {
        $date_time .= ' 00:00';
    }
    list($date, $time) = explode(' ', $date_time);
    list($day, $month, $year) = explode('/', $date);
    $time = explode(':', $time);
    if (count($time) > 2) {
        list($hour, $minute, $second) = $time;
    } else {
        $second = 0;
        list($hour, $minute) = $time;
    }
    return mktime($hour, $minute, $second, $month, $day, $year);
}

function thdate($format, $timestamp = '') {
    if ($timestamp == '') {
        $str_date = date($format);
    } else {
        $str_date = date($format, $timestamp);
    }
    $month_en = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    $month_th = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

    $day_en = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    $day_th = array("วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์", "วันเสาร์");

    $d_en = array("Sun", "Mon", "Tues", "Wednes", "Thurs", "Fri", "Satur");
    $d_th = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
    $search = array_merge($month_en, $day_en,$d_en);
    $replace = array_merge($month_th, $day_th,$d_th);
    $str_date = str_replace($search, $replace, $str_date);
    return $str_date;
}