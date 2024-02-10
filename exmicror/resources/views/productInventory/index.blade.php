<!DOCTYPE html>
<html>
<head>
    <title>List of product inventory</title>
</head>
<body>
    <h1>List of product inventory</h1>
    <a href="/productInventory/create">Create New Product Inventory</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Available quantity</th>
                <th>Manufacture date</th>
                <th>Expiration date</th>
                <th>Label ID</th>
                <th>Packaging ID</th>
                <th>Compliance ID</th>
                <th>Order ID</th>
                <th>Client ID</th>
                <th>Offer ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productInventory as $inventory)
            <tr>
                <td>{{ $inventory->id_inventory }}</td>
                <td>{{ $inventory->available_quantity }}</td>
                <td>{{ $inventory->manufacture_date }}</td>
                <td>{{ $inventory->expiration_date }}</td>
                <td>{{ $inventory->id_label }}</td>
                <td>{{ $inventory->id_packaging }}</td>
                <td>{{ $inventory->id_compliance }}</td>
                <td>{{ $inventory->id_order }}</td>
                <td>{{ $inventory->id_distribution_client }}</td>
                <td>{{ $inventory->id_offer }}</td>
                <td>
                    <a href="/productInventory/{{ $inventory->id_inventory }}/edit">Edit</a>
                    <form action="/productInventory/{{ $inventory->id_inventory }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/">Back to Home</a>
</body>
</html>