<?php

require 'vendor/autoload.php';

use Elastic\Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();



header("Location: pages/dashboard.php");