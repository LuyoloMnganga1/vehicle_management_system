
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
    <h2>User Account Created</h2>
    <label class="form-check-label" for="gridCheck">
        Good day {{ $name }} {{ $surname}},<br>
        Your account for <strong>Leave System</strong> has been created.<br>
        Click the button bellow to set password : <br> </br>
        <a style = "margin-left: 30%;background-color: #4CAF50;" href=" http://127.0.0.1:8000/passwordCreate/{{$id}}/{{$token}}" tagert="_blank"><button type="button" class = "button" style="background-color: #4CAF50; /* Green */
            border: 1px solid #4CAF50;
            border-radius: 0.6rem;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;">Set Password</button></a>
        <br> </br>
        Adminstrator
    </label>

    </div>
</div>
