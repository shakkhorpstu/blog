<?php

ob_start();
session_start();
if($_SESSION['name'] != "my_admin")
{
header('location: login.php');
}

include_once './database/databasefile.php';
?>

<?php
if (!isset($_REQUEST['id'])) {
    header("location: viewpost.php");
} else {
    $id = $_REQUEST['id'];
}
?>

<?php

    $statement = $db->prepare("SELECT * FROM news WHERE id=?");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row)
    {
            $real_path = "../uploads/".$row['image'];
            unlink($real_path);
    }

    $statement = $db->prepare("DELETE FROM news WHERE id = ?");
    $statement->execute(array($id));
    header("location: viewpost.php");


?>