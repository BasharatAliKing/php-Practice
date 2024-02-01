<?php
  $db_host="localhost";
  $db_user="root";
  $db_password="";
  $db_name="kashif";
  $conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
  $sql="SELECT * FROM data";
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
            <!-- <?php include "sardar.php";
            ?> -->
            <?php
              if(isset($_REQUEST['submitform'])){
                $name=$_REQUEST['name'];
                $email=$_REQUEST['email'];
                $website=$_REQUEST['website'];
                $comment=$_REQUEST['comment'];
                $gender=$_REQUEST['gender'];
 
                $sql_add="INSERT INTO data (name,email,website,comment,gender) VALUES ('$name','$email','$website','$comment','$gender')";
                if(mysqli_query($conn,$sql_add)){
                    echo "Data added into Database";
                }else{
                    echo  "Error: DAta not added!!" ;
                }

              }
            ?>
            <div class="col-md-5">
               <form action="" method="POST" class="p-3 shadow border">
                <h1 class="text-center">Form Data</h1>
               <div class="form-group">
                    <label for="name">Name:</label><br>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label><br>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="website">Website:</label><br>
                    <input type="text" name="website" class="form-control">
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label><br>
                    <textarea name="comment" id="" class="form-control" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label> <br>
                    <input type="radio" name="gender" value="male" >Male
                    <input type="radio" name="gender" value="female" >Female
                    <input type="radio" name="gender" value="custom" >Custom
                </div>
                <button class="btn btn-primary mt-3 items-center" name="submitform">Submit</button>

               </form>

            </div>
            <div class="mt-5 col-md-12 shadow">
            <h1>OutPut:</h1>
             <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Comment</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row['id']  . "</td>";
                    echo "<td>" . $row['name']  . "</td>";
                    echo "<td>" . $row['email']  . "</td>";
                    echo "<td>" . $row['website']  . "</td>";
                    echo "<td>" . $row['comment']  . "</td>";
                    echo "<td>" . $row['gender']  . "</td>";
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