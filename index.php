<?php

$message = 'THE DEVELOPMENT OF NELLA FORMS HAS BEEN ABANDONED';

if (PHP_SAPI === 'cli') {
	$message .= PHP_EOL . 'Please use stable version (v0.8.0)' . PHP_EOL;
} else {
	$message .= PHP_EOL . '<br>' . PHP_EOL . 'Please use stable version (v0.8.0)';
}

die($message);
