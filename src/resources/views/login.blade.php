<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div>
    <div>
        <label>Email:</label>
        <input type="text" name="email" id="id_email" placeholder="Text email here">
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" id="id_password" placeholder="text your password"><br>
    </div>
    <div>
        <button type="submit" onClick="userLogin()">Login</button>
    </div>
</div>

<script>
    function userLogin(){
        const email = $('#id_email').val();
        const password = $('#id_password').val();
        $.ajax({
            url: '/login',
            type: 'POST',
            data: {email: email, password: password},
            success: function(result) {
                window.localStorage.setItem('token', result.token);
                window.location.href = "http://localhost:8088/home";
            }
        });
    }
</script>
