<?php

require_once 'unirest-php/lib/Unirest.php';

$response = Unirest::get("https://indianapolis.bracketsforgood.org/?citimark-division");

//PIH
$res = explode('p2_entry_id":158,"p2_score":"', $response->body);
$res = explode('","', $res[1]);
$score['pih'] = number_format($res[0]);

//Other
$res = explode('p1_entry_id":154,"p1_score":"', $response->body);
$res = explode('","', $res[1]);
$score['other'] = number_format($res[0]);

print json_encode($score);

