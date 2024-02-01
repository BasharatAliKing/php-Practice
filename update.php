<?php
  $db_host="localhost";
  $db_user="root";
  $db_password="";
  $db_name="king";
  $conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
  if(!$conn){
    die("connection Failed!!");
  }
  $sql="SELECT * FROM student ";
  $result=mysqli_query($conn,$sql);

  // edit data
  if(isset($_REQUEST['edit'])){
    $sql_edit="SELECT * FROM student WHERE id={$_REQUEST['id']}";
  $result_edit=mysqli_query($conn,$sql_edit);
  $row_fetch=mysqli_fetch_assoc($result_edit);
  }

  // Update data into table
  if(isset($_REQUEST["update"])){
    if($_REQUEST['name']=='' || $_REQUEST['roll']=="" || $_REQUEST['address']==""){
        echo "Please Fill All fields!";
    }
    else{
        $id=$_REQUEST["id"];
        $name=$_REQUEST["name"];
        $roll=$_REQUEST["roll"];
        $address=$_REQUEST["address"];
        $sql_upd="UPDATE student SET name='$name', roll='$roll',address='$address' WHERE id='$id' ";
        if(mysqli_query($conn,$sql_upd)){
            echo "Data Updated into Table";
        }else{
            echo "Error : Data not added";
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class=" col-md-4">
                <form action="" method="POST" class="p-3 shadow">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php if(isset($row_fetch['id'])){echo $row_fetch['id'] ;}  ?>">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php if(isset($row_fetch['name'])){echo $row_fetch['name'];} ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="roll">Roll:</label>
                        <input type="text" name="roll" value="<?php if(isset($row_fetch['roll'])){echo $row_fetch['roll'];} ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" value="<?php if(isset($row_fetch['address'])){echo $row_fetch['address'];} ?>" class="form-control">
                    </div>
                    <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="offset-md-1 col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Roll</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      while($row=mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo  "<td>" . $row["id"] . "</td>";
                        echo  "<td>" . $row["name"] . "</td>";
                        echo  "<td>" . $row["roll"] . "</td>";
                        echo  "<td>" . $row["address"] . "</td>";
                        echo  '<td> 
                        <form method="POST" action="">
                        <input type="hidden" name="id" value=' . $row["id"] . ' >
                        <button class="btn btn-sm btn-warning" name="edit" value="edit" type="submit">Edit</button>
                        </form>
                        </td>';
                        echo "</tr>";
                      }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>