<?php

// some code that notifies someone about new info request
error_log('Email was: ' . $_POST['email']);
error_log('Message was: ' . $_POST['message']);
error_log('Notify about new info request ...');

// this script does not produce output itself
// but delegates it to different location.
header('Location: thanks.html');
