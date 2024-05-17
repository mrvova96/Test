<?php

require_once "database.php";

if (isset($_GET["name"])) {
    $doctorsData = getDoctorListByService($_GET["name"]);
} else if (isset($_GET["nameForSelect"])) {
    $doctorsData = getDoctorListByService($_GET["nameForSelect"]);
    header('Content-Type: application/json');
    echo json_encode($doctorsData);
} else {
    $doctorsData = getDoctorList();
}

/**
 * Функция возвращает информацию о всех специалистах (для отображения на странице специалистов)
 */
function getDoctorList()
{
    $sql = "SELECT * FROM doctors";
    $statement = connection->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
    return $result;
}

/**
 * Функция возвращает информацию о всех специалистах по конкретной услуге
 * (для отображения на странице услуги, и для выпадающего списка при записи)
 */
function getDoctorListByService($name)
{
    $sql = "SELECT surname, doctors.name, patronymic, quote, doctors.pictureName FROM doctors 
            JOIN doctors_services ON doctors.ID = doctors_services.doctorID
            JOIN services ON doctors_services.serviceID = services.ID
            WHERE services.name = ?";
    $statement = connection->prepare($sql);
    $statement->bind_param('s', $name);
    $statement->execute();
    $result = $statement->get_result();
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    $statement->close();
    return $data;
}