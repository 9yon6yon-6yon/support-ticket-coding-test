<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Ticket Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Admin Dashboard - Ticket List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>User</th>
                <th>Issue</th>
                <th>Status</th>
                <th>Response</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->user->name }}</td>
                <td>{{ $ticket->issue }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->response ?? 'No response yet' }}</td>
                <td>
                    @if($ticket->status == 'open')
                    <form action="{{ route('admin.ticket.respond', $ticket->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="text" name="response" placeholder="Enter response">
                        <button type="submit" class="btn btn-primary">Respond</button>
                    </form>
                    <form action="{{ route('admin.ticket.close', $ticket->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Close</button>
                    </form>
                    @else
                    <span class="badge bg-secondary">Closed</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
