<!DOCTYPE html>
<html>
<head>
    <title>List of special offers</title>
</head>
<body>
    <h1>List of special offers</h1>
    <a href="/specialOffers/create">Create new special offer</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Offer description</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Included products</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($specialOffers as $offer)
            <tr>
                <td>{{ $offer->id_offer }}</td>
                <td>{{ $offer->offer_description }}</td>
                <td>{{ $offer->start_date }}</td>
                <td>{{ $offer->end_date }}</td>
                <td>{{ $offer->included_products }}</td>
                <td>
                    <a href="/specialOffers/{{ $offer->id_offer }}/edit">Edit</a>
                    <form action="/specialOffers/{{ $offer->id_offer }}" method="POST">
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