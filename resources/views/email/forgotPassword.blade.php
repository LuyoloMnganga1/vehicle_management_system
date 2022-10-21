
 <style>
       .button {
            background-color: #030d92; /* Green */
            border: none;
            color: white;
            padding: 20px 50px;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
            /* display: inline-block; */
            font-size: 16px;
            border-radius: 4px;
            display: block;
            width: 200px;
            margin: 0 auto;
        }
        .button:hover {
            background-color: #bad63b; /* Green */
            color: white;
        }
 </style>
    <div class="container">
    <label class="form-check-label" for="gridCheck">
        <h2 style="text-align: center;">Rest Your ICT Choice Vehicle Management System Password</h2><br>
        <h4 style="color: red; text-align:center;">NB: The link is valid for 3 minutes!</h4> <br>
         <p style="text-align: center;">Click the button bellow to reset password :</p> <br></br>
        <a  href="http://127.0.0.1:8000/resetPassword/{{$id}}/{{$token}}" class="button" target="_blank" style=" background-color: #030d92; /* Green */
        border: none;
        color: white;
        padding: 20px 50px;
        text-align: center;
        font-weight: bold;
        text-decoration: none;
        /* display: inline-block; */
        font-size: 16px;
        border-radius: 4px;
        display: block;
        width: 200px;
        margin: 0 auto;">Reset Password</a>
        <br> </br>
        Adminstrator
    </label>

    </div>
</div>
