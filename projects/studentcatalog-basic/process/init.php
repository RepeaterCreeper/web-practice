<?php
    /**
     * Server Variables
     */
    $HOST = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DATABASE = "studentcatalog";

    $db = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);

    if ($db->connect_errno) {
        echo "Failed to connect to MySQL: " . $db->connect_error;
        exit();
    }
?>