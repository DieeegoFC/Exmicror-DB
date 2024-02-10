<!DOCTYPE html>
<html>
<head>
    <title>Edit packaging detail</title>
</head>
<body>
    <h1>Edit packaging detail</h1>
    <form action="/packaging/{{ $packagingDetail->id_packaging }}" method="POST">
        @csrf
        @method('PUT')
        <label for="packaging_type">Packaging type:</label>
        <input type="text" name="packaging_type" id="packaging_type" value="{{ $packagingDetail->packaging_type }}" required><br>
        <label for="packaging_material">Packaging material:</label>
        <input type="text" name="packaging_material" id="packaging_material" value="{{ $packagingDetail->packaging_material }}" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>