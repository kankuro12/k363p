<h1 style="text-align: center;">
    New Request For MemberShip
</h1>
<table style="width:100%;">
    <tr>
        <th>Organization Name:</th><td>{{ $req->name }}</td><th>Organization address:</th><td>{{ $req->address }}</td>
    </tr>
    <tr>
        <th>Organization Email:</th><td>{{ $req->email }}</td><th>Organization phone:</th><td>{{ $req->phone }}</td>
    </tr>
    <tr>
        <th>Owner Name</th><td>{{$req->owner}}</td>
    </tr>
</table>

