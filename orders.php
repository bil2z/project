<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading" style="background-image: url('../project/img/%D8%B3%D8%A7%D8%B9%D8%A7%D8%AA-%D8%A7%D8%A8%D9%84-%D8%B3%D8%A8%D9%88%D8%B1%D8%AA-%D9%83%D9%84%D8%A7%D8%B3%D9%8A%D9%83\ \(1\).jpg');">
        <h3>your orders</h3>
    </div>

    <section class="placed-orders">


        <div class="box-container">

            <?php
           
                $pdo = new PDO("mysql:host=localhost;dbname=shop_db", 'root', '');

                $order_query = $pdo->query("SELECT * FROM `orders` WHERE user_id = '$user_id'");
                if ($order_query->rowCount() > 0) {
                    while ($fetch_orders = $order_query->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="box">
                            <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                            <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                            <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                            <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                            <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                            <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                            <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                            <p> total price : <span>$<?php echo $fetch_orders['total_price']; ?></span> </p>
                          
                        </div>
                    <?php
                    }
                } else {
                    echo '<p class="empty">no orders placed yet!</p>';
                }
           
            ?>
        </div>

    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>