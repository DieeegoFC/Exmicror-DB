<!DOCTYPE html>
<html>
<head>
    <title>Edit barcode label</title>
</head>
<body>
    <h1>Edit barcode label</h1>
    <form action="/barcodeLabels/{{ $barcodeLabel->id_label }}" method="POST">
        @csrf
        @method('PUT')
        <label for="label_information">Label information:</label>
        <input type="text" name="label_information" id="label_information" value="{{ $barcodeLabel->label_information }}" required><br>
        <label for="barcode">Barcode:</label>
        <input type="text" name="barcode" id="barcode" value="{{ $barcodeLabel->barcode }}" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>