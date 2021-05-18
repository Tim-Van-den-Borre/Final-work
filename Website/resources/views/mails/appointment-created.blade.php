<!DOCTYPE html>
<html>
    <head>
        <title>Appointment Manager</title>
    </head>
    <body>
        <img src="{{ URL::to('/images/Logo4.png')}}" style="width: 30%;">

        <p>Dear Sir,<br />Dear Madam,</p>

        <p>An appointment has been created for you on {{ $date }} at {{ $time }}  with doctor {{ $user[0]->name }}.</p>

        <p>Kind regards,<br />Appointment Manager</p>
    </body>
</html>