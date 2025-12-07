<?php

    // Create two numeric variables and perform addition, subtraction, multiplication, division, and
    // modulus operations. Display results clearly.
    $numberOne = 20;
    $numberTwo = 10;

    $addition = $numberOne + $numberTwo;
    $subtraction = $numberOne - $numberTwo;
    $multiplication = $numberOne  * $numberTwo;
    $division = $numberOne  / $numberTwo;

    echo "First Number " .$numberOne. " and Second Number ". $numberTwo;
    echo "<br>";
    echo "Sum: ".$addition;
    echo "<br>";
    echo "Subtraction: ".$subtraction;
    echo "<br>";
    echo "Multiplication: ".$multiplication;
    echo "<br>";
    echo "Division: ".$division;


    // Q2
    echo "<br><br><h1>Question Number Two</h1><br>";
    $radius = 5;
    const PI = 3.14;

    $area = PI * $radius * $radius;
    echo "Area: ".$area;