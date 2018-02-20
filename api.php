<?php

header("Content-Type: application/json");

if(!isset($_GET['domain'])){
	echo json_encode(["Bitte Domain übergeben"]);
	exit;
}

$domain = $_GET['domain'];

$results = dns_get_record("_minecraft._tcp." . $domain, DNS_SRV);

$retVals = [];

if(count($results) == 0) {
	echo json_encode(["Keine Addresse zum Joinen verfügbar"]);
	exit;
}

foreach($results as $result) {
	$retVals[] = $result["target"] . ":" . $result["port"];
}

echo json_encode($retVals);
