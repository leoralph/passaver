{{print_r($errors)}}
<form action="" method="POST">
    @csrf
    <input type="email" name="email" id="email">
    <br>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="">
</form>
