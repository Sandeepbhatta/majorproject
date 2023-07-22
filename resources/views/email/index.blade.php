<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body>
    <p>Hi, {{ $booking->email }}</p>
    <br>
    <p>Your booking has been successfully placed</p>
    <br>
    <p>{{ $data['body'] }}</p>
    <h6>Booking Details</h6>
    <table style="width:600px; text-align:right">
        <thead>
            <tr>
                <th>Name</th>
                <th>Booked Date</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Package</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->start_date }}</td>
                <td>{{ $booking->end_date }}</td>
                <td >{{ $booking->package->name }}</td>

            </tr>
        </tbody>
    </table>

</body>
</html>
