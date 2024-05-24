<?php

// include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

  
      // create a new PDO instance
      $pdo = new PDO("mysql:host=localhost;dbname=shop_db", 'root', '');

      // set the PDO error mode to exception
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // check if user already exists
      $stmt = $pdo->prepare("SELECT * FROM `users` WHERE email = :email AND password = :password");
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $pass);
      $stmt->execute();

      if($stmt->rowCount() > 0){
         $message[] = 'user already exists!';
      }
      else{
         if($pass != $cpass) {
            $message[] = 'confirm password not matched!';
         }
         else{
            // insert new user
            $stmt = $pdo->prepare("INSERT INTO `users`(name, email, password, user_type) VALUES(:name, :email, :password, :user_type)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $cpass);
            $stmt->bindParam(':user_type', $user_type);
            $stmt->execute();

            $message[] = 'registered successfully!';
            header('location:login.php');
         }
      }
   } 



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <select name="user_type" class="box">
         <option value="user">user</option>
         <!-- <option value="admin">admin</option> -->
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>