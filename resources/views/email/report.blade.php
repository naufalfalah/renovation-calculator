<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Renovation Budget Report</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2 style="color: #4CAF50;">Hello {{ $report['full_name'] }},</h2>

    <p>Thank you for using <strong>Jome</strong> to plan your renovation! Below is a summary of your renovation budget report as of <strong>{{ $report['date'] }}</strong>.</p>

    <h3 style="color: #4CAF50;">Property Details</h3>
    <ul>
        <li><strong>Property Type:</strong> {{ $report['property_type'] }}</li>
        <li><strong>Property Status:</strong> {{ $report['property_status'] }}</li>
        <li><strong>Size:</strong> {{ $report['size'] }} {{ strtoupper($report['base_unit']) }}</li>
    </ul>

    <h3 style="color: #4CAF50;">Selected Rooms & Works</h3>
    <ul>
        @foreach($report['room_labels'] as $label)
            <li><strong>{{ $label }}</strong></li>
        @endforeach
    </ul>

    <hr>

    <p>If you have any questions or need further assistance, feel free to contact us at <a href="mailto:support@jome.com">support@jome.com</a>.</p>

    <p>Best regards,<br>
    The Jome Team</p>
</body>
</html>
