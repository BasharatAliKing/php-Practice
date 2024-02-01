<?php
 
  //create Connection
  $dbn="mysql:host=localhost; dbname=king";
  $db_user="root";
  $db_password="";
  try{
    $conn=new PDO($dbn,$db_user,$db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo " <b> Connected </b>  <br> <hr>";   
    // Add data into table through PDO
    if(isset($_REQUEST['dataadded'])){
        if($_REQUEST['name']=="" || $_REQUEST['roll']=="" || $_REQUEST['address']==""){
            echo "Please Fill All Fields.";
        }else{
            $name=$_REQUEST['name'];
            $roll=$_REQUEST['roll'];
            $address=$_REQUEST['address'];
            $sql_add="INSERT INTO student (name,roll,address) VALUES ('$name','$roll','$address')";
            $affected_row=$conn->exec($sql_add);
            echo $affected_row. "Row Inserted <br>";
        } 
    }
     //delete data from table
     if(isset($_REQUEST['delete'])){
        $sql_del="DELETE FROM student WHERE id={$_REQUEST['id']} ";
        $affected_row=$conn->exec($sql_del);
        echo $affected_row . "Row Deleted";
     }
       //edit data to talble
       if(isset($_REQUEST['edit'])){
        $sql_edit="SELECT * FROM student WHERE id={$_REQUEST['id']} ";
        $result=$conn->query($sql_edit);
        $fetch_table=$result->fetch(PDO::FETCH_ASSOC);
     }
     //Update data into table code
     if(isset($_REQUEST['update'])){
        // checking for any empty field!
        if($_REQUEST['name']=="" || $_REQUEST['roll']=="" || $_REQUEST['address']==""){
            echo "Please Fill All Fields..";
        }
        else{
            $id=$_REQUEST['id'];
            $name=$_REQUEST['name'];
            $roll=$_REQUEST['roll'];
            $address=$_REQUEST['address'];
            $sql_upd="UPDATE student SET name='$name', roll='$roll', address='$address' WHERE id='$id' ";
            $affected_row=$conn->exec($sql_upd);
            echo $affected_row. "Row Updated Successfully <br>";
        }
       
     }

  }
  catch(PDOException $e){
        echo "Connection Faild " .$e->getmessage();
  };

  $sql="SELECT * FROM student";

  $result=$conn->query($sql);
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
            <div class="col-md-10 shadow">
                <table class="table mt-3 p-3">
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
                    foreach($result->fetchAll(PDO::FETCH_ASSOC) as $row){
                        echo "<tr>";
                            echo "<td>" . $row['id']  . "</td>" ;
                            echo "<td>" . $row['name']  . "</td>" ;
                            echo "<td>" . $row['roll']  . "</td>" ;
                            echo "<td>" . $row['address']  . "</td>" ;
                            echo '<td> 
                            <form action="" method="POST">
                            <button class="btn btn-sm btn-warning" name="edit">Edit</button>
                            <input type="hidden" name="id" value=' . $row['id'] .  ' >
                            <button class="btn btn-sm btn-danger" name="delete">Delete</button>
                            </form>
                            </td>';
                        echo  "</tr>";
                    }
                  ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>