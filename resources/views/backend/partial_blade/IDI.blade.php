<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>စတိုစာရင်း</title>
    <style>
        h1 {
            font-family: monospace;
        }

        th,
        td {
            border: 1px solid black;
            text-align: center;
        }

        .table1 {
            margin-left: auto;
            margin-right: auto;
        }

        table td,
        th {
            padding: 8px;
        }

        table {
            border-collapse: collapse;
            width: 70em;
        }

        .nothing {
            width: 5em;
        }

        .table2 {
            width: 60em;
            margin-top: 2px;
            background-color: lightblue;
            margin-left: 30px;
        }

        .spans {
            background-color: blue;
            border: 1px solid black;
            border-radius: 2px;
            color: white;
            border-radius: 5px;
            padding: 1px 2px;
        }

        .spans2 {
            border: 1px solid black;
            background-color: #11dd26;
            border-radius: 2px;
        }

        tr.shown td.details-control {
            background: url("https://datatables.net/examples/resources/details_open.png") no-repeat center center;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">စတိုစာရင်း</h1>

    <table class="table1">
        <tbody>
            <tr>
                <th class="nothing"></th>
                <th>ရက်စွဲ</th>
                <th>ပစ္စည်းဝင်လာသည့် နေရာ</th>
                <th>အရေအတွက်</th>
            </tr>

            @foreach ($groups as $date => $items)
            @foreach ($items as $alms_round_name => $item)
            <tr class="shown">
                <td class="details-control"></td>
                <td>{{$date}}</td>
                <td>{{$alms_round_name}}</td>
                <td>{{count($item)}}</td>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table2">
                        <tr>
                            <th>နံပါတ်</th>
                            <th>ပစ္စည်း အမည်</th>
                            <th>နှုန်းထား</th>
                            <th>ပမာဏ</th>
                        </tr>
                        @foreach ($item as $key => $record)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$record->itemSubType->name}}</td>
                            <td>
                                <span class="badge badge-primary">{{ $record->itemSubType->sacket_per_package }} </span> {{$record->itemSubType->unit->loose_unit}} ပါသည်
                            </td>
                            <td>
                                <span class="badge badge-primary"> {{ $record->package_qty }} </span> {{$record->itemSubType->unit->package_unit}} <span class="badge badge-primary"> {{$record->sacket_qty}} </span> {{$record->itemSubType->unit->loose_unit}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>