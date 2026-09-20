<?php 

//variable
//$angka = 12;
//$nama = "andi";
//$nilai = true;

//output : echo, print, var_dump
//echo "angka : ".$angka."<br>";
//echo "nama : ".$nama."<br>";
//print "nilai : ".$nilai;

//aritmatika
//$a = 75;
//$b = 17;
// echo "(+)".$a + $b."<br>";
// echo "(-)".$a - $b."<br>";
// echo "(*)".$a * $b."<br>";
// echo "(/)".$a / $b."<br>";
// echo "(%)".$a % $b."<br>";

// penugasan
// $ab = 24;
// $ab += 8;
// echo $ab."<br>";
// $bc = 24;
// $bc -= 8;
// echo $bc."<br>";
// $cd = 24;
// $cd *= 8;
// echo $cd."<br>";
// $de = 24;
// $de /= 8;
// echo $de."<br>";
// $ef = 24;
// $ef %= 8;
// echo $ef."<br>";

// perbandingan
// $a = 34;
// $b = 67;
// $ab = $a > $b;
// $bc = $a < $b;
// $cd = $a <= $b;
// $de = $a >= $b;
// $ef = $a == $b;
// $fg = $a === $b;
// var_dump($ab);
// var_dump($bc);
// var_dump($cd);
// var_dump($de);
// var_dump($ef);
// var_dump($fg);

// logika
$a = 12;
$b = 18;
$value = true;
$ab = $a < $b && $value == true;
var_dump($ab);
$bc = $b == 18 || $value == false;
var_dump($bc);
$cd = !$value;
var_dump($cd);

?>