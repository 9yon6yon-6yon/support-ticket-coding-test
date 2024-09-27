<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Closed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            line-height: 1.5;
            font-size: 16px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ticket Closed</h1>
        </div>

        <div class="content">
            <p>Dear {{ $user->name }},</p>
            <p>We wanted to inform you that your ticket regarding the issue has been closed.</p>
            <p>Response from Admin:</p>
            <blockquote>{{ $ticket->response }}</blockquote>
            <p>If you have any further issues, feel free to open a new ticket. Thank you for your patience.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Support Ticket System. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
