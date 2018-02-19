<?php
\session_start();
$message = '';
$username = '';
$password = '';
$password2 = '';
if (isset($_POST['btnlogin'])):
    $username = $_POST['txtusername'];
    $password = $_POST['txtpassword'];
    $password2 = $_POST['txtpassword2'];
    if ($password === $password2):
        $message = "Passwords do match!";
    else:
        $message = "Passwords do not match.";
    endif;
    echo "<script type='text/javascript'>alert('$message');</script>";
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
        <h2>Registreer email_up en password</h2>
        <form method="post" action="">
            <table>
                <tr>
                    <td>email_up:</td>
                    <td><input type="text" name="txtusername1"
                               value ="<?php echo $username ?>"> </td>
                    <td>Re-enter email_up:</td>
                    <td><input type="text" name="txtusername2"
                               value ="<?php echo $username ?>"> </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="txtpassword1"></td>
                </tr>
                <tr>
                    <td>Re-enter Password:</td>
                    <td><input type="password" name="txtpassword2"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnlogin" value="Log in"></td>
                </tr>
            </table>
        </form>


    </body>
</html>
