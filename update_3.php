<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<?php
$hostname='localhost';
$db_name='phpgallery';
$username='root';
$password='';
try {
    $con = new PDO("mysql:host=$hostname;dbname=$db_name",$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "<div class='alert alert-success'>Connection Established Sucessfully.</div>";
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
$id=$_GET['uid'];
$title=$_POST['title'];
$description=$_POST['description'];


$status=1;
$query=" UPDATE  images SET title=:title, description=:description,   status=:status where id=:id";
$stmt=$con->prepare($query);
$stmt->bindValue(':id', $id);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':description', $description);

$stmt->bindParam(':status', $status);

if($stmt->execute())
{
    echo "<div class='alert alert-success'>User Update SuccessFully.</div>";
    echo "<a  class='btn btn-md btn-danger' href='index.php'>Go Back </a>";
}
else{
    echo "<div class='alert alert-danger'>User Upate Failed.</div>";
    echo "<a  class='btn btn-md btn-danger' href='index.php'>Go Back </a>";
}
?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>