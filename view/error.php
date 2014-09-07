<script src="js/views/error.js" type="text/javascript"></script>
<h1><?php echo $error; ?> error page</h1>
<p>
<?php
    switch ($error) {
    case 401:
        echo "Sorry, unauthorized access is not allowed";
        break;
    case 419:
        echo "Authentication Timeout!, please re-authentication again";
        break;
    case 499:
        echo "Token required!, please use the link with token attached";
        break;
    }
?>
</p>