<!DOCTYPE html>
<html>
<head>
    <title>List of distribution clients</title>
</head>
<body>
    <h1>List of distribution clients</h1>
    <a href="/distributionClients/create">Create new distribution client</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client name</th>
                <th>Client yype</th>
                <th>Contact</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Contractual details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distributionClients as $client)
            <tr>
                <td>{{ $client->id_distribution_client }}</td>
                <td>{{ $client->client_name }}</td>
                <td>{{ $client->client_type }}</td>
                <td>{{ $client->client_contact }}</td>
                <td>{{ $client->client_phone }}</td>
                <td>{{ $client->client_email }}</td>
                <td>{{ $client->contractual_details }}</td>
                <td>
                    <a href="/distributionClients/{{ $client->id_distribution_client }}/edit">Edit</a>
                    <form action="/distributionClients/{{ $client->id_distribution_client }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>