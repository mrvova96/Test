<?php

require_once "database.php";

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$service = $_POST['service'];
$doctor = $_POST['doctor'];
$date = $_POST['date'];

addRecord($name, $surname, $email, $service, $doctor, $date);
if ($_GET['fileName'] === "index")
    header("Location: ../frontend/index.php?added=true");
if ($_GET['fileName'] === "doctors")
    header("Location: ../frontend/doctor.php?added=true");
if ($_GET['fileName'] === "service") {
    $service = urlencode($service);
    header("Location: ../frontend/service.php?name=$service&added=true");
}
connection->close();
exit;

/**
 * Функция добавляет новую запись к специалисту в базу данных
 */
function addRecord($name, $surname, $email, $service, $doctor, $date)
{
    $sql = "INSERT INTO records (name, surname, email, service, doctor, date) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = connection->prepare($sql);
    $statement->bind_param('ssssss', $name, $surname, $email, $service, $doctor, $date);
    $statement->execute();
    $statement->close();
}