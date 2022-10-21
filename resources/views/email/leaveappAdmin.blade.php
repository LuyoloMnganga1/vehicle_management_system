
 <style>
     .button{
        background-color: #4CAF50; /* Green */
        border: 1px solid #4CAF50;
        border-radius: 0.6rem;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
     }
 </style>
    <div class="container">
    <h2>Vehicle  Application Status update</h2>
    <label class="form-check-label" for="gridCheck">
        Good day {{ $admin['name'] }} {{  $admin['surname']}},<br><br>
        The is a new application for  {{ $user['name']}} {{ $user['surname']}}. <br>
        Please update status for his/her Vehicle  Applicatioin. <br>
        <strong>LEAVE DETAILS AS FF: </strong> <br>
        <ul>
            <li>Application Date:  {{$user['created_at']}} </li>
            <li>Leave type: {{ $user['leavetype']}}</li>
            <li>Days applied for: {{ $user['apply_days']}}</li>
            <li>Start date: {{ $user['startDate']}} </li>
            <li>End date: {{ $user['endDate']}} </li>
        </ul> <br>

        <a style = "margin-left: 30%;background-color: #4CAF50;" href="http://127.0.0.1:8000/dashboard" tagert="_blank"><button type="button" class = "button" style="background-color: #4CAF50; /* Green */
            border: 1px solid #4CAF50;
            border-radius: 0.6rem;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;">Take Action</button></a>

        <br></br>
        {{ $hod['department']}} Head of department <br>
        {{ $hod['name']}} {{ $hod['surname']}}
    </label>

    </div>
<!-- </div> -->
