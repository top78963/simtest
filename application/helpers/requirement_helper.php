<?php

function program_quest_1($text) {
    $text = trim($text);
    if ($text == '') {
        $args = array();
    } else {
        $args = explode(' ', $text);
    }

    $result['bug'] = FALSE;
    include_once 'program_quest_1.php';
    //$args = input_transform_quest_1($text);

    if (count($args) < 3) {
        $result['output_program_normal'] = $result['output_program_bug'] = 'Invalid input value(s)';
        $result['bug'] = FALSE;
        return $result;
    }
    
    //print_r(array_filter($args));
    $cls_quest_bug_1 = new cls_quest_bug_1($args);
    $cls_quest_1 = new cls_quest_1($args);
    $result['output_program_bug'] = $cls_quest_bug_1->get_result();
    $result['output_program_normal'] = $cls_quest_1->get_result();
    if ($result['output_program_bug'] != $result['output_program_normal']) {
        $result['bug'] = TRUE;
    }
    return $result;
}
