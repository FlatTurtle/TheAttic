<?php

header('Access-Control-Allow-Origin: *');

$url = $_GET['url'];

header('Content-Type: application/json');
$feed = new DOMDocument();
$feed->load($url);
$json = array();

$json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
$json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
$json['link'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('link')->item(0)->firstChild->nodeValue;

$items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item');

$json['entries'] = array();
$i = 0;


foreach($items as $item) {

   $title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
   $description = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
   $pubDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue;
   $guid = $item->getElementsByTagName('guid')->item(0)->firstChild->nodeValue;
 
   $json['entries'][$i]['title'] = $title;
   $json['entries'][$i]['summary'] = $description;
   $json['entries'][$i]['publishedDate'] = $pubDate;
   $json['entries'][$i]['source'] = $json['title']; //$guid;

   $i++;
}


echo json_encode($json);


?>

