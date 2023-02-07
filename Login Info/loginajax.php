<?php
define( 'DB_NAME', 'jpark89' );
define( 'DB_USER', 'jpark89' );
define( 'DB_PASSWORD', 'jpark89' );
define( 'DB_HOST', 'localhost' );

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function CreatePeople($fname,$lname,$tnum) {
  global $conn;

  $sql = "INSERT INTO People (fname, lname, tnum) VALUES ('$fname', '$lname', '$tnum');";

  mysqli_query($conn, $sql);
}

function DeleteNumEntry($id) {
    global $conn;

    $del = "DELETE FROM People WHERE id = '$id' ";
     
    $result = $conn->query($del);
}

function ShowPeople() {
    global $conn;

    $sql = "SELECT id, fname, lname, tnum FROM People";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $delurl = "[<a href='' onclick=return(DeleteNumEntry('$id'))>delete</a>]";
        echo "id: " . $row["id"]. " <br> First Name: " . $row["fname"]. " ||  Last Name: " .$row["lname"]. " ||  Phone Number: " .$row["tnum"]. " $delurl<br>";
      }
    } else {
      echo "0 results";
    }
}

 
$cmd = $_GET['cmd'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$tnum = $_GET['tnum'];

if($cmd == 'create') {
    CreatePeople($fname,$lname,$tnum);
} else if ($cmd == 'delete') {
    $id = $_GET['id'];
    DeleteNumEntry($id);
}

ShowPeople();

mysqli_close($conn);

?>

