<?php
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="king";
   // make connection
   $conn=new mysqli($db_host,$db_user,$db_password,$db_name);

   //add data into table
   $sql="SELECT * FROM student";
   $result=$conn->query($sql);

   // Delete row from table
   if(isset($_REQUEST['delete'])){
   $sql_del="DELETE FROM student WHERE id={$_REQUEST['id']}";
   if($conn->query($sql_del)){
    echo "Row Deleted From table.";
   }else{
    echo "Error : Data not deleted!";
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
            <div class="col-md-4 shadow p-3">
                <h1 class="text-center">Data Inserted.</h1>
                <?php
                  // data insert into table
                 if(isset($_REQUEST['dataadded'])){
                    if($_REQUEST['name']=="" || $_REQUEST['roll']=="" || $_REQUEST['address']==""){
                        echo '<div class="alert alert-danger" role="alert"> Please Fill all records! </div>';
                    }
                    else{
                        $name=$_REQUEST['name'];
                        $roll=$_REQUEST['roll'];
                        $address=$_REQUEST['address'];
                        $sql_add="INSERT INTO student (name,roll,address) VALUES ('$name','$roll','$address')";
                        if($conn->query($sql_add)){
                            echo '<div class="alert alert-success" role="alert"> Data Insert into Table. </div>';
                        }else{
                            echo "Error: data not added";
                        }
                    }
                 }
                ?>
                <form action="" method="POST">
                    <div class="form-group" class="p-3 ">
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
            <div class="offset-md-1 shadow col-md-7">
                <h1 class="text-center">Table</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Roll</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          while($row=mysqli_fetch_assoc($result)):
                            echo "<tr>";
                            echo "<td>" . $row['id'] .  "</td>";
                            echo "<td>" . $row['name'] .  "</td>";
                            echo "<td>" . $row['roll'] .  "</td>";
                            echo "<td>" . $row['address'] .  "</td>";
                            echo '<td>
                             <form method="POST" action="">
                             <input type="submit" name="edit" class="btn btn-sm btn-warning" value="Edit">
                             <input type="hidden" name="id" value=' . $row['id'] . ' >
                             <input type="submit" name="delete" class="btn btn-sm btn-danger" value="Delete" >
                             </form>
                            </td>';
                           echo "</tr>";
                        endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 shadow p-3">
                <h1 class="text-center">Data Updated.</h1>
                <?php
                  //  get data from table
                  if(isset($_REQUEST['edit'])){
                    $sql_upd="SELECT * FROM student WHERE id={$_REQUEST['id']}";
                    $result_edit=$conn->query($sql_upd);
                    $fetch_data=mysqli_fetch_assoc($result_edit);  
                  }
                   // Update data into database
                   if(isset($_REQUEST['update'])){
                   
                    if($_REQUEST['name']=="" || $_REQUEST['roll']=="" || $_REQUEST['address']==""){
                        echo "Please Fill all fields!";
                    }else{
                        $id=$_REQUEST['id'];
                        $name=$_REQUEST['name'];
                        $roll=$_REQUEST['roll'];
                        $address=$_REQUEST['address'];
                        $sql_upd="UPDATE student SET name='$name', roll='$roll' ,address='$address' WHERE id='$id'";
                        if($conn->query($sql_upd)){
                            echo "Data Updated.";
                        }else{
                            echo "Error: Data not updated!";
                        }
                    }
                   }
                ?>
                <form action="" method="POST">
                    <div class="form-group" class="p-3 ">
                        <input type="hidden" name="id" value='<?php if(isset($fetch_data['id'])){echo $fetch_data['id'];}  ?>'>
                        <label for="name">Name:</label>
                        <input type="text" name="name" value='<?php if(isset($fetch_data['name'])){echo $fetch_data['name'];}  ?>' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="roll">Roll:</label>
                        <input type="text" name="roll" value='<?php if(isset($fetch_data['roll'])){echo $fetch_data['roll'];}  ?>' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" value='<?php if(isset($fetch_data['address'])){echo $fetch_data['address'];}  ?>' class="form-control">
                    </div>
                    <button class="btn btn-warning mt-3" name="update">Update Data</button>
                </form>
            </div>
        </div>
     </div>    
</body>
</html>