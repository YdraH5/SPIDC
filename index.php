<?php 
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPIDC Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans text-sm text-gray-800">

<div class="max-w-5xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-semibold mb-4 text-center">SPIDC Inventory System</h1>

    <!-- Item Code Setup -->
    <div class="mb-6">
        <h2 class="text-lg mb-2">Item Code Setup</h2>
        <form method="POST" action="crud_item.php" class="flex flex-wrap gap-2">
            <input type="hidden" name="action" value="add">
            <input type="text" name="ItemCode" placeholder="Item Code" required class="border px-2 py-1 w-full sm:w-40">
            <input type="text" name="ItemDesc" placeholder="Item Description" required class="border px-2 py-1 w-full sm:w-60">
            <input type="number" name="TotSupply" placeholder="Total Supply" required class="border px-2 py-1 w-full sm:w-32">
            <button type="submit" class="bg-blue-300 px-4 py-1 border">Add</button>
        </form>
    </div>

    <!-- Transaction -->
    <div class="mb-6">
        <h2 class="text-lg mb-2">Add Transaction</h2>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="text-green-700 mb-3">
                Transaction added successfully.
            </div>
        <?php endif; ?>

        <form method="POST" action="trans_entry_process.php" class="flex flex-wrap gap-2">
            <input type="hidden" name="action" value="add_transaction">
            <!-- <label for="">Account Name</label> -->
            <input type="text" name="AcctName" placeholder="Accountable Name" required class="border px-2 py-1 w-full sm:w-60">

            <select name="ItemCodeID" required class="border px-2 py-1 w-full sm:w-64">
                <option value="">Select Item</option>
                <?php
                $items = $conn->query("SELECT * FROM itemcodesetup WHERE TotSupplyLeft > 0");
                while ($item = $items->fetch_assoc()):
                ?>
                    <option value="<?= $item['RecordNo'] ?>">
                        <?= $item['ItemCode'] ?> - <?= $item['ItemDesc'] ?> (Left: <?= $item['TotSupplyLeft'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="number" name="NumOfItem" placeholder="Number of Items" min="1" required class="border px-2 py-1 w-full sm:w-32">

            <div class="flex gap-2 items-center">
                <button type="submit" class="bg-blue-300 px-4 py-1 border">Add</button>
                <a href="transaction_summary.php" class="px-3 py-1 bg-green-200 border">History</a>
            </div>
        </form>
    </div>

    <!-- Items List -->
    <div>
        <h3 class="text-lg mb-2">Items List</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-1">Item Code</th>
                        <th class="border px-2 py-1">Description</th>
                        <th class="border px-2 py-1">Date</th>
                        <th class="border px-2 py-1">Total</th>
                        <th class="border px-2 py-1">Left</th>
                        <th class="border px-2 py-1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items = $conn->query("SELECT * FROM itemcodesetup");
                    while ($item = $items->fetch_assoc()):
                    ?>
                    <tr>
                        <form method="POST" action="crud_item.php">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="RecordNo" value="<?= $item['RecordNo'] ?>">
                            <td class="border px-2 py-1"><input name="ItemCode" value="<?= $item['ItemCode'] ?>" class="w-full border px-1 py-0.5"></td>
                            <td class="border px-2 py-1"><input name="ItemDesc" value="<?= $item['ItemDesc'] ?>" class="w-full border px-1 py-0.5"></td>
                            <td class="border px-2 py-1"><?= $item['DateInput'] ?></td>
                            <td class="border px-2 py-1"><input name="TotSupply" type="number" value="<?= $item['TotSupply'] ?>" class="w-full border px-1 py-0.5"></td>
                            <td class="border px-2 py-1"><input name="TotSupplyLeft" type="number" value="<?= $item['TotSupplyLeft'] ?>" class="w-full border px-1 py-0.5"></td>
                            <td class="border px-2 py-1">
                                <div class="flex gap-1">
                                    <button type="submit" class="bg-yellow-300 px-2 py-0.5 text-xs border">Update</button>
                                    <a href="crud_item.php?action=delete&RecordNo=<?= $item['RecordNo'] ?>" onclick="return confirm('Delete item?')" class="bg-gray-200 px-2 py-0.5 text-xs border">Delete</a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
