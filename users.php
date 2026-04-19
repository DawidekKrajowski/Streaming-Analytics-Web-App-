<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



<?php include 'connectdb.php';


if (isset($_POST['addView'])) {

    echo "DEBUG: form submitted<br>";
    var_dump($_POST);

    $uid = $_POST['userID'];
    $cid = $_POST['contentID'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $completed = $_POST['completed'];

   if ($date == "" || $duration == "") {
        echo "Please fill all fields!";
    } else {

        $q = "INSERT INTO viewingevents (userID, contentID, watchDate, duration, completed)
              VALUES ($uid, $cid, '$date', $duration, $completed)";

        if ($conn->query($q)) {
            echo "Viewing event added!";
 	 	header("Location: users.php?user=$uid");	
	 	exit(); 
   } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
<h2>Viewing History</h2>

<form method="get">
<select name="user">
<?php
$res = $conn->query("SELECT userID, name FROM users");
while ($row = $res->fetch_assoc()) {
    echo "<option value='".$row['userID']."'>".$row['name']."</option>";
}
?>
</select>
Start Date: <input type="date" name="start"><br>
End Date: <input type="date" name="end"><br>
<input type="submit" value ="Search">
</form>


<h3>Add Viewing Event</h3>

<form method="POST">

User:
<select name="userID">
<?php
$res = $conn->query("SELECT userID, name FROM users");
while ($row = $res->fetch_assoc()) {
    echo "<option value='".$row['userID']."'>".$row['name']."</option>";
}
?>
</select><br>

Content:
<select name="contentID">
<?php
$res = $conn->query("SELECT contentID, title FROM content");
while ($row = $res->fetch_assoc()) {
    echo "<option value='".$row['contentID']."'>".$row['title']."</option>";
}
?>
</select><br>

Date: <input type="date" name="date"><br>
Duration: <input type="number" name="duration"><br>

Completed:
<select name="completed">
    <option value="1">Yes</option>
    <option value="0">No</option>
</select><br>

<input type="submit" name="addView" value="Add">

</form>
<?php
if (isset($_GET['user'])) {
    $u = $_GET['user'];
    $start = $_GET['start']??'';
    $end = $_GET['end']??'';

    $q = "SELECT c.title, v.watchDate, v.duration, v.completed
          FROM viewingevents v
          JOIN content c ON v.contentID = c.contentID
          WHERE v.userID = $u";

    if (!empty($start) &&!empty($end)) {
        $q .= " AND v.watchDate BETWEEN '$start' AND '$end'";
    }

    $r = $conn->query($q);
	
	
    if (!$r) {
        die("Error: " . $conn->error);
    }

    echo "<h3>Results</h3>";
	if($r->num_rows ==0){
	echo "No viewing history found.";
	}else{

    echo "<table border='1'>";
    echo "<tr>
            <th>Title</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Completed</th>
          </tr>";

while ($row = $r->fetch_assoc()) {
    echo "<tr>";

    echo "<td>".$row['title']."</td>";
    echo "<td>".$row['watchDate']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".($row['completed'] ? "Yes" : "No")."</td>";

    echo "</tr>";
}

echo"</table>";
}
}
$conn->close();
?>

</body>
</html>
