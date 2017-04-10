<?php

include('chunkParseTree.php');

function chunkInput($input){
	$input = str_replace("\n", "", $input);
	$input = substr($input, 2);
	$input = substr($input, 0, -2);
	$input = str_replace("((", "( (", $input);
	$input = str_replace("((", "( (", $input);
	$input = str_replace("))", ") )", $input);
	$input = str_replace("))", ") )", $input);

	$tokens = explode(" ", $input);
	unset($rootNode);
	unset($currentNode);
	
	foreach($tokens as $token){
		if(strcmp(substr($token, 0, 1), "(") == 0){
			//got a new phrase, create a new leaf
			$tokenCategory = trim(substr($token, 1));
			if(!isset($rootNode)){
				$rootNode = new Node($tokenCategory);
				$currentNode = $rootNode;
				$currentNode->level = 0;
			}else{
				$newNode = new Node($tokenCategory);
				$newNode->setParent($currentNode);
				$newNode->level = $currentNode->level + 1;
				if(!$rootNode->hasChildren())
					$rootNode->addChild($newNode);
				else
					$currentNode->addChild($newNode);
				$currentNode = $newNode;
			}
		}elseif(strcmp(substr($token, -1, 1), ")") == 0){
			//phrase ended
			//if it was a word, add to the current leaf, else go to the parent
			$tokenWord = substr($token, 0, -1);
			if(strlen($tokenWord) > 0){
				$currentNode->setWord($tokenWord);
			}
			if($currentNode->getParent() != null)
				$currentNode = $currentNode->getParent();
		}
	}
	
	$wordCount = str_word_count($rootNode->traverse('inorder', ''));
	$chunkSize = ceil($wordCount/4);
	$finalChunks = array();
	$rootNode->getChunksToSize($rootNode, $chunkSize, $finalChunks);
	while(count($finalChunks) > 10){
		$finalChunks = array();
		$rootNode->clearInnerChunks($rootNode);
		$chunkSize = $chunkSize * 1.5;
		$rootNode->getChunksToSize($rootNode, $chunkSize, $finalChunks);
	}
	
	$finalChunks = array_reverse($finalChunks);
	
	$chunkString = "";
	foreach($finalChunks as $finalChunk){
		$chunkString .= $finalChunk."\n";
	}
	return $chunkString;
}

function chunkAfile($inputFileName, $outputFileName){
	$inputFile 	= fopen($inputFileName, "r") or die("Can't open input file!");
	$outputFile = fopen($outputFileName, "a") or die("Can't open output file!");
	// read the input file by line

	while (($input = fgets($inputFile)) !== false) {
		fwrite($outputFile, chunkInput($input));
		fwrite($outputFile, "\n");
	}
	fclose($inputFile);
	fclose($outputFile);
}












