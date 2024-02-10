<!DOCTYPE html>
<html>
<head>
    <title>Create new special offer</title>
</head>
<body>
    <h1>Create new special offer</h1>
    <form action="/specialOffers" method="POST">
        @csrf
        <label for="offer_description">Offer description:</label>
        <input type="text" name="offer_description" id="offer_description" required><br>
        <label for="start_date">Start date:</label>
        <input type="date" name="start_date" id="start_date" required><br>
        <label for="end_date">End date:</label>
        <input type="date" name="end_date" id="end_date"><br>
        <label for="included_products">Included products:</label><br>
        <textarea name="included_products" id="included_products" rows="4" cols="50"></textarea><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>