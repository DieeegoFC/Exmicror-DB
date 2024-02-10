<!DOCTYPE html>
<html>
<head>
    <title>Edit Invoice</title>
</head>
<body>
    <h1>Edit Invoice</h1>
    <form action="/invoices/{{ $invoice->id_invoice }}" method="POST">
        @csrf
        @method('PUT')
        <label for="total_amount">Total amount:</label>
        <input type="number" name="total_amount" id="total_amount" value="{{ $invoice->total_amount }}" required><br>
        <label for="issuance_date">Issuance date:</label>
        <input type="date" name="issuance_date" id="issuance_date" value="{{ $invoice->issuance_date }}" required><br>
        <label for="invoice_type">Invoice type:</label>
        <input type="text" name="invoice_type" id="invoice_type" value="{{ $invoice->invoice_type }}" required><br>
        <label for="id_order">Order ID:</label>
        <input type="number" name="id_order" id="id_order" value="{{ $invoice->id_order }}" required><br>
        <label for="id_distribution_client">Client ID:</label>
        <input type="number" name="id_distribution_client" id="id_distribution_client" value="{{ $invoice->id_distribution_client }}" required><br>
        <label for="id_offer">Offer ID:</label>
        <input type="number" name="id_offer" id="id_offer" value="{{ $invoice->id_offer }}" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>