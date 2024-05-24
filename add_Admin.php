<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom admin css file link  -->
<link rel="stylesheet" href="css/admin_style.css">
</head>

<body>
<?php 


include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}?>


<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_contacts.php">messages</a>
         <a href="add_admin.php">add new admin</a>

      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
      </div>

   </div>

</header>

    <style>
    * {
        box-sizing: border-box;
    }
    
    body {
        background-color: #f1f1f1;
        font-family: Arial, sans-serif;
    }
    
    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
        text-align: center;
        color: #333;
    }
    
    form {
        margin-top: 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }
    
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #4CAF50;
    }
    
    .btn {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: #fff;
        text-align: center;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btn:hover {
        background-color: #45a049;
    }
</style>

<div class="container">
    <h1>Add Admin</h1>
    <form action="#" method="post">
        <div class="form-group">
            <label for="admin_name">Name:</label>
            <input type="text" id="admin_name" name="admin_name" required>
        </div>
        <div class="form-group">
            <label for="admin_email">Email :</label>
            <input type="email" id="admin_email" name="admin_email" required>
        </div>
        <div class="form-group">
            <label for="admin_pass">password :</label>
            <input type="password" id="admin_pass" name="admin_pass" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <!-- <input type="text" id="type" name="type" required> -->
            <select name="type" id="">
                <option value="admin">admin</option>
                <option value="user">user</option>

            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="send" id="sub" value="إرسال" class="btn">
        </div>
    </form>
</div>
    
</body>
</html>

<?php




if(isset($_POST['send'])){

    
   $name = mysqli_real_escape_string($conn, $_POST['admin_name']);
   $email = mysqli_real_escape_string($conn, $_POST['admin_email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['admin_pass']));
   $user_type = $_POST['type'];

  

       mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$pass', '$user_type')") or die('query failed');
       $message[] = 'registered successfully!';
       header('location:login.php');
    
 

    

}

?>