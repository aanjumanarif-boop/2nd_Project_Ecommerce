<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Registration</title>

<style>
body{
    background:#DCDDDF url(https://cssdeck.com/uploads/media/items/7/7AF2Qzt.png);
    font-family:Arial, Helvetica, sans-serif;
}

.container{
    width:420px;
    margin:40px auto;
}

#content{
    background:#f9f9f9;
    border:1px solid #c4c6ca;
    padding:30px;
    text-align:center;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

#content h1{
    color:#666;
    margin-bottom:25px;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="file"]{
    width:90%;
    padding:12px;
    margin:8px 0;
    border:1px solid #ccc;
    border-radius:4px;
    font-size:14px;
}

input[type="submit"]{
    background:#f7b733;
    border:none;
    color:#1c0da0;
    padding:12px 25px;
    margin-top:15px;
    font-size:16px;
    border-radius:25px;
    cursor:pointer;
}

input[type="submit"]:hover{
    background:#e09c12;
}

.links{
    margin-top:15px;
}

.links a{
    text-decoration:none;
    margin:0 10px;
}

.account{
    color:blue;
    border-radius: 5px;
    padding: 4px 6px;
    background-color: #9debcb;
}

.home{
    color:rgb(35, 26, 216);
    border-radius: 5px;
    padding: 4px 6px;
    background-color: #e6c583;
}
</style>
</head>

<body>

<div class="container">
<section id="content">

<form method="POST" action="{{ url('/customer/registration-store') }}" enctype="multipart/form-data">
    @csrf

    <h1>Customer Registration</h1>

    <input type="text" name="name" placeholder="Full Name" required>

    <input type="text" name="phone" placeholder="Phone Number" required>

    <input type="email" name="email" placeholder="Email Address" required>

    <input type="password" name="password" placeholder="Password" required>

    <input type="file" name="image">

    

    <div class="links">
        <a href="{{ url('/customer/login') }}" class="account">Already have account</a>
        <a href="{{ url('/') }}" class="home">Home</a>
    </div>
     <input type="submit" value="Register">
     
</form>

</section>
</div>

</body>
</html>