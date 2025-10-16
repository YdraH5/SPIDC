<?php
include("db.php");

if ($_POST['action'] === 'add_transaction') {
    $itemCodeID = $_POST['ItemCodeID'];
    $acctName = $_POST['AcctName'];
    $numOfItem = $_POST['NumOfItem'];
    // Check supply
    $stmt = $conn->prepare("SELECT TotSupplyLeft FROM itemcodesetup WHERE RecordNo=?");
    $stmt->bind_param("i", $itemCodeID);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if (!$item || $item['TotSupplyLeft'] < $numOfItem) {
        echo "Not enough supplies!";
        exit;
    }
    // Insert to trasentry
    $stmt = $conn->prepare("INSERT INTO transentry (AcctName, ItemCodeID, NumOfItem) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $acctName, $itemCodeID, $numOfItem);
    $stmt->execute();
    // Update supply left
    $stmt = $conn->prepare("UPDATE itemcodesetup SET TotSupplyLeft = TotSupplyLeft - ? WHERE RecordNo = ?");
    $stmt->bind_param("ii", $numOfItem, $itemCodeID);
    $stmt->execute();
    header("Location: index.php?success=1");
    exit;
}
?>
