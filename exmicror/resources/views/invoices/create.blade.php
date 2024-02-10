<!DOCTYPE html>
<html>
<head>
    <title>Create new invoice</title>
</head>
<body>
    <h1>Create new invoice</h1>
    <form action="/invoices" method="POST">
        @csrf
        <label for="total_amount">Total amount:</label>
        <input type="number" name="total_amount" id="total_amount" required><br>
        <label for="issuance_date">Issuance date:</label>
        <input type="date" name="issuance_date" id="issuance_date" required><br>
        <label for="invoice_type">Invoice type:</label>
        <input type="text" name="invoice_type" id="invoice_type" value="issued" required><br>
        <label for="id_order">Order ID:</label>
        <input type="number" name="id_order" id="id_order" required><br>
        <label for="id_distribution_client">Client ID:</label>
        <input type="number" name="id_distribution_client" id="id_distribution_client" required><br>
        <label for="id_offer">Offer ID:</label>
        <input type="number" name="id_offer" id="id_offer" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>