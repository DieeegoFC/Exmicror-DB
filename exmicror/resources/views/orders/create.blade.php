<!DOCTYPE html>
<html>
<head>
    <title>Create new order</title>
</head>
<body>
    <h1>Create new order</h1>
    <form action="/orders" method="POST">
        @csrf
        <label for="requested_quantity">Requested quantity:</label>
        <input type="number" name="requested_quantity" id="requested_quantity" required><br>
        <label for="order_date">Order date:</label>
        <input type="date" name="order_date" id="order_date" required><br>
        <label for="expected_delivery_date">Expected delivery date:</label>
        <input type="date" name="expected_delivery_date" id="expected_delivery_date"><br>
        <label for="order_status">Order status:</label>
        <input type="text" name="order_status" id="order_status" value="pending" required><br>
        <label for="id_client">Client ID:</label>
        <input type="number" name="id_client" id="id_client" required><br>
        <label for="id_offer">Offer ID:</label>
        <input type="number" name="id_offer" id="id_offer" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>