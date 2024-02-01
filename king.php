<?php 
 $db_host="localhost";
 $db_user="root";
 $db_password="";
 $db_name="king";
 $conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
 $sql="SELECT * FROM student";
 $result=mysqli_query($conn,$sql);
 if(!$result){
    die("connection Failed!!");
 };
  
  // Send Data into Database
//   if(isset($_REQUEST["submitform"])){
//     $name=$_REQUEST["name"];
//     $roll=$_REQUEST["roll"];
//     $address=$_REQUEST["address"];
//     $sql_add="INSERT INTO student (name,roll,address) VALUES ('$name','$roll','$address')";
//     if(mysqli_query($conn,$sql_add)){
//         echo "Data Added into Database";
//     }else{
//         echo "Error: Data not added... ";
//     }
//   }

  // Delete data from table
//   if(isset($_REQUEST['deletebtn'])){
//     $sql_del="DELETE FROM student WHERE id={$_REQUEST['id'] }";
//     if(mysqli_query($conn,$sql_del)){
//         echo "Data Deleted from table..";
//     }else{
//         echo "Error: Data not deleted!!";
//     }
//   }
 
  // Update data from table 

  if(isset($_REQUEST['update'])){
    if($_REQUEST['name']=="" || $_REQUEST['roll']=="" || $_REQUEST['address']==""){
        echo "fill All Fields!";
    }
    else{
        $name=$_REQUEST['name'];
        $roll=$_REQUEST['roll'];
        $address=$_REQUEST['address'];
        $sql_upd="UPDATE student SET name='$name', roll='$roll', address='$address' WHERE id={$_REQUEST['id']}";
        if(mysqli_query($conn,$sql_upd)){
         echo "Data updated!!";
        }else{
         echo "Error: data not update...";
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
     <div class="container py-5">
        <div class="row">
        <div class="col-md-4">
        <!-- <form action="" method="POST"  class="p-4 shadow">
         <div class="form-group">
         <label for="name">Name:</label>
         <input type="text" name="name" required class="form-control">
         </div>
         <div class="form-group">
         <label for="name">Roll:</label>
         <input type="text" name="roll" required class="form-control">
         </div>
         <div class="form-group">
         <label for="name">Address:</label>
         <input type="text" name="address" required class="form-control">
         </div>
         <button class="btn btn-primary btn-sm mt-3 mx-auto" name="submitform" value="submit">Submit</button>
        </form> -->
        </div>
            <div class="offset-md-1 col-md-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name:</th>
                            <th>Roll</th>
                            <th>Address</th>
                            <th style="width:90px; ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>". $row["id"] ."</td>";
                            echo "<td>". $row["name"] ."</td>";
                            echo "<td>". $row["roll"] ."</td>";
                            echo "<td>". $row["address"] ."</td>";
                            echo '<td style="display:flex; flex-direction:row; row-gap-3;">
                            <button class="btn btn-success btn-sm" name="edit" type="submit" >Update</button>
                            <form action="" method="POST">
                            <input type="hidden" name="id" value='. $row["id"] .' >
                            <input type="submit" name="deletebtn" value="Delete" class="btn btn-danger btn-sm" >
                            </form> </td>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <?php
                 // edit data
   if(isset($_REQUEST['edit'])){
    $sql_edit="SELECT * FROM student WHERE id={$_REQUEST['id']}";
    $edit_data=mysqli_query($conn,$sql_edit);
    $fetchdata=mysqli_fetch_assoc($edit_data);
   }
                ?>
            <form action="" method="POST"  class="p-4 shadow">
         <div class="form-group">
         <label for="name">Name:</label>
         <input type="text" name="name" value="<?php if(isset($fetchdata["name"])){ echo $fetchdata["name"]; }  ?>" required class="form-control">
         </div>
         <div class="form-group">
         <label for="name">Roll:</label>
         <input type="text" name="roll" value="<?php if(isset($fetchdata["roll"])){ echo $fetchdata["roll"]; }  ?>" required class="form-control">
         </div>
         <div class="form-group">
         <label for="name">Address:</label>
         <input type="text" name="address" value="<?php if(isset($fetchdata["address"])){ echo $fetchdata["address"]; }  ?>" required class="form-control">
         </div>
         <button class="btn btn-primary btn-sm mt-3 mx-auto" name="update" value="submit">Update</button>
        </form>
            </div>
        </div>
     </div>
</body>
</html>