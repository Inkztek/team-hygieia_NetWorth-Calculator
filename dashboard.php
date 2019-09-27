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

    <title>Overview</title>
  </head>
  <body>
    <div style="text-align: center;">
    <h1>Team-Hygieia Net Worth Calculator</h1>
    </div>
    <hr>
    <div>
    <div style="padding-left: 1em; float: left; width: 40%">
    <h1><a href="dashboard.php">Overview</a></h1>
    <h1><a href="assets">Assets</a></h1>
    <h1><a href="liabilities">Liability</a></h1>
  </div>
  <div style="float: right; width: 60%;">
  <div>
  <?php
          $sql = "SELECT * FROM assets";
                  if($result = mysqli_query($connection, $sql)){
                          echo "<h3>Assets</h3>";
                      if(mysqli_num_rows($result) > 0){
                          echo "<table>";
                              echo "<tr>";
                                  echo "<th> Items  &nbsp</th>";
                                  echo "<th> Value (Naira) &nbsp</th>";
                                  echo "<th> Date  &nbsp</th>";
                              echo "</tr>";

                          while($row = mysqli_fetch_array($result)){
                              echo "<tr>";
                                  echo "<td>" . $row['asset_name'] . "&nbsp</td>";
                                  echo "<td>#" . $row['asset_value'] . "&nbsp</td>";
                                  echo "<td>" . $row['asset_date'] . "&nbsp</td>";
                              echo "</tr>";
                          }
                          echo "</table>";
                          ;
                          // Free result set
                          mysqli_free_result($result);}
                          else{ echo "No records of Asset was found.";}
                  } else{

                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                  }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
           $asset_cal = "SELECT * FROM assets";
                  if($result = mysqli_query($connection, $asset_cal)){
                      $total1="0";
                      if(mysqli_num_rows($result) > 0){

                          while($row = mysqli_fetch_array($result)){
                              $total1 = $total1+ $row['asset_value'];
                          }
                          ;
                          echo "Total Assets"." &nbsp#".$total1."<br>" ;
                          // Free result set
                          mysqli_free_result($result);}
                          else{ echo "No Asset.<br>";}
                  } else{

                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                  }

  ?>
  <hr>
  <?php
//////////////////////////////////////////////////////////////////////////////////////////////////////
                 $sql = "SELECT * FROM liabilities";
                  if($result = mysqli_query($connection, $sql)){
                      echo "<h3>Liabilities</h3>";
        
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
                                  echo "<td>" . $row['liability_date'] . "&nbsp</td>";
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
                   
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                  $liability_cal = "SELECT * FROM liabilities";
                  if($result = mysqli_query($connection, $liability_cal)){
                      $total2="0";
                      if(mysqli_num_rows($result) > 0){

                          while($row = mysqli_fetch_array($result)){
                              $total2 = $total2+ $row['liability_value'];
                          }
                          ;
                          echo "Total Liabilities"."&nbsp #".$total2 ;
                          // Free result set
                          mysqli_free_result($result);}
                          else{ echo "No liability.<br>";}
                  } else{

                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                  }


                  $networth=$total1-$total2;
              echo "<h1> Your Net Worths  #$networth</h1>"; 
       ?>
  </div>
  <div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>