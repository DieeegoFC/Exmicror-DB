<!DOCTYPE html>
<html>
<head>
    <title>List of compliance regulations</title>
</head>
<body>
    <h1>List of compliance regulations</h1>
    <a href="/complianceRegulations/create">Create new compliance regulation</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mexico compliance</th>
                <th>United States compliance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complianceRegulations as $regulation)
            <tr>
                <td>{{ $regulation->id_compliance }}</td>
                <td>{{ $regulation->mexico_compliance ? 'Yes' : 'No' }}</td>
                <td>{{ $regulation->united_states_compliance ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="/complianceRegulations/{{ $regulation->id_compliance }}/edit">Edit</a>
                    <form action="/complianceRegulations/{{ $regulation->id_compliance }}" method="POST">
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