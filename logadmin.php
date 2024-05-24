<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">email:</label>
        <input type="email" name="nameu" id="">
        <label for="">password:</label>
        <input type="password" name="pass" id="">
        <input type="submit" name="sendad" id="">
    </form>
<?php 

include 'config.php';
session_start();

if(isset($_POST['sendad'])){

    $name = mysqli_real_escape_string($conn, $_POST['nameu']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
  
    // $name=$_POST['nameu'];
    // $pass=$_POST['pass'];
    // $pass=md5($_POST['pass']);

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$name' AND password='$pass'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0)

       $row = mysqli_fetch_assoc($select_users);

if(isset($_POST['sendad'])){

    if($row['email'] == $name and $row['password']==$pass){

        // $_SESSION['user_name'] = $row['name'];
        // $_SESSION['user_email'] = $row['email'];
        // $_SESSION['user_id'] = $row['id'];
        header('location:admin_page.php');

     }
     else{
        echo 'not found same';
     }
    }
}
?>
</body>
</html>