<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //connect mysql db
    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'student_management';
    $conn = mysqli_connect($host, $user, $pass, $db) or die('Not connect');

    if (isset($_GET["id"])) {
        $deleteById = $_GET["id"];
        //execute query update
        $update = "DELETE FROM Students WHERE id=$deleteById";
        $ress = mysqli_query($conn, $update) or die('Bad Request');
        //close connection
        mysqli_close($conn);
    } else {
        //get json data
        $data = json_decode(file_get_contents('php://input'), true);
        $id = -1;
        if (isset($data["id"])) {
            $id = $data["id"];
        }
        $firstname = $data["firstname"];
        $lastname = $data["lastname"];
        $email = $data["email"];
        $age = $data["age"];

        //find max id
        $sql = "SELECT * FROM Students";
        $max = 0;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($max < $row["id"]) {
                    $max = $row["id"];
                }
            }
        }
        $max = $max + 1;
        if ($id != -1) {
            $date = date("Y-m-d H:i:s");
            //execute query update
            $update = "UPDATE Students SET lastname='$lastname', firstname='$firstname', email='$email', age='$age', reg_date='$date' WHERE id=$id";
            $ress = mysqli_query($conn, $update) or die('Bad Request');
            //close connection
            mysqli_close($conn);
        } else {
            //execute query insert
            $insert = "INSERT INTO Students (id, firstname, lastname, email, age)
            VALUES ($max, '$firstname', '$lastname', '$email', $age)";
            $ress = mysqli_query($conn, $insert) or die('Bad Request');
            //close connection
            mysqli_close($conn);
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //connect db
    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'student_management';
    $conn = mysqli_connect($host, $user, $pass, $db) or die('Not connect');
    //execute query
    $sql = "SELECT * FROM Students";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . ", Name: " . $row["firstname"] . " " . $row["lastname"] . ", Age: " . $row["age"] . ", Reg: " . $row["reg_date"] . "\n";
        }
    } else {
        echo "0 results";
    }

    //close connection
    mysqli_close($conn);
}
?>