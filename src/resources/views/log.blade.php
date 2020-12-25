<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="pt-4 pb-4">
        <h1>Buty Logs</h1>
    </div>

    <table class="table">
        <tr>
            <th>Title</th>
            <th>Data</th>
        </tr>

        @foreach($logs as $log)
        <tr>
            <td>{{ $log->title }}</td>
            <td class="text-primary" style="border: 1px solid #eeeeee">
                <code>{{ var_dump($log->data) }}</code>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>
