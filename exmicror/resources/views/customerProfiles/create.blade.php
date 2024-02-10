<!DOCTYPE html>
<html>
<head>
    <title>Create customer profile</title>
</head>
<body>
    <h1>Create customer profile</h1>
    <form action="/customerProfiles" method="POST">
        @csrf
        <label for="customer_name">Customer name:</label><br>
        <input type="text" name="customer_name" id="customer_name" required><br>
        <label for="demographic_information">Demographic information:</label><br>
        <textarea name="demographic_information" id="demographic_information" required></textarea><br>
        <label for="customer_contact">Customer contact:</label><br>
        <input type="text" name="customer_contact" id="customer_contact"><br>
        <label for="purchase_history">Purchase history:</label><br>
        <textarea name="purchase_history" id="purchase_history"></textarea><br>
        <label for="preferences">Preferences:</label><br>
        <textarea name="preferences" id="preferences"></textarea><br>
        <label for="id_distribution_client">Distribution client ID:</label><br>
        <input type="number" name="id_distribution_client" id="id_distribution_client" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>