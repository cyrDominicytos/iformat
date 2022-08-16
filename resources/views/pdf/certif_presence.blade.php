<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #000;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #000;
        }

        #customers tr:hover {
            background-color: #000;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            /* background-color: #04AA6D; */
            background-color: #000;
            color: white;
        }
    </style>
</head>

<body>

    <h3 style="text-align: center">Liste des participants présents à l'examen</h3>

    <table id="customers">
        <tr style="background-image: linear-gradient(to bottom right,#005AAB, #F36F21);">
            <th>N °</th>
            <th>Noms et Prénoms</th>
            <th>Institutions</th>
            <th>Fonctions</th>
            <th>Contats</th>
        </tr>
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-bold">

            @foreach($users as $key=> $user)
            <!--begin::Table row-->
            <tr>
              
                <td class="d-flex align-items-center">
                    <?= $key +1 ?>
                </td>
                <td class="d-flex align-items-center">
                    <?= $user->first_name . " " . $user->last_name ?>
                </td>
                
                <td class="text-capitalize">{{$user->from}}</td>
                <td class="text-capitalize">{{$user->fonction}}</td>
                <td><?= $user->email. "/ " .$user->phone_number ?></td>
            </tr>
            <!--end::Table row-->
            @endforeach
        </tbody>
        <!--end::Table body-->
    </table>

</body>

</html>