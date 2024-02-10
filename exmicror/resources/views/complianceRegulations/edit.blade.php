<!DOCTYPE html>
<html>
<head>
    <title>Edit compliance regulation</title>
</head>
<body>
    <h1>Edit compliance regulation</h1>
    <form action="/complianceRegulations/{{ $complianceRegulation->id_compliance }}" method="POST">
        @csrf
        @method('PUT')
        <label for="mexico_compliance">Mexico compliance:</label>
        <input type="checkbox" name="mexico_compliance" id="mexico_compliance" {{ $complianceRegulation->mexico_compliance ? 'checked' : '' }}><br>
        <label for="united_states_compliance">United States compliance:</label>
        <input type="checkbox" name="united_states_compliance" id="united_states_compliance" {{ $complianceRegulation->united_states_compliance ? 'checked' : '' }}><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>