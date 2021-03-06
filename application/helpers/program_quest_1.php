<?php

class cls_quest_bug_1 {
    /* Declare side variables and set default values to 0 */

    var $firstSide = 0;
    var $secondSide = 0;
    var $thirdSide = 0;
    var $result;

    function __construct($args) {
        $arg1 = $args[0];
        $arg2 = $args[1];
        $arg3 = $args[2];
        if (!is_numeric($arg1) || !is_numeric($arg2) || !is_numeric($arg3)) {

            $this->result = "Invalid input value(s)";
            return;
        } else if ($arg1 < 0 || $arg2 < 0 || $arg3 < 0) {

            $this->result = "Invalid input value(s)";
            return;
        } else {
            $this->firstSide = $arg1;
            $this->secondSide = $arg2;
            $this->thirdSide = $arg3;
            //$this->findTriangleType();
            $this->result = $this->findTriangleType();
        }
    }

    function get_result() {
        return $this->result;
    }

    /* Determine which side is the largest */

    public function largest($side1, $side2, $side3) {
        if ((($side1 <= $side2) && ($side2 <= $side3)) || (($side2 <= $side1) || ($side1 <= $side3)))
            return $side3;
        else if ((($side1 <= $side3) && ($side3 <= $side2)) || (($side3 <= $side1) && ($side1 <= $side2)))
            return $side2;
        else
            return $side1;
    }

    /* Determine which side is the middle side */

    public function middle($side1, $side2, $side3) {
        if ((($side1 <= $side2) && ($side2 <= $side3)) || (($side2 <= $side1) && ($side3 <= $side2)))
            return $side2;
        else if ((($side1 <= $side3) && ($side3 <= $side2)) || (($side3 <= $side1) && ($side2 <= $side3)))
            return $side3;
        else
            return $side2;
    }

    /* Determine which side is the smallest */

    public function smallest($side1, $side2, $side3) {
        if ((($side1 <= $side2) && ($side2 <= $side3)) || (($side3 <= $side2) && ($side1 <= $side3)))
            return $side1;
        else if ((($side2 <= $side3) && ($side3 <= $side1)) || (($side2 <= $side1) && ($side1 <= $side3)))
            return $side1;
        else
            return $side3;
    }

    public function findTriangleType() {
        $shortSide = $this->smallest($this->firstSide, $this->secondSide, $this->thirdSide);
        $middleSide = $this->middle($this->firstSide, $this->secondSide, $this->thirdSide);
        $longSide = $this->largest($this->firstSide, $this->secondSide, $this->thirdSide);

        if ($shortSide + $middleSide < $longSide)
            return "Not a Triangle";
        else if (($shortSide == $middleSide) && ($middleSide == $longSide))
            return "Equilateral";
        else if (($shortSide == $middleSide) || ($middleSide == $longSide))
            return "Isosceles";
        else
            return "Scalene";
    }

//    public function Triangle($side1, $side2, $side3) {
//        $this->firstSide = $side1;
//        $this->secondSide = $side2;
//        $this->thirdSide = $side3;
//    }
}

class cls_quest_1 {
    /* Declare side variables and set default values to 0 */

    var $firstSide = 0;
    var $secondSide = 0;
    var $thirdSide = 0;
    var $result;

    function __construct($args) {
        $arg1 = $args[0];
        $arg2 = $args[1];
        $arg3 = $args[2];
        if (!is_numeric($arg1) || !is_numeric($arg2) || !is_numeric($arg3)) {

            $this->result = "Invalid input value(s)";
            return;
        } else if ($arg1 < 0 || $arg2 < 0 || $arg3 < 0) {

            $this->result = "Invalid input value(s)";
            return;
        } else {
            $this->firstSide = $arg1;
            $this->secondSide = $arg2;
            $this->thirdSide = $arg3;
            //$this->findTriangleType();
            $this->result = $this->findTriangleType();
        }
    }

    function get_result() {

        return $this->result;
    }

    /* Determine which side is the largest */

    public function largest($side1, $side2, $side3) {
        //if ((($side1 <= $side2) && ($side2 <= $side3)) || (($side2 <= $side1) || ($side1 <= $side3)))
        if ((($side1 <= $side2) && ($side2 <= $side3)) || (($side2 <= $side1) && ($side1 <= $side3)))
            return $side3;
        else if ((($side1 <= $side3) && ($side3 <= $side2)) || (($side3 <= $side1) && ($side1 <= $side2)))
            return $side2;
        else
            return $side1;
    }

    /* Determine which side is the middle side */

    public function middle($side1, $side2, $side3) {
        if ((($side1 <= $side2) && ($side2 <= $side3)) || (($side2 <= $side1) && ($side3 <= $side2)))
            return $side2;
        else if ((($side1 <= $side3) && ($side3 <= $side2)) || (($side3 <= $side1) && ($side2 <= $side3)))
            return $side1;
        else
            return $side3;
    }

    /* Determine which side is the smallest */

    public function smallest($side1, $side2, $side3) {
        if ((($side1 <= $side2) && ($side2 <= $side3)) || (($side3 <= $side2) && ($side1 <= $side3)))
            return $side1;
        else if ((($side2 <= $side3) && ($side3 <= $side1)) || (($side2 <= $side1) && ($side1 <= $side3)))
            return $side2;
        else
            return $side3;
    }

    public function findTriangleType() {
        $shortSide = $this->smallest($this->firstSide, $this->secondSide, $this->thirdSide);
        $middleSide = $this->middle($this->firstSide, $this->secondSide, $this->thirdSide);
        $longSide = $this->largest($this->firstSide, $this->secondSide, $this->thirdSide);
//        echo $shortSide;
//        echo $middleSide;
//        echo $longSide;
        if ($shortSide + $middleSide <= $longSide) //fix bug
            return "Not a Triangle";
        else if (($shortSide == $middleSide) && ($middleSide == $longSide))
            return "Equilateral";

        else if (($shortSide == $middleSide) || ($middleSide == $longSide))
            return "Isosceles";
        else
            return "Scalene";
    }

//    public function Triangle($side1, $side2, $side3) {
//        $this->firstSide = $side1;
//        $this->secondSide = $side2;
//        $this->thirdSide = $side3;
//    }
}
