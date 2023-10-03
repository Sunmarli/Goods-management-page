<?php
require("abifunktsioonid.php");

if(isSet($_REQUEST["grupilisamine"])){
    lisaGrupp($_REQUEST["uuegrupinimi"]);
    header("Location: kaubahaldus.php");
    exit();
}
if(isSet($_REQUEST["kaubalisamine"])){
    lisaKaup($_REQUEST["nimetus"], $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);
    header("Location: kaubahaldus.php");
    exit();
}


if(isSet($_REQUEST["kustutusid"])){
    kustutaKaup($_REQUEST["kustutusid"]);
}
if(isSet($_REQUEST["muutmine"])){
    muudaKaup($_REQUEST["muudetudid"], $_REQUEST["nimetus"],
        $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);  }
$kaubad=kysiKaupadeAndmed();


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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <div style="background-color: white;">

</head>
<body>
<div class="w3-container custom-div"  >
    <div class="w3-card-4" >
<form action="kaubahaldus.php" class="w3-container ">
    <h2 class="w3-container w3-teal" >Kauba lisamine</h2>

        <label>Nimetus:</label>
        <input type="text"  class="w3-input w3-border" name="nimetus" required />
    <label>Kaubagrupp:</label>
    <br>

        <?php
            echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid",   "kaubagrupi_id",true);
            ?>
        <br>
    <br>
        <label> Hind:</label>
     <input type="text"  class="w3-input w3-border" name="hind" required />

    <input type="submit" name="kaubalisamine" value="Lisa kaup" />
    <h2>Grupi lisamine</h2>
    <input type="text" name="uuegrupinimi" />
    <input type="submit" name="grupilisamine" value="Lisa grupp" />  </form>
        <br><br>
    </div>
    <br>
</div>





<form action="kaubahaldus.php" class="w3-container">
    <div class="w3-panel w3-teal">
        <h2>Kaupade loetelu</h2>
    </div>

    Otsi: <input type="text" name="otsisona"  />
    <table class="w3-table w3-bordered w3-hoverable">
        <tr>
            <th>Haldus</th>
            <th><a href="?sort=nimetus">Nimetus</a></th>
            <th><a href="?sort=grupinimi">Kaubagrupp</a></th>
            <th><a href="?sort=hind">Hind</a></th>
        </tr>
        <?php foreach($kaubad as $kaup): ?>
            <tr>
                <?php if(isSet($_REQUEST["muutmisid"]) &&
                    intval($_REQUEST["muutmisid"])==$kaup->id): ?>  <td>
                    <input type="submit" name="muutmine" value="Muuda" />
                    <input type="submit" name="katkestus" value="Katkesta" />
                    <input type="hidden" name="muudetudid" value="<?=$kaup->id ?>" />
                    </td>
                    <td><input type="text" name="nimetus" value="<?=$kaup->nimetus ?>" /></td>  <td><?php
                        echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid",   "kaubagrupi_id");  ?></td>
                    <td><input type="text" name="hind" value="<?=$kaup->hind ?>" /></td>  <?php else: ?>
                    <td><a href="kaubahaldus.php?kustutusid=<?=$kaup->id ?>"  onclick="return confirm('Kas ikka soovid kustutada?')"class="w3-button w3-circle w3-red">Delete</a>
                        <a href="kaubahaldus.php?muutmisid=<?=$kaup->id ?>" class="w3-button w3-circle w3-teal">Modify</a>  </td>
                    <td><?=$kaup->nimetus ?></td>
                    <td><?=$kaup->grupinimi ?></td>
                    <td><?=$kaup->hind ?></td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </table>
</form>

</div>
</div>
</body>
</html>
<style>
    input[type="text"] {
        width: 200px;
        display: flex;

    }


    }
    .custom-div {
        max-width: 400px;
        margin: 0 auto;
    }





</style>
