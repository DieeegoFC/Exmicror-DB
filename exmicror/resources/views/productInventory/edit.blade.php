<!DOCTYPE html>
<html>
<head>
    <title>Edit product</title>
</head>
<body>
    <h1>Edit product</h1>
    <form action="/productInventory/{{ $productInventory->id_inventory }}" method="POST">
        @csrf
        @method('PUT')
        <label for="available_quantity">Available quantity:</label>
        <input type="number" name="available_quantity" id="available_quantity" value="{{ $productInventory->available_quantity }}" required><br>
        <label for="manufacture_date">Manufacture date:</label>
        <input type="date" name="manufacture_date" id="manufacture_date" value="{{ $productInventory->manufacture_date }}" required><br>
        <label for="expiration_date">Expiration date:</label>
        <input type="date" name="expiration_date" id="expiration_date" value="{{ $productInventory->expiration_date }}"><br>
        <label for="id_label">Barcode label ID:</label>
        <input type="number" name="id_label" id="id_label" value="{{ $productInventory->id_label }}" required><br>
        <label for="id_packaging">Packaging ID:</label>
        <input type="number" name="id_packaging" id="id_packaging" value="{{ $productInventory->id_packaging }}" required><br>
        <label for="id_compliance">Compliance ID:</label>
        <input type="number" name="id_compliance" id="id_compliance" value="{{ $productInventory->id_compliance }}" required><br>
        <label for="id_order">Order ID:</label>
        <input type="number" name="id_order" id="id_order" value="{{ $productInventory->id_order }}"><br>
        <label for="id_distribution_client">Distribution client ID:</label>
        <input type="number" name="id_distribution_client" id="id_distribution_client" value="{{ $productInventory->id_distribution_client }}"><br>
        <label for="id_offer">Offer ID:</label>
        <input type="number" name="id_offer" id="id_offer" value="{{ $productInventory->id_offer }}"><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>