<form action="../public/index.php?route=test/html" method="post">
    <input type="text" name="test" id="test">
    <input type="submit" value="submit">
</form>
<?php
 $dir='localhost/UniCS/templates/login.html.php';
echo $dir;
header('location: localhost/UniCS/templates/login.html.php');
?>