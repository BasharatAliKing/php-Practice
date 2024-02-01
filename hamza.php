<?php

$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="king";
 
 $conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
 $sql="SELECT * FROM student";
 $result=mysqli_query($conn,$sql);
 if(!$conn){
    die("Connection Failed!");
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
            <?php
              if(isset($_REQUEST['dataadded'])){
                $name=$_REQUEST['name'];
                $roll=$_REQUEST['roll'];
                $address=$_REQUEST['address'];
                  $sql_add="INSERT INTO student (name,roll,address) VALUES ('$name','$roll','$address')";
                         if(mysqli_query($conn,$sql_add)){
                            echo "Data Added..";
                        }else{
                            echo "Error : data not added.";
                        }
                    }
            ?>
            <div class="col-md-4">
                <form action="" method="POST" class="p-3 shadow">
                   <h1 class="text-center">Data Addition.</h1>
                   <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control">
                   </div>
                   <div class="form-group">
                    <label for="roll">Roll:</label>
                    <input type="text" name="roll" class="form-control">
                   </div>
                   <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" class="form-control">
                   </div>
                   <button class="btn btn-success mt-3" name="dataadded">Add Data</button>
                </form>
            </div>
            <div class="offset-md-2 col-md-4">
                <?php
                // Edit data from table or get from table
                  if(isset($_REQUEST['edit'])){
                     $sql_edit="SELECT * FROM student WHERE id={$_REQUEST['id']} ";
                     $result_edit=mysqli_query($conn,$sql_edit);
                     $fetch_table=mysqli_fetch_assoc($result_edit);
                  }
                
                  // update data into table
                  if(isset($_REQUEST['update'])){
                    $id=$_REQUEST['id'];
                    $name=$_REQUEST['name'];
                    $roll=$_REQUEST['roll'];
                    $address=$_REQUEST['address'];
                    $sql_upd="UPDATE student  SET name='$name',roll='$roll',address='$address' WHERE id='$id' ";
                    if(mysqli_query($conn,$sql_upd)){
                        echo "Data Updated!";
                    }else{
                        echo "Error: data not updated error here";
                    }
                  }
                ?>
                <form action="" method="POST" class="p-3 shadow">
                   <h1 class="text-center">Data Updation.</h1>
                   <div class="form-group">
                    <input type="hidden" name="id" value='<?php if(isset($fetch_table['id'])){echo $fetch_table['id'];} ?> ' >
                    <label for="name">Name:</label>
                    <input type="text" name="name" value='<?php if(isset($fetch_table['name'])){echo $fetch_table['name'];} ?> '  class="form-control">
                   </div>
                   <div class="form-group">
                    <label for="roll">Roll:</label>
                    <input type="text" name="roll" value='<?php if(isset($fetch_table['roll'])){echo $fetch_table['roll'];} ?> ' class="form-control">
                   </div>
                   <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" value='<?php if(isset($fetch_table['address'])){echo $fetch_table['address'];} ?> ' class="form-control">
                   </div>
                   <button class="btn btn-warning mt-3" name="update">Update</button>
                </form>
            </div>
            <div class="col-md-12 shadow mt-5">
                <h1 class="text-center">Data Table</h1>
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
                         // for delete a row 
                         if(isset($_REQUEST['delete'])){
                            $sql_del="DELETE FROM student WHERE id={$_REQUEST['id']}";
                            if(mysqli_query($conn,$sql_del)){
                                echo "Data deleted";
                            }
                            else{
                                echo "Error: Data not deleted!";
                            }
                         }

                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['id']  . "</td>" ;
                            echo "<td>" . $row['name']  . "</td>" ;
                            echo "<td>" . $row['roll']  . "</td>" ;
                            echo "<td>" . $row['address']  . "</td>" ;
                            echo '<td> <form method="POST" action="">
                            <button class="btn btn-sm btn-warning" name="edit" >Edit</button>
                            <input type="hidden" name="id" value='. $row['id'] .' >
                            <button class="btn btn-sm btn-danger" name="delete">Delete</button>
                            
                            </form> </td> ';
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