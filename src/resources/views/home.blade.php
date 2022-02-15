<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<h1>Hello</h1>
    Your token is: <div id="id_token"></div>
    <button type="submit" onClick="userLogout()">Logout</button>
<a href="http://localhost:8088/api/documentation">Show My API</a>

<script>
    const token = window.localStorage.getItem('token');
    $('#id_token').html(token);
</script>

<script>
    function userLogout(){
        const token = window.localStorage.getItem('token');
        $.ajax({
            url: '/signout/' + token,
            type: 'DELETE',
            success: function(result) {
                window.localStorage.removeItem('token')
                window.location.href = "http://localhost:8088/login";
            }
        });
    }
</script>

