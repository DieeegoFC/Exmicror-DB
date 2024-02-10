<!DOCTYPE html>
<html>
<head>
    <title>Create new barcode label</title>
</head>
<body>
    <h1>Create new barcode label</h1>
    <form action="/barcodeLabels" method="POST">
        @csrf
        <label for="label_information">Label information:</label>
        <input type="text" name="label_information" id="label_information" required><br>
        <label for="barcode">Barcode:</label>
        <input type="text" name="barcode" id="barcode" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>