<?php
    include 'connect.php';
?>
<head>
    <link rel="icon" type="image/x-icon" href="images/TeknoLogo4.png">
</head>
<header class="header-container">
    <div class="nav-container">
        <!-- <h2>TeknoEvents</h2> -->
        <div class="row">
            <img src="images/TeknoLogo3.png", height = 40 width = 200/>
        </div>
    </div>
</header>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/teknoStyles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>TeknoEvents Register</title>
</head>
<!-- style="max-width: ; margin: 0 auto; height: 550px;" -->
<div class="container" id="container" style="max-width: ; margin: 20px auto; height: auto ;">
    <div class="form-container sign-in" style="overflow-y: auto; max-height: 450px;">
        <form method="post">
            <h1>Create Account</h1>
            <span>using your school details</span>
            <input type="text" name="txtfirstname" placeholder="First Name">
            <input type="text" name="txtlastname" placeholder="Last Name">
            Gender:
            <select name="txtgender" placeholder="Gender">
                <option value="">----</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <!-- User Type:
            <select name="txtusertype" placeholder="User Type">
                <option value="">----</option>
                <option value="Student">Student</option>
                <option value="Teacher">Teacher</option>
                <option value="Officer">Officer</option>
            </select> 
            
            <div id="studentFields" style="display: none;">
                Year Level:
                <select name="txtyearlevel" placeholder="Year Level">
                    <option value="">----</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                Program:
                <input type="text" name="txtprogram" placeholder="Program">
            </div> -->
            <input type="email" name="txtemail" placeholder="Email">
            <input type="text" name="txtusername" placeholder="Username">
            <input type="password" name="txtpassword" placeholder="Password">
            <input type="submit" name="btnRegister" value="Register">
            
        </form>
    </div>

    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account? We got you! </p>
                <a href="login.php">
                    <button class="hidden" id="login">Log In</button>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
    console.log("DOMContentLoaded event triggered"); // Debugging statement

    var userTypeSelect = document.getElementById("userType");
    var studentFields = document.getElementById("studentFields");

    userTypeSelect.addEventListener("click", function() {
        if (userTypeSelect.value === "Student") {
            studentFields.style.display = "block";
        } else {
            studentFields.style.display = "none";
        }
    });
});

</script> -->

<?php
	if(isset($_POST['btnRegister'])){
		//retrieve data from form and save the value to a variable
		//for tbluserprofile
		$fname=$_POST['txtfirstname'];
		$lname=$_POST['txtlastname'];
		$gender=$_POST['txtgender'];
        

		//for tbluseraccount
		$email=$_POST['txtemail'];
		$uname=$_POST['txtusername'];
		$pword=$_POST['txtpassword'];
        $utype=$_POST['txtusertype'];

		$hashedPassword = password_hash($pword, PASSWORD_DEFAULT);

	
		//Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
		$sql2 ="Select * from tbluseraccount where username='".$uname."'";
		$result = mysqli_query($connection,$sql2);
		$row = mysqli_num_rows($result);
		if($row == 0){
			//save data to tbluserprofile
            $sql1 ="Insert into tbluserprofile(firstname,lastname,gender) values('".$fname."','".$lname."','".$gender."')";
            mysqli_query($connection,$sql1);

            $user_id = mysqli_insert_id($connection);
            $sql ="Insert into tbluseraccount(emailadd,username,password,usertype) values('".$email."','".$uname."','".$hashedPassword."', '".$utype."')";
			mysqli_query($connection,$sql);
            // if ($utype === "Student") {
            //     // If user type is Student, insert additional data into tblregularstudent
            //     $yearLevel = $_POST['txtyearlevel'];
            //     $program = $_POST['txtprogram'];

            //     // Insert student data into tblregularstudent
            //     $insertStudentQuery = "INSERT INTO tblregularstudent (profileid, yearlevel, program) VALUES (?, ?, ?)";
            //     $studentStmt = $connection->prepare($insertStudentQuery);
            //     $studentStmt->bind_param("iis", $profileId, $yearLevel, $program);
            //     $studentStmt->execute();
            // }
            header("location: home.php");
		} else{
			echo "<div class='message-box error'>Username already existing.</div>";
		}
	}
?>
<!-- 
<?php require_once 'includes/footer.php'; ?> -->

