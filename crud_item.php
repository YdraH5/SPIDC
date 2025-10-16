<?php
include("db.php");

// ADD
if ($_POST['action'] === 'add') {
    $stmt = $conn->prepare("INSERT INTO itemcodesetup (ItemCode, ItemDesc, TotSupply, TotSupplyLeft) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $_POST['ItemCode'], $_POST['ItemDesc'], $_POST['TotSupply'], $_POST['TotSupply']);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

// UPDATE
if ($_POST['action'] === 'update') {
    $stmt = $conn->prepare("UPDATE itemcodesetup SET ItemCode=?, ItemDesc=?, TotSupply=?, TotSupplyLeft=? WHERE RecordNo=?");
    $stmt->bind_param("ssiii", $_POST['ItemCode'], $_POST['ItemDesc'], $_POST['TotSupply'], $_POST['TotSupplyLeft'], $_POST['RecordNo']);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

// DELETE
if ($_GET['action'] === 'delete') {
    $stmt = $conn->prepare("DELETE FROM itemcodesetup WHERE RecordNo=?");
    $stmt->bind_param("i", $_GET['RecordNo']);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>
