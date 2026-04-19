<!DOCTYPE html>
<html>
<head>
    <title>Plans</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'connectdb.php'; ?>

<h2>Subscription Plans</h2>

<?php

$q = "SELECT p.planID,p.name, p.price, COUNT(u.userID) as total
      FROM plans p
      LEFT JOIN users u ON p.planID = u.planID
      GROUP BY p.planID";

$r = $conn->query($q);

if (!$r) {
    die("SQL Error: " . $conn->error);
}

echo "<table border='1'>";
echo "<tr>
	<th>name</th>
        <th>Plan ID</th>
        <th>Price</th>
        <th># Users</th>
        <th>Update</th>
      </tr>";

while ($row = $r->fetch_assoc()) {

    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['planID']."</td>";
    echo "<td>".$row['price']."</td>";
    echo "<td>".$row['total']."</td>";

   
    echo "<td>
            <form method='POST'>

                <input type='hidden' name='planID' value='".$row['planID']."'>
                <input type='number' step='0.01' name='price' placeholder='New Price'>
                <input type='submit' name='updatePrice' value='Update'>
            </form>
          </td>";

    echo "</tr>";
}

echo "</table>";
?>

<br>

<?php
if (isset($_POST['updatePrice'])) {

    $id = $_POST['planID'];
    $price = $_POST['price'];

    $q = "UPDATE plans 
          SET price = $price 
          WHERE planID = $id";

    if ($conn->query($q)) {
        echo "Price updated!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<h3>Add New Plan</h3>

<form method="POST">

Name:
<input type ="text" name = "name"><br>
Price:
<input type="number" step="0.01" name="price"><br>

<input type="submit" name="addPlan" value="Add Plan">

</form>

<?php
if (isset($_POST['addPlan'])) {

	$name = $_POST['name'] ?? '';   
	$price = $_POST['price'] ?? '';

    if ($name == "" || $price == "") {
        echo "Please enter a price or name!";
    } else {

        $q = "INSERT INTO plans (name,price) VALUES ('$name',$price)";

        if ($conn->query($q)) {
            echo "New plan added!";
		header("Location: plans.php");
		exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
</form>
<?php $conn->close(); ?>
<li><a href="index.php">Browse Content</a></li>

</body>
</html>
