<?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('HTTP/1.1 405 Method Not Allowed');
        exit('Invalid request method');
    } else  {
        if (!empty($_POST['honeypot'])) {
            // If the hidden field is not valid, handle the form submission as spam
            exit('Form submission rejected as potential spam!');
        } else {
            // If the hidden field is valid, process the form submission
            var_dump($_POST);
            
        }
    }
?>
