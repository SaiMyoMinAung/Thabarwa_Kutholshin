<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Admin Invitation</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        .container {
            width: 80%;
            height: auto;
            background-color: rgb(238, 235, 235);
            margin-right: auto;
            margin-left: auto;
            padding: 5px;
        }

        .header {
            text-align: center;
        }

        .content {
            margin-left: 12%;
        }

        .badge {
            border-radius: 15px;
            padding: 3px 10px;
            margin: 0 5px;
            text-align: center;
        }

        .badge-success {
            border: 1px solid lightgreen;
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img style="max-width:100%" src="{{asset('photos/Thabarwa_Centre_Header.jpg')}}">
        </div>
        <div class="content">
            <p>
                You are invited as a admin role.
                <p>You can login by using following credentials.</p>
                <ul>
                    <li>URL - {{route('admin.login')}}</li>
                    <li>Email - {{$admin->email}}</li>
                    <li>Password - {{$password}}</li>
                </ul>
        </div>

    </div>
</body>

</html>