<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Members</title>
    <style>
        h2{
            text-align: center;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
{{-- @dd($members); --}}
<body>
    <h2>All Members</h2>

    <table>
        <thead>
            <tr>
                <th>Member id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Group id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            <tr>
                <td>{{$member->member_id}}</td>
                <td>{{$member->name}}</td>
                <td>{{$member->email}}</td>
                <td>{{$member->contact}}</td>
                <td>{{$member->group_id}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $members->links() }}
</body>

</html>