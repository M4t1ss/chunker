<?php
include 'chunk.php';

$opts 		= getopt("m:g:s:");
$minSize 	= isset($opts["m"])?$opts["m"]:null;
$grammar 	= isset($opts["g"])?$opts["g"]:die("Missing grammar parameter '-g'\n");
$sentence 	= isset($opts["s"])?$opts["s"]:die("Missing input sentence parameter '-s'\n");

//Parse the input sentence
$parsed = shell_exec('echo "'.$sentence.'" | java -Xmx1024m -jar included/BerkeleyParser.jar -gr '.$grammar);

//Chunk and print output
echo chunkInput($parsed, $minSize);
