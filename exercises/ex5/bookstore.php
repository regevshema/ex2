<?php
	include "db.php";

	$query = "SELECT * FROM tbl_97_books";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Can't connect to the database");
	}

	$json = file_get_contents('data/books.json');
	$data = json_decode($json, true);
	if ($data) {
		$catagory = $data['catagory'];
	} else {
		echo 'Unable to decode JSON data.';
		exit;
	}

	$catagory_filter = isset($_GET['catagory']) ? $_GET['catagory'] : 'all';
	$filtered_bookslist = [];

    if ($catagory_filter && $catagory_filter !== 'all' && isset($catagory[$catagory_filter])) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['catagory'] === $catagory[$catagory_filter]) {
                $filtered_bookslist[] = $row;
            }
        }
    }
    else {
        while ($row = mysqli_fetch_assoc($result)) {
            $filtered_bookslist[] = $row;
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<title>Books</title>
</head>
<body>
	<div class="container col-md-20">
		<h1>childrens books</h1>
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
			Select Catagory
			</button>
			<ul class="dropdown-menu" aria-labelledby="catagoryDropdown" id="catagoryList">
				<li><a class="dropdown-item" href="?catagory=all">All</a></li>
				<?php
					foreach ($catagory as $catagory => $catagoryName) {
						echo '<li><a class="dropdown-item" href="?catagory='.$catagory.'">'.$catagoryName.'</a></li>';
					}
				?>
			</ul>
		</div>

		<div id="filtered_bookslist$filtered_bookslistContainer">
	    <?php foreach ($filtered_bookslist as $row): ?>
		<div class="card" style="width: 20rem;">
			<img src="<?php echo $row['book_img']; ?>" class="card-img-top" alt="...">
			<div class="card-body">
				<h5 class="card-title"><?php echo $row['book_name']; ?></h5>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Price: <?php echo $row['book_price']; ?></li>
			</ul>
			<div class="card-body">
				<a href="bookpage.php?book_id=<?php echo $row['book_id']; ?>" class="card-link">show book</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>

	</div>
</body>
</html>
<?php
	mysqli_close($connection)
?>