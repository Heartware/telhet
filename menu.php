<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
function validate_email( $ field) { if ($ field = = "") return "No Email was entered < br >"; else if (!(( strpos( $ field, ".") > 0) && (strpos( $ field, "@") > 0)) | | preg_match("/[ ^ a-zA-Z0-9.@_-]/", $ field)) return "The Email address is invalid < br >"; return ""; } function fix_string( $ string) { if (get_magic_quotes_gpc()) $ string = stripslashes( $ string); return

Nixon, Robin. Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5 (Learning Php, Mysql, Javascript, Css & Html5) (Kindle Locations 7974-7980). O'Reilly Media. Kindle Edition. 
-->
<?php
include 'db_recs.php';
//    $_SESSION['originalpage'] = $_SERVER['PHP_SELF'];
$done = isset($_SESSION['teller']);
if (!$done) {
    $_SESSION['teller'] = array();
    $_SESSION['teller'][0] = new C_tel();
    $_SESSION['teller'][0]->get_teller(0, $_SESSION['persoon']->id, '', 0, $_SESSION['teller'][0]);
    $tel = 0;
    while ($_SESSION['teller'][$tel]->pers_id == $_SESSION['persoon']->id) {
        $tel++;
        $_SESSION['teller'][$tel] = new C_tel();
        $_SESSION['teller'][$tel]->get_teller(0, $_SESSION['persoon']->id,  $_SESSION['teller'][$tel - 1]->Item, 1, $_SESSION['teller'][$tel]);
    }

//    $_SESSION['persoon'] = new C_persoon();
//    $_SESSION['persoon'] =
//    $_SESSION['persoon']->get_persoon(25, '', $_SESSION['persoon']);

    define("IEDERS_RECHT", 1);
    define("INGELOGD", IEDERS_RECHT << 1);
    define("BESTEL_RECHT", INGELOGD << 1);
    define("DRANKINVOER_RECHT", BESTEL_RECHT << 1);
    define("LOCATIE_RECHT", DRANKINVOER_RECHT << 1);
    define("BOEKHOUD_RECHT", LOCATIE_RECHT << 1);
    define("ADMIN_RECHT", BOEKHOUD_RECHT << 1);


    $menuar = array();
    $menuar[0]["titel"] = "inloggen";
    $menuar[0]["rechten"] = IEDERS_RECHT;
    $menuar[0]["ref"] = "login.php";
    $menuar[1]["titel"] = "registreren";
    $menuar[1]["rechten"] = IEDERS_RECHT;
    $menuar[1]["ref"] = "registreren.php";
    $menuar[2]["titel"] = "Tellen";
    $menuar[2]["rechten"] = INGELOGD;
    $menuar[2]["ref"] = "tellen.php";
    $menuar[3]["titel"] = "Instellingen ";
    $menuar[3]["rechten"] = ADMIN_RECHT;
    $menuar[3]["ref"] = "instelling.php";

    $rechten = $_SESSION['persoon']->rechten;
}//end of if
// elke loop
$tel = count($_SESSION['teller']) - 1;
for ($i = 0; $i < $tel; $i++) {
    if (isset($_POST['teller' . $i])) {
        $_SESSION['teller'][$i]->teller += $_SESSION['teller'][$i]->optellen;
        update_record('todo', $_SESSION['teller'][$i]);
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hoofdmenu</title>
        <link rel="stylesheet" href="css/handig.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <form  action="" method="post"
               >
            <ul class="menu"><li><h1>Lijstje van <?php echo $_SESSION['persoon']->naam ?></h1></li>
<?php
for ($i = 0; $i < $tel; $i++) {
    echo '<li class="menu>">'
    . '<input type="submit" name= "teller' . $i
    . '"  class="btn btn-lg btn-primary " width=700px Value="' .
    $_SESSION['teller'][$i]->Item . ' = ' . $_SESSION['teller'][$i]->teller . '"';
//    echo '" <h1 class="badge badge-secondary">' . $_SESSION['teller'][$i]->teller."</h1>";
    echo '</input></li>';
}
?>
            </ul>
            <a class="btn btn-lg btn-primary " width=700px href="tellerinvoer.php">
                Invoeren Items </a>
            
        </form>  
    </body>
</html>
