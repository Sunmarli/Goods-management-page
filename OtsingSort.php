<?php
require("abifunktsioonid.php");
$sorttulp="nimetus";
$otsisona="";
if(isSet($_REQUEST["sort"])){
    $sorttulp=$_REQUEST["sort"];
}
if(isSet($_REQUEST["otsisona"])){
    $otsisona=$_REQUEST["otsisona"];
}
$kaubad=kysiKaupadeAndmed($sorttulp, $otsisona);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Kaupade leht</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  </head>
<body>
<h1>Kaupade leht</h1>
<form action="?">
    Otsi: <input type="text" name="otsisona" />
    <table>
        <tr>
            <th><a href="?sort=nimetus">Nimetus</a></th>
            <th><a href="?sort=grupinimi">Kaubagrupp</a></th>
            <th><a href="?sort=hind">Hind</a></th>
        </tr>
        <?php foreach($kaubad as $kaup): ?>
            <tr>
                <td><?=$kaup->nimetus ?></td>
                <td><?=$kaup->grupinimi ?></td>
                <td><?=$kaup->hind ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>
</body>
</html>