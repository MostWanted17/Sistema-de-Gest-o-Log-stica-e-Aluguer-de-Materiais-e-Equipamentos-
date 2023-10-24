<?php

if (isset($_GET['logout'])) {
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
}
header('Location: /'); // Redirect to the homepage
exit; // Make sure to exit after the redirection

?>
