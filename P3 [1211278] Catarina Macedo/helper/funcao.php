<?php 

function check_session()
{
// check if there is an active session
return isset($_SESSION['user']);
}

?>