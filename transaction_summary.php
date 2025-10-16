<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 font-sans">

    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Transaction Summary</h1>
            <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 print:hidden">
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
            <div class="border border-gray-300 p-4 rounded shadow-sm bg-gray-50">
                <p><span class="font-semibold">Transaction #:</span> <?= $row['RecordNo'] ?></p>
                <p><span class="font-semibold">Date:</span> <?= $row['TransDate'] ?></p>
                <p><span class="font-semibold">Accountable:</span> <?= $row['AcctName'] ?></p>
                <p><span class="font-semibold">Item Code:</span> <?= $row['ItemCode'] ?></p>
                <p><span class="font-semibold">Item Desc:</span> <?= $row['ItemDesc'] ?></p>
                <p><span class="font-semibold">Qty:</span> <?= $row['NumOfItem'] ?></p>
            </div>
            <?php
                endwhile;
            else:
                echo '<p class="col-span-full text-center text-gray-500">No trnsaction yet.</p>';
            endif;
            ?>
        </div>
    </div>

</body>
</html>
