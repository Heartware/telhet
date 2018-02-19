<?php
include 'db_recs.php';
CRYPT_BLOWFISH;

$message = '';
$username = 'pjtw.hartman@gmail.com';
$password = 'Pollie55!';

if (isset($_POST['btnlogin'])):
    if (isset($_SESSION['teller'])){unset($_SESSION['teller']);}
    $username = $_POST['txtusername'];
    $username_up = strtoupper($_POST['txtusername']);
    $password = $_POST['txtpassword'];
    $_SESSION['persoon'] = new C_persoon();
    $_SESSION['persoon']->get_persoon(0, $username_up, $_SESSION['persoon']);
    validatePassword($_SESSION['persoon']->ww, $password . $username_up, FALSE)?alert("Ok"):alert('Kloten');
    if (($_SESSION['persoon']->id > 0) 
            && (validatePassword($_SESSION['persoon']->ww, $password . $username_up, FALSE))) {
        $_SESSION['username'] = $username_up;
        header('location:' . '/Telhet/menu.php');
        die();
    } else {
        $message = " Login failed ";
    }
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type="text/css">
            div#error  {font-size:140%; font-weight: bold; color:red;}
        </style>
    </head>
    <body>
        <?php
        if (!empty($message)):
            print "<div id=error>$message</div>";
        endif;
        ?>
        <h2>Log in</h2>
        <form method="post" action="">
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="txtusername"
                               value ="<?php echo $username ?>"> </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="txtpassword"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnlogin" value="Log in"></td>
                </tr>
<!--                <tr>
                    <td>Wat is het pw?</td>
                    <td><input type="text" name="txtinvoer" value="<?php echo $_SESSION['pw']; ?>"></td>
                </tr>-->
            </table>
        </form>
<!--<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>-->

    </body>
</html>
