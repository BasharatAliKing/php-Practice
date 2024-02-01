<?php
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="king";
$conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);

$sql= "SELECT * FROM student";
$result=mysqli_query($conn,$sql);
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
                <?php
                //  Add data into table & Database
                  if(isset($_REQUEST['adddata'])){
                    $name=$_REQUEST["name"];
                    $roll=$_REQUEST["roll"];
                    $address=$_REQUEST["address"];
                    $sql_add="INSERT INTO student (name,roll,address) VALUES ('$name','$roll','$address')";
                    if(mysqli_query($conn,$sql_add)){
                        echo "data Added into Table";
                    }else{
                        echo "Error :data not added...";
                    }
                  }
                ?>
                <form action="" method="POST" class="p-3 shadow">
                    <div class="form-group">
                        <h2 class="text-center">Data Addition.</h2>
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
                    <button class="btn btn-primary mt-3" name="adddata" type="submit">ADD Data</button>
                </form>
            </div>
            <div class="offset-md-3 col-md-4">
                <?php
                  //edit data into table
                 if(isset($_REQUEST['editrow'])){
                    $sql_edit="SELECT * FROM student WHERE id={$_REQUEST['id']}";
                    $result_edit=mysqli_query($conn,$sql_edit);
                    $fetch_edit=mysqli_fetch_assoc($result_edit);
                 }
                  //update data into table
                  if(isset($_REQUEST['updatedata'])){
                    if($_REQUEST['name']=="" || $_REQUEST['roll']=="" || $_REQUEST['address']==""){
                        echo "Please Fill All Fields.";
                    }
                    else{
                        $id=$_REQUEST['id'];
                        $name=$_REQUEST['name'];
                        $roll=$_REQUEST['roll'];
                        $address=$_REQUEST['address'];
                        $sql_upd="UPDATE  student SET name='$name',roll='$roll', address='$address' WHERE id='$id' ";
                        if(mysqli_query($conn,$sql_upd)){
                            echo "DAta Updated into table ..";
                        }else{
                            echo "Error : data not updated! ";
                        }
                    }
                   
                  }

                ?>
                <form action="" method="POST" class="p-3 shadow">
                    <div class="form-group">
                        <h2 class="text-center">Data Update.</h2>
                        <input type="hidden" name="id" value="<?php if(isset($fetch_edit['id'])){echo $fetch_edit['id'];} ?> " > 
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php if(isset($fetch_edit['name'])){echo $fetch_edit['name'];} ?> " class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="roll">Roll:</label>
                        <input type="text" name="roll" value="<?php if(isset($fetch_edit['roll'])){echo $fetch_edit['roll'];} ?> " class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" value="<?php if(isset($fetch_edit['address'])){echo $fetch_edit['address'];} ?> " class="form-control">
                    </div>
                    <button class="btn btn-warning mt-3" name="updatedata" type="submit">Update Data</button>

                </form>
            </div>
            <div class="col-md-6">
                <h1 class="text-center mt-5">Table</h1>
                <table class="table p-3 shadow">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Roll</th>
                            <th>Address</th>
                            <th style="width:150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Delete row in table
                        if(isset($_REQUEST['deleterow'])){
                            $sql_del="DELETE FROM student WHERE id={$_REQUEST['id']} " ;
                            if(mysqli_query($conn,$sql_del)){
                                echo "Selected row deleted from database";
                            }else{
                                echo "Error: Not Deleted!!";
                            }
                        }

                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" .  $row["id"]  . "</td>";
                            echo "<td>" .  $row["name"]  . "</td>";
                            echo "<td>" .  $row["roll"]  . "</td>";
                            echo "<td>" .  $row["address"]  . "</td>";
                            echo '<td style="display:flex; flex-direction:row;" > 
                             
                              <form method="POST" action="" >
                              <input type="hidden" name="id" value=' . $row["id"] . ' >
                              <button class="btn btn-sm btn-warning" name="editrow">Edit</button>
                              <button style="margin-left:6px;" name="deleterow" class="btn btn-sm btn-danger" >Delete</button>
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