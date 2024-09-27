<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - My Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>User Dashboard - My Tickets</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Issue</th>
                <th>Status</th>
                <th>Response</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->issue }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->response ?? 'No response yet' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button class="btn btn-success mb-3" data-bs-toggle="collapse" data-bs-target="#createTicketForm">
        Create New Ticket
    </button>

    <div id="createTicketForm" class="collapse">
        <form action="{{ route('user.ticket.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="issue" class="form-label">Describe your issue:</label>
                <textarea class="form-control" id="issue" name="issue" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Ticket</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
