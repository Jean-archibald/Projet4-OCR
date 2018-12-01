<?php
var_dump($_SESSION);
if(isset($_SESSION) && $_SESSION['nickname'] == 'jean' &&
$_SESSION['password'] == 'forteroche')
{
    require __DIR__.'/../../View/Backend/adminHomeView.php';
}
else
{
    $message = '<p class="messageProbleme">Accès réservé à l\'auteur !<p/>';
}
?>


<p>
<?php
    if (isset($message))
    {
        echo $message, '<br />';
    }
?>
</p>