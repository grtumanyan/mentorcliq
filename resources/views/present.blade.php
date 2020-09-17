<!DOCTYPE html>
<html>
<head>
    <title>MENTORCLIQ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></head>

<body>
<div class="container">

    <div class="panel panel-primary">
        @if($result['error'] == true)
            <div class="error">{{ $result['data'] }}</div>
        @else
            <div class="panel-heading"><h2>Matches!</h2></div>
            <div class="panel-body">


                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">First employee</th>
                        <th scope="col">Second employee</th>
                        <th scope="col">Match percent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result['data'] as $match)
                        <tr>
                            <td>{{ $match[0] }}</td>
                            <td>{{ $match[1] }}</td>
                            <td>{{ $match['percent'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
</div>
</body>
</html>



