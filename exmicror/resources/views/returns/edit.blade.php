<!DOCTYPE html>
<html>
<head>
    <title>Edit return</title>
</head>
<body>
    <h1>Edit return</h1>
    <form action="/returns/{{ $return->id_return }}" method="POST">
        @csrf
        @method('PUT')
        <label for="returned_quantity">Returned quantity:</label>
        <input type="number" name="returned_quantity" id="returned_quantity" value="{{ $return->returned_quantity }}" required><br>
        <label for="return_reason">Return reason:</label>
        <input type="text" name="return_reason" id="return_reason" value="{{ $return->return_reason }}" required><br>
        <label for="corrective_actions">Corrective actions:</label>
        <input type="text" name="corrective_actions" id="corrective_actions" value="{{ $return->corrective_actions }}" required><br>
        <label for="id_order">Order ID:</label>
        <input type="number" name="id_order" id="id_order" value="{{ $return->id_order }}" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>