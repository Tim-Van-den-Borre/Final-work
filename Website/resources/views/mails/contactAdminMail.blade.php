<!DOCTYPE html>
<html>
<head>
    <title>Appointment Manager</title>
</head>
<body>
    <img src="{{ URL::to('/images/Logo4.png')}}" style="width: 50%;">

    <p>Dear Admin,</p>

    <p>A message has been send by <b>{{ $contact['name'] }}</b> to you:</p>
    <p><b>{{ $contact['message'] }}</b></p>

    <p>Contact info: {{ $contact['email'] }}  /  {{ $contact['phone'] }} </p>
</body>
</html>