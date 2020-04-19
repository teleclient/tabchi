<?php
# @Z_PHP

$Admin = [''];
$listplugins = [
    "options",
    "options2",
    "send_fwd",
];
//========================
$cplug = count($listplugins) - 1;
for ($n = 0; $n <= $cplug; $n++) {
    $pluginlist = "Plugins/" . $listplugins[$n] . ".php";
    include($pluginlist);
}

$data = json_decode(file_get_contents("data.json"), true);
$markread = $data["data"]["markread"];
$typing   = $data["data"]["typing"];
$contacts = $data["data"]["contacts"];
$link     = $data["data"]["link"];

# S  O  U  L  O  O  S  H
