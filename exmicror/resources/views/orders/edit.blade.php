<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
</head>
<body>
    <h1>Edit Order</h1>
    <form action="/orders/{{ $order->id_order }}" method="POST">
        @csrf
        @method('PUT')
        <label for="requested_quantity">Requested quantity:</label>
        <input type="number" name="requested_quantity" id="requested_quantity" value="{{ $order->requested_quantity }}" required><br>
        <label for="order_date">Order date:</label>
        <input type="date" name="order_date" id="order_date" value="{{ $order->order_date }}" required><br>
        <label for="expected_delivery_date">Expected delivery date:</label>
        <input type="date" name="expected_delivery_date" id="expected_delivery_date" value="{{ $order->expected_delivery_date }}"><br>
        <label for="order_status">Order status:</label>
        <input type="text" name="order_status" id="order_status" value="{{ $order->order_status }}" required><br>
        <label for="id_client">Client ID:</label>
        <input type="number" name="id_client" id="id_client" value="{{ $order->id_client }}" required><br>
        <label for="id_offer">Offer ID:</label>
        <input type="number" name="id_offer" id="id_offer" value="{{ $order->id_offer }}" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>