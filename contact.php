 
	//<!-- submit_feedback.php -->
<?php
$host = "localhost"; // or 127.0.0.1
$user = "kurd";
$password = "1234512345As";
$dbname = "project";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["sub"];
$comment =$_POST["Message"];


// Prepare and bind (security against SQL injection)
$stmt = $conn->prepare("INSERT INTO project_collage (fullname, email, subject,comment) VALUES (?, ?, ?,?)");
$stmt->bind_param("ssss", $name, $email, $message,$comment);

// Execute
if ($stmt->execute()) {
  echo "Feedback submitted successfully!";
} else {
  echo "Error: " . $stmt->error;
}
if ($stmt->execute()) {
    echo "<script>alert('Feedback submitted successfully!');</script>";
}


$stmt->close();
$conn->close();
echo '<a href="index.html">Back To Home Page</a>';
   
/* 
echo '<h1>You are welcom</h1>';
$name = $sub = $email = $comment="";
if (isset($_POST['submit'])) {
	$name=$_POST["name"];
	echo "user name :$name <br><br>";
	$email=$_POST["email"];
	echo "user email : $email <br><br>";
	$sub=$_POST["sub"];
	echo "user Subject : $sub <br><br>";
	$comment=$_POST["Message"];
	echo "user Comment :$comment <br><br>";
}
*/

 ?>