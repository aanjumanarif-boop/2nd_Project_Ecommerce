
<!DOCTYPE html>
<html>
<head>
    <title>Employee Login </title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
        }

        .login-container{
            width:350px;
            margin:100px auto;
            background:#fff;
            padding:25px;
            border-radius:8px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
            color: #459af5
        }

        .form-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            margin-bottom:5px;
        }

        input{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            width:100%;
            padding:10px;
            border:none;
            background:#007bff;
            color:white;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#0056b3;
        }

        .register-link{
            text-align:center;
            margin-top:15px;
        }

        .register-link a{
            text-decoration:none;
            color:#007bff;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Welcome Back!</h2>

    <form action="{{url('/employee/login/auth')}}" method="POST">
        @csrf

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" class="@error('email') is-invalid @enderror" required>

        @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" class="@error('password') is-invalid @enderror" required>
        
              @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
            @enderror
        
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        <p>Don't have an account? <a href="{{url('/')}}">Home</a></p>
    </div>
</div>

</body>
</html>