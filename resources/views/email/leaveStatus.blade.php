
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
    <h2>Vehicle  Application Response</h2>
    <label class="form-check-label" for="gridCheck">
        Good day {{ $user['name']}} {{ $user['surname']}} ,<br><br>
       You have a response in regards to your Vehicle  Application <br><br>
       Leave Status: {{ $user['admin_status']}} <br>
       Status Comment: {{ $user['admin_comment']}}
         <br> </br>
       Kindly regards, <br>
       {{ $admin['name'] }} {{  $admin['surname']}}
    </label>

    </div>
