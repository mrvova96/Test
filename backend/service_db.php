<?php

require_once "database.php";

if (isset($_GET["name"])) {
    $servicesData = getServiceData($_GET["name"]);
} else {
    $servicesData = getServiceNameList();
}

/**
 * Функция возвращает информацию об услуге по её названию (для отображения на странице услуги)
 */
function getServiceData($name)
{
    $sql = "SELECT * FROM services WHERE name = ?";
    $statement = connection->prepare($sql);
    $statement->bind_param('s', $name);
    $statement->execute();
    $result = $statement->get_result();
    $data = array();
    foreach ($result as $row) {
        $data = $row;
    }
    $statement->close();
    return $data;
}

/**
 * Функция возвращает список названий всех услуг (для выпадающего списка при записи)
 */
function getServiceNameList()
{
    $sql = "SELECT name FROM services";
    $statement = connection->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    $names = array();
    foreach ($result as $row) {
        $names[] = $row["name"];
    }
    $statement->close();
    return $names;
}