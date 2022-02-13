<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>အဝေ စာရင်း</title>
    <style>
        body {
            font-family: 'pyidaungsu';
            color: black;
            background-color: white;
            padding: 0 4rem;
            max-width: 2480px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        h3 {
            font-size: 13px;
            color: black;
            text-align: center;
        }
    </style>
</head>

<body>

    <h3>({{$nowDate}}) စတို စာရင်း</h3>

    <table>
        <tr>
            <th>ရက်စွဲ</th>
            <th>ပစ္စည်း ဝင်လာသည့် နေရာ</th>
            <th>ပစ္စည်း အမည်</th>
            <th>နှုန်းထား</th>
            <th>ပမာဏ</th>
            <th>အခြေအနေ</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{$d->date}}</td>
            <td>{{$d->almsRound->name}}</td>
            <td>{{$d->itemSubType->name}}</td>
            <td>{{$d->itemSubType->sacket_per_package}}</td>
            <td>{{$d->package_qty . ' ' . $d->itemSubType->unit->package_unit . ' / ' . $d->sacket_qty . ' ' . $d->itemSubType->unit->loose_unitdate}}</td>
            <td>{{\App\Status\InternalDonatedItemStatus::advanceSearch(($d->status))["label"]}}</td>
        </tr>
        @endforeach

    </table>
</body>

</html>