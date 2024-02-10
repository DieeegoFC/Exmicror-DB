<!DOCTYPE html>
<html>
<head>
    <title>Edit customer profile</title>
</head>
<body>
    <h1>Edit customer profile</h1>
    <form action="/customerProfiles/{{ $customerProfile->id_customer }}" method="POST">
        @csrf
        @method('PUT')
        <label for="customer_name">Customer name:</label><br>
        <input type="text" name="customer_name" id="customer_name" value="{{ $customerProfile->customer_name }}" required><br>
        <label for="demographic_information">Demographic information:</label><br>
        <textarea name="demographic_information" id="demographic_information" required>{{ $customerProfile->demographic_information }}</textarea><br>
        <label for="customer_contact">Customer contact:</label><br>
        <input type="text" name="customer_contact" id="customer_contact" value="{{ $customerProfile->customer_contact }}"><br>
        <label for="purchase_history">Purchase history:</label><br>
        <textarea name="purchase_history" id="purchase_history">{{ $customerProfile->purchase_history }}</textarea><br>
        <label for="preferences">Preferences:</label><br>
        <textarea name="preferences" id="preferences">{{ $customerProfile->preferences }}</textarea><br>
        <label for="id_distribution_client">Distribution client ID:</label><br>
        <input type="number" name="id_distribution_client" id="id_distribution_client" value="{{ $customerProfile->id_distribution_client }}" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
