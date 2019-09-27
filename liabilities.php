<?php 
   include "connection.php";
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Liability</title>
  </head>
  <body>
    <div style="text-align: center;">
    <h1>Team-Hygieia Net Worth Calculator</h1>
    </div>
    <hr>
    <div style="padding-left: 1em width: 40%; float:left;">
    <h1><a href="dashboard.php">Overview</a></h1>
    <h1><a href="assets.php">Assets</a></h1>
    <h1><a href="liabilities.php">Liabilities</a></h1>
  </div>
  <div style="width: 60%; float:right;">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipaart">
      <input type="text" name="liability_name" placeholder="Liability Name" required="required">
      <input type="text" name="liability_value" placeholder="Liability Value"required="required">
      <input type="submit" name="add_liability" value="Add liability">
      
    </form>


    <div>
      <?php

          if(isset($_POST['add_liability']) and $_POST['add_liability']="Add liability"){
       
              $liability_name =$_POST['liability_name'];
              if(is_numeric($_POST['liability_value']))
                {$liability_value=$_POST['liability_value'];}
              else
                {echo "Enter Numeric Liability Value";
                  exit();}
              $liability_date=date("y/m/d");
      
                //Check connection
                if($connection === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                 
                // Attempt insert query execution
                $sql = "INSERT INTO liabilities (liability_name,liability_value,liability_date) VALUES ('$liability_name','$liability_value','$liability_date')";
                 if(mysqli_query($connection, $sql)){
                    echo "liability Added successfully."; } 
                else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                  }
        
             }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////
       if(isset($_GET['id']))
          { 
            $id=$_GET['id'];
            $sql = "DELETE from liabilities WHERE id='$id'";
            if(mysqli_query($connection,$sql)){
              echo "Liability deleted sucessfully";
            }
            else {
              echo "ERROR: Could not able to execute $sql. ".mysqli_error($connection);
            }
          }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $sql = "SELECT * FROM liabilities";
                  if($result = mysqli_query($connection, $sql)){
                      echo "<h3>List of liabilities</h3>";
        
                      if(mysqli_num_rows($result) > 0){
                          echo "<table>";
                              echo "<tr>";
                                  echo "<th> Items  &nbsp</th>";
                                  echo "<th> Value (Naira) &nbsp</th>";
                                  echo "<th> Date  &nbsp</th>";

                              echo "</tr>";

                          while($row = mysqli_fetch_array($result)){
                              echo "<tr>";
                                  echo "<td>" . $row['liability_name'] . "&nbsp</td>";
                                  echo "<td>#" . $row['liability_value'] . "&nbsp</td>";
                                  echo "<td>" . $row['liability_date'] . "&nbsp</td>";?>
                                  <td>&nbsp&nbsp<a href="?id=<?php echo $row['id']?>">Delete</a></td>
                              <?php

                          echo "</tr>";
                          }
                          echo "</table>";
                          ;
                          // Free result set
                          mysqli_free_result($result);}
                          else{ echo "No records of liability was found.";}
                  } else{

                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                  }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
                  $liability_cal = "SELECT * FROM liabilities";
                  if($result = mysqli_query($connection, $liability_cal)){
                      $total="0";
                      if(mysqli_num_rows($result) > 0){

                          while($row = mysqli_fetch_array($result)){
                              $total = $total+ $row['liability_value'];
                          }
                          ;
                          echo "<h4>Your Total liability = #". $total. "</h4>";
                          // Free result set
                          mysqli_free_result($result);}
                          else{ echo "No liability.";}
                  } else{

                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                  }


                   

?>
    </div>

  </div>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

