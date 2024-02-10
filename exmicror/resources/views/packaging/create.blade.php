<!DOCTYPE html>
<html>
<head>
    <title>Create new packaging detail</title>
</head>
<body>
    <h1>Create new packaging detail</h1>
    <form action="/packaging" method="POST">
        @csrf
        <label for="packaging_type">Packaging type:</label>
        <input type="text" name="packaging_type" id="packaging_type" required><br>
        <label for="packaging_material">Packaging material:</label>
        <input type="text" name="packaging_material" id="packaging_material" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>