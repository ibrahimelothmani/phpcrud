<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: authenticator.php');
    exit;
}
?>

<?php
include 'functions.php';
// Your PHP code here.
// Home Page template below.
?>
<?=template_header('Home')?>
<div class="content">
<h2>Home</h2>
<p>Welcome to the home page!</p>
</div>
<?=template_footer()?>