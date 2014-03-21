<?php


updateScore(0);
updateScore(10);
updateScore(20);
updateScore(30);
updateScore(40);
updateScore(50);


function updateScore($sleep) {

  sleep($sleep);
  
  require_once dirname(__FILE__) . '/unirest-php/lib/Unirest.php';

  $file = dirname(__FILE__) . '/score.json';
  
  $response = Unirest::get("https://indianapolis.bracketsforgood.org/?citimark-division");
  
  //PIH
  $res = explode('p2_entry_id":158,"p2_score":"', $response->body);
  $res = explode('","', $res[1]);
  $score['pih'] = number_format($res[0]);
  
  //Other
  $res = explode('p1_entry_id":154,"p1_score":"', $response->body);
  $res = explode('","', $res[1]);
  $score['other'] = number_format($res[0]);
    
  file_put_contents($file, json_encode($score));
  
  print ".";
}
