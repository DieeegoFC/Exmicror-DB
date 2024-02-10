<!DOCTYPE html>
<html>
<head>
    <title>Edit distribution client</title>
</head>
<body>
    <h1>Edit distribution client</h1>
    <form action="/distributionClients/{{ $distributionClient->id_distribution_client }}" method="POST">
        @csrf
        @method('PUT')
        <label for="client_name">Client name:</label>
        <input type="text" name="client_name" id="client_name" value="{{ $distributionClient->client_name }}" required><br>
        <label for="client_type">Client type:</label>
        <input type="text" name="client_type" id="client_type" value="{{ $distributionClient->client_type }}" required><br>
        <label for="client_contact">Contact:</label>
        <input type="text" name="client_contact" id="client_contact" value="{{ $distributionClient->client_contact }}"><br>
        <label for="client_phone">Phone:</label>
        <input type="text" name="client_phone" id="client_phone" value="{{ $distributionClient->client_phone }}"><br>
        <label for="client_email">Email:</label>
        <input type="email" name="client_email" id="client_email" value="{{ $distributionClient->client_email }}"><br>
        <label for="contractual_details">Contractual details:</label><br>
        <textarea name="contractual_details" id="contractual_details" rows="4" cols="50">{{ $distributionClient->contractual_details }}</textarea><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>