<?php
require 'db.php';
require 'Volont.php';

$volont = new Volont($pdo);

$username = htmlspecialchars($_POST['username']);
$date_birth = $_POST['date_birth'] ?? null;
$direction = htmlspecialchars($_POST['direction'] ?? '');
$experience = isset($_POST['experience']) ? 1 : 0;
$type_help = htmlspecialchars($_POST['type_help'] ?? '');;

$age = $date_birth ? date_diff(new DateTime($date_birth), new DateTime())->y : 0;


$volont->add($username, $age, $direction, $experience, $type_help);

header("Location: index.php");
exit();
;