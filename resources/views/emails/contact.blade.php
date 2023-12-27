<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de {{$nom}}</title>
</head>
<body>
<table style="width: 100%; max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; line-height: 1.4; color: #333333;">
        <tr>
            <td>
                <h1 style="font-size: 24px; color: #333333;">Nouveau message de {{ $nom }}</h1>
                <p style="font-size: 16px; color: #666666; margin-bottom: 16px;"><strong>Email:</strong> {{ $email }}</p>
                <h2 style="font-size: 24px; color: #333333;">Type de demande: {{ $demande }}</h2>
                <p style="font-size: 16px; color: #666666;"><strong>Message:</strong></p>
                <p style="font-size: 16px; color: #666666;">{{ $mess }}</p>
            </td>
        </tr>
    </table>
</body>
</html>