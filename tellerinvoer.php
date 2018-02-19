<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'db_recs.php';
//
//if ((isset($_POST['ed_teller'])) || (isset($_POST['inv_teller']))) {
//    foreach ($_SESSION['teller'] as $key => $value) {
//        if (edit_field_teller($key)) {
//            $_SESSION['teller']["$key"] = $_POST["$key"];
//        }
//    }
//}
//
//if (isset($_POST['ed_teller'])) {
//    $_SESSION['teller']->update_teller($_SESSION['teller']);
//} elseif ((isset($_POST['inv_teller']))) {
//    $_SESSION['teller']->insert_teller($_SESSION['teller']);
//} elseif (isset($_POST['zk_teller'])) {
//    $_SESSION['teller'] = $_SESSION['teller']->get_teller(0, $_POST['naam'],0);
//} elseif (isset($_POST['prev_teller'])) {
//    $_SESSION['teller'] = $_SESSION['teller']->get_teller(0, $_SESSION['teller']['naam'],-1);
//} elseif (isset($_POST['next_teller'])) {
//    $_SESSION['teller'] = $_SESSION['teller']->get_teller(0, $_SESSION['teller']['naam'],1);
//}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Items invoeren/zoeken</title>
        <link rel="stylesheet" href="css/handig.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">     
    </head>
    <body>
        <h1>Verander/Invoer Items</h1>
        <form action="" method="post" >
            <table>
<?php
$tel = count($_SESSION['teller']) - 1;
//echo $tel.brk();
//echo $_SESSION['teller'][0]->Item.brk();
//exit;

foreach ($_SESSION['teller'][0] as $key => $value) {
    if ($_SESSION['teller'][0]->edit_field_teller($key)) {
        echo "<tr><td>";
        //    echo $value . brk();
        echo $key . '</td><td><input type="text" name="' . $key . '" value="' . $value . '"/>';
        echo "</td><tr>";
    }
}
echo "    </table>";
echo "<a href=" . $_SESSION['originalpage'] . " class=\"btn btn-lg btn-warning w-100 p-3\" >Terug! </a>"
// put your code here
?>
                <input type="submit" name="ed_teller" value="Bewaar " class="btn btn-lg btn-primary w-100 p-3" >
                <input type="submit" name="inv_teller" value="Toevoegen " class="btn btn-lg btn-success w-100 p-3" >
                <input type="submit" name="zk_teller" value="Zoek " class="btn btn-lg btn-success w-100 p-3" ></br>
                <input type="submit" name="prev_teller" value="Vorige " class="btn btn-lg btn-success w-100 p-3" >
                <input type="submit" name="next_teller" value="Volgende " class="btn btn-lg btn-success w-100 p-3" ></br>


                </form>
                </body>
                </html>

