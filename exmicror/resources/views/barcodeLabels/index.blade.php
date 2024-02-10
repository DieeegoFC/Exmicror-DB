<!DOCTYPE html>
<html>
<head>
    <title>List of barcode labels</title>
</head>
<body>
    <h1>List of barcode labels</h1>
    <a href="/barcodeLabels/create">Create new barcode label</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Label information</th>
                <th>Barcode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barcodeLabels as $label)
            <tr>
                <td>{{ $label->id_label }}</td>
                <td>{{ $label->label_information }}</td>
                <td>{{ $label->barcode }}</td>
                <td>
                    <a href="/barcodeLabels/{{ $label->id_label }}/edit">Edit</a>
                    <form action="/barcodeLabels/{{ $label->id_label }}" method="POST">
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