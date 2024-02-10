<!DOCTYPE html>
<html>
<head>
    <title>List of orders</title>
</head>
<body>
    <h1>List of orders</h1>
    <a href="/orders/create">Create new order</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Requested 1uantity</th>
                <th>Order date</th>
                <th>Expected delivery date</th>
                <th>Order status</th>
                <th>Client ID</th>
                <th>Offer ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id_order }}</td>
                <td>{{ $order->requested_quantity }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->expected_delivery_date }}</td>
                <td>{{ $order->order_status }}</td>
                <td>{{ $order->id_client }}</td>
                <td>{{ $order->id_offer }}</td>
                <td>
                    <a href="/orders/{{ $order->id_order }}/edit">Edit</a>
                    <form action="/orders/{{ $order->id_order }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>