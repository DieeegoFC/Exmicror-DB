<!DOCTYPE html>
<html>
<head>
    <title>Create new return</title>
</head>
<body>
    <h1>Create new return</h1>
    <form action="/returns" method="POST">
        @csrf
        <label for="returned_quantity">Returned quantity:</label>
        <input type="number" name="returned_quantity" id="returned_quantity" required><br>
        <label for="return_reason">Return reason:</label>
        <input type="text" name="return_reason" id="return_reason" required><br>
        <label for="corrective_actions">Corrective actions:</label>
        <input type="text" name="corrective_actions" id="corrective_actions" required><br>
        <label for="id_order">Order ID:</label>
        <input type="number" name="id_order" id="id_order" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>