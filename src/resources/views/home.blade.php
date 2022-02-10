<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<h1>Hello</h1>
    Your token is: <div id="id_token">{{$token}}</div>
    <button type="submit" onClick="userLogout()">Logout</button>
<a href="http://localhost:8088/api/documentation">Show My API</a>

<script>
    const token = $('#id_token').html();
    window.localStorage.setItem('token', token);
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

