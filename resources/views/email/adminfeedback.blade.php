
<h1> Vehicle  Application of {{$user['name']}} {{$user['surname']}}  Response </h1><br>
        Good day  {{$hod['name'] }} {{$hod['surname']}},<br>
       You have a response for Vehicle  Application  of   {{$user['name']}} {{$user['surname']}} <br>
       <strong>LEAVE DETAILS AS FF: </strong> <br>
       <ul>
           <li>Leave status: {{ $user['admin_status']}}</li>
           <li>Leave status comment: {{ $user['admin_comment']}}</li>
       </ul> <br>
       Kindly regards, <br>
       {{$admin['name'] }} {{$admin['surname']}}.
