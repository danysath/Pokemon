<!DOCTYPE HTML>
<html>
<head>
    <title>PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>


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
$query="SELECT * from images where id=:id";
$stmt=$con->prepare($query);
$stmt->bindValue(':id', $id);
$res=$stmt->execute();
$images = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <div class="container">
        <div class="page-header">
            <h1>Edit User</h1>
        </div>
        <form action="update_3.php?uid=<?=$images['id']?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td> First Name</td>
                    <td><input type='text' name='title' class='form-control' value='<?=$images['title']?>' />
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='description' class='form-control' value='<?=$images['description']?>' /></td>
                </tr>
           
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Update' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to User List</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>