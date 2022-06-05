<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$stmt = $pdo->query('SELECT * FROM images ORDER BY uploaded_date DESC');
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('')?>

<div class="content home">
	<h2>Pokémon</h2>
	
	<a href="upload.php" class="upload-image">Upload Image</a>
	
	<div class="images">
		<?php foreach ($images as $image): ?>
		<?php if (file_exists($image['filepath'])): ?>
		<a href="#">
			<img src="<?=$image['filepath']?>" alt="<?=$image['description']?>" data-id="<?=$image['id']?>" data-title="<?=$image['title']?>" width="300" height="200">
			<span><?=$image['description']?></span>
			
		</a>
		<?php endif; ?>
		<?php endforeach; ?>
		
	</div>
</div>


<div class="image-popup"></div>

<script>

let image_popup = document.querySelector('.image-popup');

document.querySelectorAll('.images a').forEach(img_link => {
	img_link.onclick = e => {
		e.preventDefault();
		let img_meta = img_link.querySelector('img');
		let img = new Image();
		img.onload = () => {
		
			image_popup.innerHTML = `
				<div class="con">
					<h3>${img_meta.dataset.title}</h3>
					<p>${img_meta.alt}</p>
					<img src="${img.src}" width="500" height="500">
					<a href="delete.php?id=${img_meta.dataset.id}" class="trash" title="Delete Image"><i class="fas fa-trash fa-xs"></i>Delete</a>
					
				</div>`;
			image_popup.style.display = 'flex';
		};
		img.src = img_meta.src;
	};
});



image_popup.onclick = e => {
	if (e.target.className == 'image-popup') {
		image_popup.style.display = "none";
	}
};
</script>

<?=template_footer()?>


<!DOCTYPE HTML>
<html>

<head>
    <title>PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Update data</h1>
        </div>
        <?php
            $hostname = 'localhost';
            $db_name = 'phpgallery';
            $username = 'root';
            $password = '';
            try {
                $con = new PDO("mysql:host=$hostname;dbname=$db_name",$username,$password);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<div class='alert alert-success'>Connection Established Sucessfully.</div>";
            }
            catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
            $query = "SELECT * from images";
            $stmt = $con->prepare($query);
            $stmt->execute();
        ?>
        <br />
        
        <br />
        <table class='table table-hover table-responsive table-bordered'>
            <br />
            <thead>
                <tr>
                    <th>ID</th>
                    <th>title</th>
                    <th>description</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
        <?php
        if($stmt->rowCount()>0){
             $result=$stmt->fetchAll();
            ?>
            <tbody>
                <?php $count=1;
                foreach($result as $images){ ?>
                <tr>
                    <td> <?= $count++ ?> </td>
                    <td> <?= $images['title'] ?> </td>
                    <td> <?= $images['description'] ?> </td>
                    
                    <td>
                        <a href='update_2.php?uid=<?= $images['id'] ?>' class='btn btn-primary m-r-1em'>Edit</a>

                        
                          
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <?php  }
        else{
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>