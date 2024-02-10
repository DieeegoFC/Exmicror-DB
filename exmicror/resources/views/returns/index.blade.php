<!DOCTYPE html>
<html>
<head>
    <title>List of returns</title>
</head>
<body>
    <h1>List of returns</h1>
    <a href="/returns/create">Create new return</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Returned quantity</th>
                <th>Return reason</th>
                <th>Corrective actions</th>
                <th>Order ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returns as $return)
            <tr>
                <td>{{ $return->id_return }}</td>
                <td>{{ $return->returned_quantity }}</td>
                <td>{{ $return->return_reason }}</td>
                <td>{{ $return->corrective_actions }}</td>
                <td>{{ $return->id_order }}</td>
                <td>
                    <a href="/returns/{{ $return->id_return }}/edit">Edit</a>
                    <form action="/returns/{{ $return->id_return }}" method="POST">
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