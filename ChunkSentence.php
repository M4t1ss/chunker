<?php
include 'chunk.php';

$opts = getopt("m:s:g:");
$minSize = $opts["m"];
$sentence = $opts["s"];
$grammar = $opts["g"];

//Parse the input sentence
$parsed = shell_exec('echo "'.$sentence.'" | java -Xmx1024m -jar included/BerkeleyParser.jar -gr '.$grammar);

//Chunk and print output
echo chunkInput($parsed, $minSize);
