<?php
   session_start();
  // if (!isset($_SESSION['username'])){
  //   header('location: administratorLogin.php');
  // }

  // include("administratorApi.php");
  // include("administratorHeader.php");
  include 'connect.php';
  include("includes/administratorHeader.php");
?>

<div id="content-placeholder">
  <?php
      // echo allEvents();
    $conn = new mysqli('localhost','root','', 'dbabellanaf2');
    function getEventDetails($conn) {
        // Query to fetch event details from the database
        
        $query = "SELECT e.*, a.name AS adminName FROM tblevent e INNER JOIN tbladmin a ON e.adminid = a.adminid";
        
        // Execute the query
        $result = $conn->query($query);
        
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Loop through each row
            while ($row = $result->fetch_assoc()) {
              
                // Output event details
                echo '
                    <div class="all-events">
                    <center>
                    <h2>' . $row['eventtitle'] . '</h2>
                    </center>
                    <hr style="margin-top:10;margin-bottom:10;">
                    <p>◦  Administrator: ' . $row['adminName'] . '</p>
                    <p>◦ Description: ' . $row['eventdescription'] . '</p>
                    <p>◦ Venue: ' . $row['eventvenue'] . '</p>
                    <p>◦ Fee: $' . $row['eventfee'] . '</p>
                    <p>◦ Date: ' . $row['date'] . '</p>
                    <p>◦ Time: ' . $row['time'] . '</p>
                    </div>
                ';
            }
        } else {
            echo 'No events found.';
        }
    }
    
  ?>
  <?php
      getEventDetails($conn);
  ?>
</div>

<?php require_once 'includes/footer.php';?>

    
