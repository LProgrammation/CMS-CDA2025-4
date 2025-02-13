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

}
else{
    echo "The mode option is required";
}