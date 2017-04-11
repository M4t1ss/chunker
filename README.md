Chunker
===================================
This is a sentence chunker PHP class + visualizer

It includes the Berkeley Parser and an English grammar from https://github.com/slavpetrov/berkeleyparser

You can try it out here - http://lielakeda.lv/other/chunker/

Example input for visualizing with _testChunker.php_:

	( (S (NP (NP (VBG Shifting) (NNS goods)) (CC and) (NP (NP (NNS passengers)) (PP (PP (IN from) (NP (NNS roads))) (PP (TO to) (NP (NP (ADJP (RBR less) (JJ polluting)) (NNS forms)) (PP (IN of) (NP (NN transport)))))))) (VP (MD will) (VP (VB be) (NP (NP (DT a) (JJ key) (NN factor)) (PP (IN in) (NP (DT any) (JJ sustainable) (NN transport) (NN policy.))))))) )

	
Options for _ChunkSentence.php_:

| Option | Description                          | Required |
| ------ |:------------------------------------:| --------:|
| -m     | minimal desired length of each chunk | no       |
| -g     | grammar file for Berkeley Parser     | yes      |
| -s     | input sentence                       | yes      |
	
An example for just get chunks from an English sentence with _ChunkSentence.php_:

```shell
php ChunkSentence.php -m 10 -g included/eng_sm6.gr -s "Recent works have proved that synthetic parallel data generated by existing translation models can be an effective solution to various neural machine translation (NMT) issues."
```	

![N|Solid](https://github.com/M4t1ss/chunker/blob/master/included/chunking.png?raw=true)