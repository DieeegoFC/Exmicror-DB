<!DOCTYPE html>
<html>
<head>
    <title>Create new compliance regulation</title>
</head>
<body>
    <h1>Create new compliance regulation</h1>
    <form action="/complianceRegulations" method="POST">
        @csrf
        <label for="mexico_compliance">Mexico compliance:</label>
        <input type="checkbox" name="mexico_compliance" id="mexico_compliance"><br>
        <label for="united_states_compliance">United States compliance:</label>
        <input type="checkbox" name="united_states_compliance" id="united_states_compliance"><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>