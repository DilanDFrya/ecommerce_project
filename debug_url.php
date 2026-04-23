<?php
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "\n";
$url_parts = parse_url($_SERVER['REQUEST_URI']);
print_r($url_parts);
?>
