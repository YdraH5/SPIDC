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
<body class="bg-gray-100 font-sans">

    <div class="max-w-6xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">SPIDC Inventory System</h1>

        <!-- Item Code Setup -->
        <div class="bg-white shadow p-6 rounded mb-8">
            <h2 class="text-xl font-semibold mb-4">Item Code Setup</h2>
            <form method="POST" action="crud_item.php" class="flex flex-wrap gap-4">
                <input type="hidden" name="action" value="add">
                <input type="text" name="ItemCode" placeholder="Item Code" required class="border rounded px-4 py-2 w-full sm:w-48">
                <input type="text" name="ItemDesc" placeholder="Item Description" required class="border rounded px-4 py-2 w-full sm:w-64">
                <input type="number" name="TotSupply" placeholder="Total Supply" required class="border rounded px-4 py-2 w-full sm:w-40">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Add Item</button>
            </form>
        </div>

        <!-- Add Transaction -->
        <div class="bg-white shadow p-6 rounded mb-8">
            <h2 class="text-xl font-semibold mb-4">Add Transaction</h2>
            <form method="POST" action="trans_entry_process.php" class="flex flex-wrap gap-4">
                <input type="hidden" name="action" value="add_transaction">
                <input type="text" name="AcctName" placeholder="Accountable Name" required class="border rounded px-4 py-2 w-full sm:w-64">

                <select name="ItemCodeID" required class="border rounded px-4 py-2 w-full sm:w-72">
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

                <input type="number" name="NumOfItem" placeholder="Number of Items" min="1" required class="border rounded px-4 py-2 w-full sm:w-40">
                <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Add Transaction</button>
                <a href="transaction_summary.php" class="bg-blue-600 text-white mx-2 py-2 rounded hover:bg-blue-700 text-sm">
                    History
                </a>
                </div>
            </form>
            
        </div>
        

        <!-- Items List -->
        <div class="bg-white shadow p-6 rounded">
            <h3 class="text-xl font-semibold mb-4">Items List</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-left">
                            <th class="py-2 px-4 border">Item Code</th>
                            <th class="py-2 px-4 border">Description</th>
                            <th class="py-2 px-4 border">Input Date</th>
                            <th class="py-2 px-4 border">Total</th>
                            <th class="py-2 px-4 border">Left</th>
                            <th class="py-2 px-4 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $items = $conn->query("SELECT * FROM itemcodesetup");
                        while ($item = $items->fetch_assoc()):
                        ?>
                        <tr class="border-t hover:bg-gray-50">
                            <form method="POST" action="crud_item.php">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="RecordNo" value="<?= $item['RecordNo'] ?>">
                                <td class="py-2 px-4 border"><input name="ItemCode" value="<?= $item['ItemCode'] ?>" class="w-full border px-2 py-1"></td>
                                <td class="py-2 px-4 border"><input name="ItemDesc" value="<?= $item['ItemDesc'] ?>" class="w-full border px-2 py-1"></td>
                                <td class="py-2 px-4 border"><?= $item['DateInput'] ?></td>
                                <td class="py-2 px-4 border"><input name="TotSupply" type="number" value="<?= $item['TotSupply'] ?>" class="w-full border px-2 py-1"></td>
                                <td class="py-2 px-4 border"><input name="TotSupplyLeft" type="number" value="<?= $item['TotSupplyLeft'] ?>" class="w-full border px-2 py-1"></td>
                                <td class="py-2 px-4 border flex gap-2 items-center">
                                    <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Update</button>
                                    <a href="crud_item.php?action=delete&RecordNo=<?= $item['RecordNo'] ?>" onclick="return confirm('Delete item?')" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</a>
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
