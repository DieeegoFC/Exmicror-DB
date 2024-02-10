<!DOCTYPE html>
<html>
<head>
    <title>List of customer profiles</title>
</head>
<body>
    <h1>List of customer profiles</h1>
    <a href="/customerProfiles/create">Create New Customer Profile</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer name</th>
                <th>Demographic information</th>
                <th>Customer contact</th>
                <th>Purchase history</th>
                <th>Preferences</th>
                <th>Distribution client ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customerProfiles as $profile)
            <tr>
                <td>{{ $profile->id_customer }}</td>
                <td>{{ $profile->customer_name }}</td>
                <td>{{ $profile->demographic_information }}</td>
                <td>{{ $profile->customer_contact }}</td>
                <td>{{ $profile->purchase_history }}</td>
                <td>{{ $profile->preferences }}</td>
                <td>{{ $profile->id_distribution_client }}</td>
                <td>
                    <a href="/customerProfiles/{{ $profile->id_customer }}/edit">Edit</a>
                    <form action="/customerProfiles/{{ $profile->id_customer }}" method="POST">
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