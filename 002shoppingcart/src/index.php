<html>
 <head>
  <title>Hello...</title>

  <meta charset="utf-8">

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
    <?php echo "<h1>Hi! Welcome to our unofficial shop</h1>"; ?>

    <?php

    // Connexion et sélection de la base
    $conn = mysqli_connect('002shoppingcartdb', 'not_brutforsable_user', 'not_brutforsable_password', "myDb");


    $query = 'SELECT * From products';
    $result = mysqli_query($conn, $query);

    echo '<table class="table table-striped">';
    echo '<thead><tr><th></th><th> </th><th>name</th><th>id</th><th>price</th><th>image</th></tr></thead>';
    while($value = $result->fetch_array(MYSQLI_ASSOC)){
        echo '<tr>';
        echo '<td><a href="/shopping-cart.php"><span class="glyphicon glyphicon-search"></span></a></td>';
        foreach($value as $element){
            echo '<td>' . $element . '</td>';
        }

        echo '</tr>';
    }
    echo '</table>';

    /* Libération du jeu de résultats */
    $result->close();

    mysqli_close($conn);

    ?>
    </div>
</body>
</html>
