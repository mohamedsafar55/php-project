<?php


$host = "localhost";
$user = "root";
$password = "";
$dbName = "training_company";
$conn = mysqli_connect($host, $user, $password, $dbName);

// if($conn){
//     echo " <h1 class= 'text-info text-center'> true conected </h1>";
// }else{
//     echo " <h1 class= 'text-info text-danger'> false conected </h1>";
// }


// ===========  insert data ==========//

if (isset($_POST['send'])) {
    $course = $_POST['course'];
    $cost = $_POST['cost'];

    $insert = "INSERT INTO `courses` VALUES (null, '$course' , $cost)";
    $i = mysqli_query($conn, $insert);
}


// =========== READ SELECT==========//

$select = "SELECT * FROM `courses`";
$s = mysqli_query($conn, $select);

// =========== delete SELECT==========//

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM `courses` Where course_id = $id ";
    mysqli_query($conn, $delete);
}

// =========== edit data ==========//

$course = '';
$cost = ''; 


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM `courses` WHERE course_id = $id";
    $ss = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($ss);

    $course = $row['course'];
    $cost = $row['cost'];

    if (isset($_POST['update'])) {
        $course = $_POST['course'];
        $cost = $_POST['cost'];
        $update = "UPDATE `courses` SET course = '$course' , cost = $cost WHERE course_id = $id ";
        $u = mysqli_query($conn, $update);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./main.css">
    <title>Document</title>

</head>

<body>

    <div class="container col-6">
        <div class="card">
            <div class="card-bady">
                <h2 class=" text-info text-center"> CRUD operation </h2>
                <form method="POST">
                    <div class="form-group">
                        <label style="margin-left: 10px;"> Course_Name </label>
                        <input name="course" type="text" value="<?php echo $course  ?>" class="form-control " placeholder=" Course name">
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 10px;"> Course_cost </label>
                        <input name="cost" type="text" value="<?php echo $cost ?>" class="form-control" placeholder=" Course cost">
                    </div>
                    <div class="mx-auto w-25">
                        <BUtton name="send" class="btn btn-info mt-2 w-100"> Send Data</BUtton>
                        <BUtton name="update" class="btn btn-info mt-2 w-100"> Update Data</BUtton>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="container col-6 mt-2">
        <div class="card">
            <div class="card-bady">
                <table class="table table-secandery">
                    <tr>
                        <th> ID</th>
                        <th> Course</th>
                        <th> Cost</th>
                        <th> action</th>
                    </tr>

                    <?php foreach ($s as $data) { ?>
                        <tr>
                            <td><?php echo $data['course_id'] . "<br>";  ?></td>
                            <td><?php echo $data['course'] . "<br>";  ?></td>
                            <td><?php echo $data['cost'] . "<br>";  ?></td>
                            <td> <a href="index.php?edit=<?php echo $data['course_id'] ?>" class="btn btn-danger ml-6">Edit</a>

                                <a href="index.php?delete=<?php echo $data['course_id'] ?>" class="btn btn-info ml-6">Delete</a>
                            </td>
                        </tr>
                    <?php  }  ?>

                </table>
            </div>
        </div>
    </div>










</body>

</html>