<!DOCTYPE html>
<html>
<head>
    <title>Create new distribution client</title>
</head>
<body>
    <h1>Create new distribution client</h1>
    <form action="/distributionClients" method="POST">
        @csrf
        <label for="client_name">Client name:</label>
        <input type="text" name="client_name" id="client_name" required><br>
        <label for="client_type">Client type:</label>
        <input type="text" name="client_type" id="client_type" required><br>
        <label for="client_contact">Contact:</label>
        <input type="text" name="client_contact" id="client_contact"><br>
        <label for="client_phone">Phone:</label>
        <input type="text" name="client_phone" id="client_phone"><br>
        <label for="client_email">Email:</label>
        <input type="email" name="client_email" id="client_email"><br>
        <label for="contractual_details">Contractual details:</label><br>
        <textarea name="contractual_details" id="contractual_details" rows="4" cols="50"></textarea><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>