<?php
  //Make connection here
  $db_host="localhost";
  $db_user="root";
  $db_password="";
  $db_name="student";
   // Make connection
  $conn= mysqli_connect($db_host,$db_user,$db_password,$db_name);
  if(!$conn){
    die("Connection Failed");
  };
  $sql="SELECT * FROM login";
  $result=mysqli_query($conn,$sql);
//   if(mysqli_num_rows($result) >0){
//    while ($row=mysqli_fetch_assoc($result)){
//     echo $row["id"] . $row["name"] . $row["roll"] . $row["address"] ;
//    }
//   }
// <!-- Add data to database-->

    if(isset($_REQUEST['submitform'])){
      $name=$_REQUEST['name'];
      $roll=$_REQUEST['roll'];
      $address=$_REQUEST['address'];
        $sql_add="INSERT INTO login (name,roll,address) VALUES ('$name','$roll','$address')";
        if(mysqli_query($conn,$sql_add)){
          echo "New Record Added";
      }else{
        echo "Unable to add recond";
      }
    }

    // <!--Delete Data from databaase-->
    if(isset($_REQUEST['submit'])){
      $sqldel = "DELETE FROM login WHERE id={$_REQUEST['id']}";
      if(mysqli_query($conn,$sqldel)){
        echo "Record Deleted!";
      }else{
        echo "Unable to Delete the Record!!!";
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn Php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  </head>
<body>
 <div class="container">
  <div class="row">
    <div class="col-md-4 shadow m-auto">
      <h3 class="text-center">Form</h3>
     <form action="" method="POST" class="p-3">
     <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">Roll:</label>
        <input type="text" name="roll" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">Address:</label>
        <input type="text" name="address" class="form-control">
      </div>
      <button name="submitform" value="Submit" class="btn btn-primary mx-auto mt-3 text-center">Submit</button>
     </form>
    </div>
    <div class="col-md-6">
      
<table class="table">
  <tr>
    <th style="padding:2px">id</th>
    <th style="padding:2px">Name</th>
    <th style="padding:2px">Roll</th>
    <th style="padding:2px">Address</th>
    <th style="padding:2px">Action</th>
  </tr>
  <?php while($row=mysqli_fetch_assoc($result)){ 
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["roll"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo '<td> <form action="" method="POST">
        <input type="hidden" name="id" value='. $row['id'] .'>
        <input type="submit" class="btn btn-danger btn-sm" name="submit" value="Delete"></form> </td>';
   } ?>
</table>
    </div>
  </div>
 </div>

</body>
</html>