<?php
//  Insert migration script here
require_once('');
require_once('../src/model/BDD.php');
$BDD = BDD::getInstance();

$options = [
    "mode:",
    "number:",
];

$arguments = getopt("", $options);

if (isset($arguments['mode'])) {
    switch ($arguments['mode']) {
        case 'next':
            // Insert next action code
            break;
        case 'prev':
            // Insert previous action code
            break;
        case 'migrate':
            // Insert full migration action code
            break;
        case 'reset':
            // Insert reset migration action code
            break;
        default:
            // Insert default action code
            echo "Error: please enter valide migration mode (next, prev, migrate or reset" ;
            break;
    }
}
else{
    echo "The mode option is required";
}