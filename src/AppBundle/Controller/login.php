<?php  session_start(); ?>

<?php

if(isset($_SESSION['use']))   // Checking whether the session is already there or not if
    // true then header redirect it to the home page directly
{
    header("Location:home.php");
}

if(isset($_POST['login']))   // it checks whether the user clicked login button or not
{
    $user = $_POST['user'];

    if($user = $_POST['user'])  {

        $_SESSION['use']=$user;


        echo '<script type="text/javascript"> window.open("home.php","_self");</script>';

    }

    else
    {
        echo "invalid UserName or Password";
    }
}
?>

<html>
<head>

    <title> Login Page   </title>

</head>

<body>

<form action="" method="post">

    <table width="200" border="0">
        <tr>
            <td>  UserName</td>
            <td> <input type="text" name="user" > </td>
        </tr>
        <tr>
            <td> <input type="submit" name="login" value="LOGIN"></td>
            <td></td>
        </tr>
    </table>
</form>

</body>
</html>