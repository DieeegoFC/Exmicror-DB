<!DOCTYPE html>
<html>
<head>
    <title>Create new product</title>
</head>
<body>
    <h1>Create new product</h1>
    <form action="/productInventory" method="POST">
        @csrf
        <label for="available_quantity">Available quantity:</label>
        <input type="number" name="available_quantity" id="available_quantity" required><br>
        <label for="manufacture_date">Manufacture date:</label>
        <input type="date" name="manufacture_date" id="manufacture_date" required><br>
        <label for="expiration_date">Expiration date:</label>
        <input type="date" name="expiration_date" id="expiration_date"><br>
        <label for="id_label">Barcode label ID:</label>
        <input type="number" name="id_label" id="id_label" required><br>
        <label for="id_packaging">Packaging ID:</label>
        <input type="number" name="id_packaging" id="id_packaging" required><br>
        <label for="id_compliance">Compliance ID:</label>
        <input type="number" name="id_compliance" id="id_compliance" required><br>
        <label for="id_order">Order ID:</label>
        <input type="number" name="id_order" id="id_order"><br>
        <label for="id_distribution_client">Distribution vlient ID:</label>
        <input type="number" name="id_distribution_client" id="id_distribution_client"><br>
        <label for="id_offer">Offer ID:</label>
        <input type="number" name="id_offer" id="id_offer"><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>