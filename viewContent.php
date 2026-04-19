<!DOCTYPE html>
<html>
<head>
    <title>View Content</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'connectdb.php';

if (!isset($_GET['id'])) {
    echo "No content selected.";
    exit();
}

$id = $_GET['id'];

// Content details
$q1 = "SELECT * FROM content WHERE contentID = $id";
$r1 = $conn->query($q1);

if (!$r1) {
    die("Error: " . $conn->error);
}

$row = $r1->fetch_assoc();
if (!$row) {
    echo "<h2>Content not found (maybe deleted)</h2>";
    echo "<a href='index.php'>Go back</a>";
    exit();
}

echo "<h2>".$row['title']."</h2>";
echo "Content ID: ".$row['contentID']."<br>";
echo "Type: ".$row['type']."<br>";
echo "Year: ".$row['releaseYear']."<br>";
echo "Age Rating: ".$row['ageRating']."<br>";
echo "Language: ".$row['language']."<br>";

// Average rating
$q2 = "SELECT AVG(rating) as avg FROM ratings WHERE contentID = $id";
$r2 = $conn->query($q2);
$row2 = $r2->fetch_assoc();

echo "Average Rating: ".($row2['avg'] ?? "None")."<br>";

// Total views
$q3 = "SELECT COUNT(*) as total FROM viewingevents WHERE contentID = $id";
$r3 = $conn->query($q3);
$row3 = $r3->fetch_assoc();

echo "Total Views: ".$row3['total'];

$conn->close();
?>
<li><a href="index.php">Browse Content</a></li>

</body>
</html>
