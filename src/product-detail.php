<?php
    require 'database.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$resp=getdata('post',$id);
?>







<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Detail</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #e0f7ff, #f0f9ff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .product-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 8px 16px rgba(0, 120, 220, 0.1);
      padding: 2rem;
      width: 400px;
      max-width: 90%;
      transition: transform 0.3s ease;
      margin-top:100px;
    }


    .header {
        position: absolute;
        top:0px;
        width: 100%;
        margin: 100px;
        margin-top:0px;
  background-color: #9d712c;
  color: white;
  text-align: center;
  padding: 20px;
}




    .product-card:hover {
      transform: scale(1.02);
    }

    .product-image {
      /* background: url('https://via.placeholder.com/400x200/007BFF/ffffff?text=Product+Image+1') no-repeat center center; */
      background-size: cover;
      border-radius: 15px;
      height: 200px;
      margin-bottom: 1.5rem;
    }

    .product-title {
      font-size: 1.8rem;
      color: black;
      margin-bottom: 0.5rem;
    }

    .product-description {
      font-size: 0.95rem;
      color: #333;
      line-height: 1.5;
      margin-bottom: 1rem;
    }

    .price {
      font-size: 1.2rem;
      font-weight: bold;
      color: #12a41e;
      margin-bottom: 1.5rem;
    }

    .contact-box {
      background: #f2f9ff;
      border-left: 4px solid #9d712c;
      padding: 1rem;
      border-radius: 10px;
    }

    .contact-box p {
      margin: 0.5rem 0;
      font-size: 0.95rem;
      color: #333;
    }

    .contact-box p span {
      font-weight: bold;
      color: #9d712c;
    }
  </style>
</head>
<body>


<header class="header">
    <h1>KINBECH – College Market</h1>
    <p>Buy & Sell Goods, Easily</p>
  </header>


  <div class="product-card">
    <div class="product-image" >
      <!-- <img src="img/demo1.jpg" alt="product Image"> -->
    <img src=<?php echo $resp->img[0]   ?> alt="product Image" style="height:100%; width:100%; object-fit:cover; border-radius:15px;">
    </div>
    <div class="product-title"><?php    echo $resp->title;  ?> </div>
    <div class="product-description">
       <?php    echo $resp->des;  ?>
    </div>
    <div class="price">Price: NPR <?php    echo $resp->price;  ?></div>
    <div class="contact-box">
        <b>Contact Seller to negotiate for best price: </b>
      <p><span>Email:</span>  <?php    echo json_decode($resp->contact)->email;  ?></p>
      <p><span>Phone:</span>   <?php    echo json_decode($resp->contact)->phone;  ?></p>
      <p><span>Location:</span>       <?php    echo json_decode($resp->contact)->location;  ?>
      </p>
    </div>
  </div>
</body>
<script>

    console.log(<?php  echo json_encode($resp); ?>);
</script>
</html>