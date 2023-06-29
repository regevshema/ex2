<?php 
   
    include "db.php";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(mysqli_connect_errno()) {
        die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
    }
?>

<?php
    $bookId = $_GET["book_id"];
    $query  = "SELECT * FROM tbl_97_books WHERE book_id = " . $bookId;
    $result = mysqli_query($connection, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("DB query failed.");
    }
?>


<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">  
    <title>book_page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        echo    '<div class="container"> ';
        echo    '<div class="card" style="width: 30rem;">';
        echo        '<img src="' .$row["book_img"].'"class="card-img-top" alt="...">';
        echo        '<img src="' .$row["book_img2"].'"class="card-img-top" alt="...">';
        echo        '<div class="card-body">';
        echo            '<h2 class="card-title">' .$row["book_name"]. '</h2>';
        echo            '<h4 class="list-group-item">Price: ' .$row["book_price"]. '</h4>';     
        echo            '<h4 class="list-group-item">Category: ' .$row["catagory"]. '</h4>';
        echo            '<a href="bookstore.php" class="btn btn-primary">Back to store</a>';
        echo        '</div>';
        echo    '</div>';
    ?>
        <?php 
        mysqli_free_result($result);
        ?>
        </div>
    </body>
</html>

<?php
    mysqli_close($connection);
?>
