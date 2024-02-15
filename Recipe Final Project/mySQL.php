<?php # Script 9.2 - mysqli_connect.php

const DB_USER = 'root';
const DB_PASSWORD = 'happy';
const DB_HOST = 'db';
const DB_NAME = 'recipe_database';

const DB_PORT ='3306';

// Make the connection:
$recipe_database = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME,DB_PORT)
or die ('Could not connect to MySQL: ' . mysqli_connect_error());

// Set the encoding...
mysqli_set_charset($recipe_database, 'utf8');