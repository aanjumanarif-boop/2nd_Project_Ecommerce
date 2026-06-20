<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#bed4f6;
}

.login-box{
    width:350px;
    background:#fff;
    padding:35px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.login-box h2{
    text-align:center;
    margin-bottom:25px;
    color:hsl(264, 92%, 32%);
}

.input-group{
    margin-bottom:15px;
}

.input-group input{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:8px;
    outline:none;
}

.input-group input:focus{
    border-color:#4f46e5;
}

.btn{
    width:100%;
    padding:12px;
    background:#4f46e5;
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

.btn:hover{
    background:#4338ca;
}

.links{
    margin-top:15px;
    text-align:center;
}

.links a{
    text-decoration:none;
    color:#4f46e5;
}
</style>
</head>
<body>

<div class="login-box">
    <h2>Customer Login</h2>

    <form action="{{url('/customer/login/auth')}}" method="POST">
        @csrf
        <div class="input-group">
            <input type="email" name="email" placeholder="Your Email" id="email" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" id="password" required>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="links">
            <p><a href="{{url('/')}}">Home</a></p>
           <a href="{{url('/customer/registration')}}">Create New Account</a>
        </div>
    </form>
</div>

</body>
</html>