<?php
////////////////////////////////////////////////////////////////////////////////
// __________ __             ________                   __________              
// \______   \  |__ ______  /  _____/  ____ _____ ______\______   \ _______  ___
//  |     ___/  |  \\____ \/   \  ____/ __ \\__  \\_  __ \    |  _//  _ \  \/  /
//  |    |   |   Y  \  |_> >    \_\  \  ___/ / __ \|  | \/    |   (  <_> >    < 
//  |____|   |___|  /   __/ \______  /\___  >____  /__|  |______  /\____/__/\_ \
//                \/|__|           \/     \/     \/             \/            \/
// -----------------------------------------------------------------------------
//          Designed and Developed by Brad Jones <brad @="bjc.id.au" />         
// -----------------------------------------------------------------------------
////////////////////////////////////////////////////////////////////////////////

use Gears\Search\Index;

class IndexTest extends PHPUnit_Framework_TestCase
{
	public function testValidateDocument()
	{
		$index = new Index();

		$index->schema->push(['name' => 'body']);

		try
		{
			$index->add(['id' => 'test-id', 'content' => 'Foo Bar']);
		}
		catch (RuntimeException $e)
		{
			return;
		}

		$this->fail('Document validation failed!');
	}

	public function testAdd()
	{
		$index = new Index();

		$index->schema->push(['name' => 'body']);

		$index->add
		([
			'id' => 'test-id',
			'body' => 'Wolf jean shorts kogi pour-over.'
		]);

		$this->assertTrue($index->documents->has('test-id'));

		$this->assertEquals
		(
			$index->documents->get('test-id')->toArray(),
			[
				'wolf' => 1,
				'jean' => 1,
				'short' => 1,
				'kogi' => 1,
				'pourov' => 1
			]
		);
	}

	public function testDelete()
	{
		$index = new Index();

		$index->schema->push(['name' => 'body']);

		$index->add
		([
			'id' => 'test-id',
			'body' => 'Wolf jean shorts kogi pour-over.'
		]);

		$index->delete('test-id');

		$this->assertFalse($index->documents->has('test-id'));
	}

	public function testUpdate()
	{
		$index = new Index();

		$index->schema->push(['name' => 'body']);

		$index->add
		([
			'id' => 'test-id',
			'body' => 'Wolf jean shorts kogi pour-over.'
		]);

		$index->update
		([
			'id' => 'test-id',
			'body' => 'Fixie messenger bag Brooklyn, fashion axe.'
		]);

		$this->assertTrue($index->documents->has('test-id'));

		$this->assertEquals
		(
			$index->documents->get('test-id')->toArray(),
			[
				'fixi' => 1,
				'messeng' => 1,
				'bag' => 1,
				'brooklyn' => 1,
				'fashion' => 1,
				'ax' => 1
			]
		);
	}

	public function testSearch()
	{
		$index = new Index();

		$index->schema->push(['name' => 'title', 'boost' => 10]);
		$index->schema->push(['name' => 'body']);

		$index->add
		([
			'id' => 1,
			'title' => 'Foo',
			'body' => 'Wolf foo jean foo shorts foo kogi pour-over bar.'
		]);

		$index->add
		([
			'id' => 2,
			'title' => 'Bar',
			'body' => 'Fixie bar messenger bar bag Brooklyn, fashion axe foo.'
		]);

		$this->assertEquals($index->search('foo')->keys(), [1, 2]);
		$this->assertEquals($index->search('bar')->keys(), [2, 1]);
		$this->assertEquals($index->search('wolf')->keys(), [1]);
		$this->assertEquals($index->search('fixie')->keys(), [2]);
	}

