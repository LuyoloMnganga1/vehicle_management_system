
<h1> Vehicle  Application of {{$user['name']}} {{$user['surname']}}  Response </h1><br>
Good day  {{$super['name'] }} {{$super['surname']}},<br>
I have  {{ $user['admin_status']}} for Vehicle  Application  of   {{$user['name']}} {{$user['surname']}} <br><br>
        <strong>LEAVE DETAILS AS FF: </strong> <br>
        <ul>
            <li>Leave type: {{ $user['leavetype']}}</li>
            <li>Days applied for: {{ $user['apply_days']}}</li>
            <li>Start date: {{ $user['startDate']}} </li>
            <li>End date: {{ $user['endDate']}} </li>
        </ul> <br>
Kindly regards, <br>
{{$admin['name'] }} {{$admin['surname']}}.
