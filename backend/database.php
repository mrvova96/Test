<?php

/**
 * Параметры подключения к базе данных
 */
const SERVER = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DATABASE = "vet_database";

/**
 * Подключение к базе данных
 */
define("connection", mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE));
if (mysqli_connect_errno()) {
    exit("Ошибка подключения к базе данных MySQL: " . mysqli_connect_error());
}