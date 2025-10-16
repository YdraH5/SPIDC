<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body >

    <div class="max-w-6xl mx-auto bg-white rounded p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Transaction Summary</h1>
            <button onclick="window.print()" class="bg-gray-600 text-white px-4 py-2 rounded print:hidden">
                Print
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <?php
            $query = "
                SELECT te.RecordNo, te.TransDate, te.AcctName, te.NumOfItem, ic.ItemCode, ic.ItemDesc
                FROM transentry te
                JOIN itemcodesetup ic ON te.ItemCodeID = ic.RecordNo
                ORDER BY te.TransDate DESC
            ";
            $result = $conn->query($query);
            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
            <div class="border border-gray-300 p-4 rounded ">
                <p>Transaction #: <?= $row['RecordNo'] ?></p>
                <p>Date: <?= $row['TransDate'] ?></p>
                <p>Accountable: <?= $row['AcctName'] ?></p>
                <p>Item Code: <?= $row['ItemCode'] ?></p>
                <p>Item Desc: <?= $row['ItemDesc'] ?></p>
                <p>Qty: <?= $row['NumOfItem'] ?></p>
            </div>
            <?php
                endwhile;
            else:
                echo '<p>No trnsaction yet.</p>';
            endif;
            ?>
        </div>
    </div>

</body>
</html>
