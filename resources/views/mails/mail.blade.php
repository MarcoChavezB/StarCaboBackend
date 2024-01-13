<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Reserva</title>
    <style>
        button {
            cursor: pointer;
        }

        .buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            height: 100%;
            width: 100%;
        }

        .btn-rechazar,
        .btn-aceptar {
            background-color: #dc3545;
            color: #fff;
            border: 1px solid #dc3545;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
        }

        .btn-rechazar:hover {
            background-color: #c82333;
        }

        .btn-aceptar {
            background-color: #28a745;
            border: 1px solid #28a745;
        }

        .btn-aceptar:hover {
            background-color: #218838;
        }
    </style>
</head>

<body style="font-family: 'Arial', sans-serif; background-color: #f5f5f5; margin: 0; padding: 0;">

    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #fff; max-width: 600px; margin: 20px auto; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #333; margin-bottom: 20px;">Nueva reservacion realizada</h1>
                <h2 style="color: #333; margin-bottom: 20px;">Confirmacion de reservacion </h2>
                <p style="color: #666; margin-bottom: 10px;">se realizo una reserva desde la web con la siguiente informacion:</p>

                <h2 style="color: #333; margin-bottom: 20px;">Informacion de contacto:</h2>
                <p style="color: #666; margin-bottom: 10px;">Nombre: {{$tiketData['personal_information']['name']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Apellido: {{$tiketData['personal_information']['last_name']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Telefono: {{$tiketData['personal_information']['first_tel']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Email: {{$tiketData['personal_information']['email']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Necesita asiento de bebe: {{$tiketData['personal_information']['seat']}}</p>
                @if($tiketData['personal_information']['second_tel'])
                <p style="color: #666; margin-bottom: 10px;">Telefono 2: {{$tiketData['personal_information']['second_tel']}}</p>
                @endif

                <h2 style="color: #333; margin-bottom: 10px;">Comentarios del cliente:</h2>
                @if($tiketData['personal_information']['aditionals_comments'])
                <p style="color: #666; margin-bottom: 10px;">{{$tiketData['personal_information']['aditionals_comments']}}</p>
                @endif

                <h2 style="color: #333; margin-bottom: 20px;">Informacion de llegada:</h2>
                <p style="color: #666; margin-bottom: 10px;">Tipo de viaje: {{$tiketData['arrive_information']['type_trip']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Punto de encuentro: {{$tiketData['arrive_information']['star_location']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Lugar de destino: {{$tiketData['arrive_information']['end_location']}}</p>

                @if($tiketData['arrive_information']['flight_number'])
                <p style="color: #666; margin-bottom: 10px;">Numero de vuelo: {{$tiketData['arrive_information']['flight_number']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Aerolinea: {{$tiketData['arrive_information']['airline']}}</p>
                @endif


                <p style="color: #666; margin-bottom: 10px;">Fecha de llegada: {{$tiketData['arrive_information']['arrive_date']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Hora de llegada: {{$tiketData['arrive_information']['time']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Numero de pasajeros: {{$tiketData['arrive_information']['number_passengers']}}</p>

                @if($tiketData['second_arrive_information']['star_location'])
                <h2 style="color: #333; margin-bottom: 20px;">Informacion de llegada 2:</h2>
                <p style="color: #666; margin-bottom: 10px;">Lugar de llegada: {{$tiketData['second_arrive_information']['star_location']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Lugar de destino: {{$tiketData['second_arrive_information']['end_location']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Dia: {{$tiketData['second_arrive_information']['second_date']}}</p>
                <p style="color: #666; margin-bottom: 10px;">Hora: {{$tiketData['second_arrive_information']['second_time']}}</p>
                @endif

                <h2 style="color: #333; margin-bottom: 20px;">Costo: {{$tiketData['arrive_information']['total']}} $</h2>

                <h2 style="color: #333; margin-bottom: 20px;">Star Cabo Services</h2>
            </td>
        </tr>
    </table>
    <div class="buttons">
    <form action="https://back-end.studio/send-email-rechazo" method="post">
        @csrf
        <input type="hidden" name="email" value="{{$tiketData['personal_information']['email']}}">
        <button type="submit" class="btn-rechazar">Rechazar</button>
    </form>

    <form action="https://back-end.studio/send-email-aceptar" method="post">
        @csrf
        <input type="hidden" name="email" value="{{$tiketData['personal_information']['email']}}">
        <button type="submit" class="btn-aceptar">Aceptar</button>
    </form>        
    </div>
    </script>
</body>

</html>