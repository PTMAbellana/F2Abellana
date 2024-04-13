<?php
    session_start();
    include('connect.php');
    include("administratorHeader.php");
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
 		// $eventid=$_POST['eventid'];
		$eventtitle=$_POST['eventName'];
        // $adminid=$_POST['adminid'];
		$eventdesc=$_POST['eventDescription'];
        $eventvenue=$_POST['eventVenue'];
        $eventfee=$_POST['eventFee'];
        $date=$_POST['eventDate'];
        $time=$_POST['eventTime'];

        // Get adminid from session
        $adminid = $_SESSION['adminid'];

		//save data to tblevent
		$sql1 ="Insert into tblevent(eventtitle,adminid,eventdescription,eventvenue,eventfee,date,time) values('".$eventtitle."','".$adminid."','".$eventdesc."','".$eventvenue."','".$eventfee."','".$date."','".$time."')";
		mysqli_query($connection,$sql1); 
	}
?>

<link rel="stylesheet" type="text/css" href="css/teknoStyles.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<head>
<style>

    body{
         /* background-image: url('images/background/.png'); */
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-position: center;
        background-attachment: fixed;
        color:black;
    }

    .nav a{
        color: black;
        text-decoration: none;
        background-color: white;
        border-radius: 5px
    }

    .nav a:hover{
        color: white;
        background-color: rgb(54, 79, 82);
        transition: 0.1s ease-in;
    }
    hr{
        margin:0;
    }

</style>
</head>
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
                // Check if the cancel button is clicked
                if (isset($_POST['cancel'])) {
                    // Retrieve the event ID from the form submission
                    $eventid = $_POST['eventid'];

                    // Debugging: Echo the event ID to see if it's properly retrieved
                    echo "Event ID: " . $eventid;

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