<!DOCTYPE html>
<html>
<head>
    <title>List of invoices</title>
</head>
<body>
    <h1>List of invoices</h1>
    <a href="/invoices/create">Create new invoice</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Total amount</th>
                <th>Issuance date</th>
                <th>Invoice type</th>
                <th>Order ID</th>
                <th>Client ID</th>
                <th>Offer ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id_invoice }}</td>
                <td>{{ $invoice->total_amount }}</td>
                <td>{{ $invoice->issuance_date }}</td>
                <td>{{ $invoice->invoice_type }}</td>
                <td>{{ $invoice->id_order }}</td>
                <td>{{ $invoice->id_distribution_client }}</td>
                <td>{{ $invoice->id_offer }}</td>
                <td>
                    <a href="/invoices/{{ $invoice->id_invoice }}/edit">Edit</a>
                    <form action="/invoices/{{ $invoice->id_invoice }}" method="POST">
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