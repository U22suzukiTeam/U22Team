<?php
require 'vendor/autoload.php';

use ChatApp\Models\Message;
echo Message::all() -> toJSON();

?>