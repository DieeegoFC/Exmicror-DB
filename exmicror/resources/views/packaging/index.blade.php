<!DOCTYPE html>
<html>
<head>
    <title>List of packaging details</title>
</head>
<body>
    <h1>List of packaging details</h1>
    <a href="/packaging/create">Create new packaging detail</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Packaging type</th>
                <th>Packaging material</th>
                <th>Packaging date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packagingDetails as $detail)
            <tr>
                <td>{{ $detail->id_packaging }}</td>
                <td>{{ $detail->packaging_type }}</td>
                <td>{{ $detail->packaging_material }}</td>
                <td>{{ $detail->packaging_date }}</td>
                <td>
                    <a href="/packaging/{{ $detail->id_packaging }}/edit">Edit</a>
                    <form action="/packaging/{{ $detail->id_packaging }}" method="POST">
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