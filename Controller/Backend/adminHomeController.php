<?php
if( $_SESSION['nickname'] = 'nickname' &&
$_SESSION['password'] = 'password')
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