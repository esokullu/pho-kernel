<?php

// Please note this file is not functional yet, 
// and it isfor instructional purposes only

require "vendor/autoload.php";

spl_autoload_register(function ($class_name) {
  if(strpos($class_name,"PhoNetworksAutogenerated\\")!==0)
    return;
  $class_name = str_replace("\\", "/", substr($class_name, strlen("PhoNetworksAutogenerated\\")));
  $class_file = __DIR__."/.compiled/".$class_name.".php";
  if(file_exists($class_file))
    include($class_file);
});

use Pho\Kernel\Kernel;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$configs = array(
  "services"=>array(
   		"database" => ["type" => getenv('DATABASE_TYPE'), "uri" => getenv('DATABASE_URI')],
      "storage" => ["type" => getenv('STORAGE_TYPE'), "uri" =>  getenv("STORAGE_URI")],
      "index" => ["type" => getenv('INDEX_TYPE'), "uri" => getenv('INDEX_URI')]
  )
);

// EDIT ME!
// This is where you set up what your default graph, actor and founder objects are:
// $configs["default_objects"]["graph"] =  \PhoNetworksAutogenerated\Graph::class;
// $configs["default_objects"]["founder"] =  \PhoNetworksAutogenerated\User::class
// $configs["default_objects"]["actor"] =  \PhoNetworksAutogenerated\User::class


$kernel = new \Pho\Kernel\Kernel($configs);

// EDIT ME!
// If you have a custom user object, this is where you set up the founder.
// $founder = new \PhoNetworksAutogenerated\User($kernel, $kernel->space(), "123456");

if(isset($founder))
  $kernel->boot($founder);
else
  $kernel->boot();
  
// The kernel is booted up and it is ready to play with.
