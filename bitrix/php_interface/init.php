<?php

function writeJsonToFiles($text)
{

$json = json_encode($text);
$file = fopen('/bitrix/templates/aspro_max/components/aspro/tabs.max/main_new/data.json','w+');
fwrite($file, $json);
fclose($file);

}