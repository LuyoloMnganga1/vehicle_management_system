
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
    <h2 style="text-align:center;">Vehicle  Application</h2>
    <label class="form-check-label" for="gridCheck">
        Good day {{ $hod['name'] }} {{  $hod['surname']}},<br><br>
        I have applied for a leave, your feedback is highly appreciated.  <br><br>
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


         <br> </br>
        Regards <br>
        {{ $user['name']}} {{ $user['surname']}}
    </label>

    </div>
<!-- </div> -->
