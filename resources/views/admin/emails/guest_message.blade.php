<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h2>Message Regarding Your Reservation #{{ $reservation->id }}</h2>

    <p>{{ $content }}</p>

    <hr>

    <p>Reservation Details:</p>
    <ul>
        <li>Guest: {{ $reservation->guest->getFullName() }}</li>
        <li>Check-in: {{ $reservation->check_in }}</li>
        <li>Check-out: {{ $reservation->check_out }}</li>
        <li>Room: {{ $reservation->room->room_number }}</li>
        <li>Status: {{ $reservation->status }}</li>
        <li>Total Price: {{ $reservation->amount }}</li>
        <li>Created At: {{ $reservation->created_at }}</li>
        <li>Updated At: {{ $reservation->updated_at }}</li>
    </ul>

    <p>Thank you,</p>
    <p>{{ app('settings')->hotel_name }}</p>
</body>
</html>
