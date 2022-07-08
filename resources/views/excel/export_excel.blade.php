<table>
    <thead>
    <tr>
        <th>id</th>
        <th>date1</th>
        <th>date2</th>
    </tr>
    </thead>
    <tbody>
    @foreach($disneyplus as $disney)
        <tr>
            <td>{{ $disney->id }}</td>
            <td>{{ $disney->created_at }}</td>
            <td>{{ $disney->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>