	public function testSave()
	{
		$index = new Index();

		$index->schema->push(['name' => 'title', 'boost' => 10]);
		$index->schema->push(['name' => 'body']);

		$index->add
		([
			'id' => 1,
			'title' => 'Foo',
			'body' => 'Wolf foo jean foo shorts foo kogi pour-over bar.'
		]);

		$index->add
		([
			'id' => 2,
			'title' => 'Bar',
			'body' => 'Fixie bar messenger bar bag Brooklyn, fashion axe foo.'
		]);

		$export = $index->save();

		$this->assertEquals($export,
		[
			'schema' => 
			[
				0 => 
				[
					'name' => 'id',
					'type' => 'ref'
				],
				1 => 
				[
					'name' => 'title',
					'boost' => 10
				],
				2 => 
				[
					'name' => 'body'
				]
			],
			'documents' => 
			[
				1 => 
				[
					'foo' => 14,
					'wolf' => 1,
					'jean' => 1,
					'short' => 1,
					'kogi' => 1,
					'pourov' => 1,
					'bar' => 1
				],
				2 => 
				[
					'bar' => 13,
					'fixi' => 1,
					'messeng' => 1,
					'bag' => 1,
					'brooklyn' => 1,
					'fashion' => 1,
					'ax' => 1,
					'foo' => 1
				]
			],
			'tokens' => 
			[
				'foo' => 2,
				'wolf' => 1,
				'jean' => 1,
				'short' => 1,
				'kogi' => 1,
				'pourov' => 1,
				'bar' => 2,
				'fixi' => 1,
				'messeng' => 1,
				'bag' => 1,
				'brooklyn' => 1,
				'fashion' => 1,
				'ax' => 1,
			],
			'pipeline' => 
			[
				0 => 'O:37:"Gears\\Search\\TextProcessors\\Tokenizer":0:{}',
				1 => 'O:37:"Gears\\Search\\TextProcessors\\StopWords":1:{s:44:"'."\0".'Gears\\Search\\TextProcessors\\StopWords'."\0".'words";a:120:{i:0;s:0:"";i:1;s:1:"a";i:2;s:4:"able";i:3;s:5:"about";i:4;s:6:"across";i:5;s:5:"after";i:6;s:3:"all";i:7;s:6:"almost";i:8;s:4:"also";i:9;s:2:"am";i:10;s:5:"among";i:11;s:2:"an";i:12;s:3:"and";i:13;s:3:"any";i:14;s:3:"are";i:15;s:2:"as";i:16;s:2:"at";i:17;s:2:"be";i:18;s:7:"because";i:19;s:4:"been";i:20;s:3:"but";i:21;s:2:"by";i:22;s:3:"can";i:23;s:6:"cannot";i:24;s:5:"could";i:25;s:4:"dear";i:26;s:3:"did";i:27;s:2:"do";i:28;s:4:"does";i:29;s:6:"either";i:30;s:4:"else";i:31;s:4:"ever";i:32;s:5:"every";i:33;s:3:"for";i:34;s:4:"from";i:35;s:3:"get";i:36;s:3:"got";i:37;s:3:"had";i:38;s:3:"has";i:39;s:4:"have";i:40;s:2:"he";i:41;s:3:"her";i:42;s:4:"hers";i:43;s:3:"him";i:44;s:3:"his";i:45;s:3:"how";i:46;s:7:"however";i:47;s:1:"i";i:48;s:2:"if";i:49;s:2:"in";i:50;s:4:"into";i:51;s:2:"is";i:52;s:2:"it";i:53;s:3:"its";i:54;s:4:"just";i:55;s:5:"least";i:56;s:3:"let";i:57;s:4:"like";i:58;s:6:"likely";i:59;s:3:"may";i:60;s:2:"me";i:61;s:5:"might";i:62;s:4:"most";i:63;s:4:"must";i:64;s:2:"my";i:65;s:7:"neither";i:66;s:2:"no";i:67;s:3:"nor";i:68;s:3:"not";i:69;s:2:"of";i:70;s:3:"off";i:71;s:5:"often";i:72;s:2:"on";i:73;s:4:"only";i:74;s:2:"or";i:75;s:5:"other";i:76;s:3:"our";i:77;s:3:"own";i:78;s:6:"rather";i:79;s:4:"said";i:80;s:3:"say";i:81;s:4:"says";i:82;s:3:"she";i:83;s:6:"should";i:84;s:5:"since";i:85;s:2:"so";i:86;s:4:"some";i:87;s:4:"than";i:88;s:4:"that";i:89;s:3:"the";i:90;s:5:"their";i:91;s:4:"them";i:92;s:4:"then";i:93;s:5:"there";i:94;s:5:"these";i:95;s:4:"they";i:96;s:4:"this";i:97;s:3:"tis";i:98;s:2:"to";i:99;s:3:"too";i:100;s:4:"twas";i:101;s:2:"us";i:102;s:5:"wants";i:103;s:3:"was";i:104;s:2:"we";i:105;s:4:"were";i:106;s:4:"what";i:107;s:4:"when";i:108;s:5:"where";i:109;s:5:"which";i:110;s:5:"while";i:111;s:3:"who";i:112;s:4:"whom";i:113;s:3:"why";i:114;s:4:"will";i:115;s:4:"with";i:116;s:5:"would";i:117;s:3:"yet";i:118;s:3:"you";i:119;s:4:"your";}}',
				2 => 'O:35:"Gears\\Search\\TextProcessors\\Stemmer":0:{}'
			]
		]);
		
		$index2 = new Index($export);

		$this->assertEquals($index2->search('foo')->keys(), [1, 2]);
		$this->assertEquals($index2->search('bar')->keys(), [2, 1]);
		$this->assertEquals($index2->search('wolf')->keys(), [1]);
		$this->assertEquals($index2->search('fixie')->keys(), [2]);
	}
}