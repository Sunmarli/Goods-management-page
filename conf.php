<?php
$serverinimi="localhost";
$kasutajanimi="mariajarv";
$parool="";
$andmebaas="mariajarv";


$yhendus=new mysqli($serverinimi,$kasutajanimi,$parool, $andmebaas);
$yhendus->set_charset('UTF8');

