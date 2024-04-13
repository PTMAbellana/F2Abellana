<?php
    session_start();
    include('connect.php');
    include("includes/administratorHeader.php");
//     if ($_SERVER["REQUEST_METHOD"] == "POST"){
//         if (isset($_POST['create'])){
//             createEvent();
//         }
//         if (isset($_POST['cancel'])){
//             $eventId = $_POST['eventid'];
//             $cancellationReason = $_POST['cancellationReason'];
//             eventCancel($eventId, $cancellationReason);
//         }
//     }

?>
<?php
	if(isset($_POST['create'])){
        $eventtitle=$_POST['eventName'];
        $eventdesc=$_POST['eventDescription'];
        $eventvenue=$_POST['eventVenue'];
        $eventfee=$_POST['eventFee'];
        $date=$_POST['eventDate'];
        $time=$_POST['eventTime'];
    
        // Get adminid from session
        $adminid = $_SESSION['adminid'];
        
        // Save data to tblevent
        $sql1 = "INSERT INTO tblevent (eventtitle, adminid, eventdescription, eventvenue, eventfee, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql1);
        $stmt->bind_param("sisssss", $eventtitle, $adminid, $eventdesc, $eventvenue, $eventfee, $date, $time);
        $stmt->execute();
    
        // Get the auto-generated eventid
        $eventid = mysqli_insert_id($connection);
    
        // Save adminid and eventid to tbladminevent
        $sql2 = "INSERT INTO tbladminevent (adminid, eventid) VALUES (?, ?)";
        $stmt2 = $connection->prepare($sql2);
        $stmt2->bind_param("ii", $adminid, $eventid);
        $stmt2->execute();
    
        $stmt->close();
        $stmt2->close();
    }
?>


<div class="create-container">
    <div class="create-inner-container">

        <h2>Create New Event</h2>

        <form id="eventForm" action="" method="POST" >
            <div class="txt_field">
                <input type="text" id="eventName" name="eventName" method="POST" required>
                <label for="eventName">Event Title: </label>
            </div>

            <div class="txt_field">
                <input type="text" id="eventDescription" name="eventDescription" method="POST" required>
                <label for="eventDescription">Description: </label>
            </div>
            <div class="txt_field">
                <input type="text" id="eventVenue" name="eventVenue" method="POST" required>
                <label for="eventVenue">Venue: </label>
            </div>
            <div class="txt_field">
                <input type="text" id="eventFee" name="eventFee" method="POST" required>
                <label for="eventFee">Fee: </label>
            </div>
            <div class="txt_field">
                <input type="date" id="eventDate" name="eventDate" method="POST" placeholder="" required>
                <label for="eventDate">Date: </label>
            </div>

            <div class="txt_field">
                <input type="time" id="eventTime" name="eventTime" method="POST" placeholder="" required>
                <label for="eventTime">Time: </label>
            </div>

            <input type="submit" name="create" value="Create Event">
        </form>
    </div>

    <div class="admin-events">
        <div>
            <!-- display sa mga gipang create na events -->
            <?php
                $conn = new mysqli('localhost','root','', 'dbabellanaf2');
                function getEventDetails($conn) {
                    // Get the adminid of the current administrator from session
                        $adminid = $_SESSION['adminid'];
                        // Query to fetch only the events created by the current administrator
                        $query = "SELECT * FROM tblevent WHERE adminid = '$adminid'";
                        $result = $conn->query($query);
    
                    // Check if there are any rows returned
                    if ($result->num_rows > 0) {
                        // Loop through each row
                        while ($row = $result->fetch_assoc()) {
                            $query_name = "SELECT name FROM tbladmin WHERE adminid = '$adminid'";
                            $result_name = $conn->query($query_name);
                            $row_name = $result_name->fetch_assoc();

                            // Output event details
                            echo '
                                <div class="the-event">
                                    <h2>' . $row['eventtitle'] . '</h2>
                                    <hr style="margin-top:10;margin-bottom:10;">
                                    <p>◦  Administrator: ' . $row_name['name'] . '</p>
                                    <p>◦ Description: ' . $row['eventdescription'] . '</p>
                                    <p>◦ Venue: ' . $row['eventvenue'] . '</p>
                                    <p>◦ Fee: $' . $row['eventfee'] . '</p>
                                    <p>◦ Date: ' . $row['date'] . '</p>
                                    <p>◦ Time: ' . $row['time'] . '</p>
                                    <div>Cancel the "'. $row['eventtitle'] .'" Event? </div>
                                    <form action="" method="POST">   
                                        <input type="hidden" name="eventid" value = '.$row['eventid'].' >
                                        <textarea id="cancelReason" name="cancellationReason" method="POST" placeholder="Explain the sudden cancellation of the event to the participants"></textarea>
                                        <br>
                                        <input type="submit" name="cancel" value="Cancel Event">
                                    </form>
                                </div>
                            ';
                        }
                    } else {
                        echo 'No events found.';
                    }
                }
                // echo adminEvents();
            ?>
            <?php
                if (isset($_POST['cancel'])) {
                    // Retrieve the event ID from the form submission
                    $eventid = $_POST['eventid'];
                    
                    // Debugging: Echo the event ID to see if it's properly retrieved
                    echo "Event ID: " . $eventid;
                
                    // Delete related records in tbladminevent first
                    $delete_adminevent_sql = "DELETE FROM tbladminevent WHERE eventid = ?";
                    $delete_adminevent_stmt = $connection->prepare($delete_adminevent_sql);
                    $delete_adminevent_stmt->bind_param("i", $eventid);
                    $delete_adminevent_stmt->execute();
                    $delete_adminevent_stmt->close();
                
                    // Delete the event from the tblevent table
                    $sql = "DELETE FROM tblevent WHERE eventid = $eventid";
                
                    // Debugging: Echo the SQL query to see if it's constructed correctly
                    echo "SQL Query: " . $sql;
                
                    if ($connection->query($sql) === TRUE) {
                        echo "Event canceled successfully";
                    } else {
                        echo "Error canceling event: " . $connection->error;
                    }
                }
                
            ?>

            <?php
                getEventDetails($conn);
            ?>
        </div>
    </div>
</div>
<?php
    
?>