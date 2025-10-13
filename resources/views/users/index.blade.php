<h2>Users List</h2>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
    </tr>
    @endforeach
</table>
