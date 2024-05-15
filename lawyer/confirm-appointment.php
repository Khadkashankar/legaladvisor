<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

include('../includes/connection.php');

if (isset($_POST['appointment_id']) && !empty($_POST['appointment_id'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);

    $query = "UPDATE appointments SET status = 'confirmed' WHERE appointment_id = $appointment_id";

    if (mysqli_query($conn, $query)) {
        echo "Appointment confirmed successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
