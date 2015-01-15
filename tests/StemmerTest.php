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

use Gears\Search\TextProcessors\Stemmer;

class StemmerTest extends PHPUnit_Framework_TestCase
{
	public function testStemmer()
	{
		$stemmer = new Stemmer();

		$words = file(__DIR__.'/data/words.txt');
		foreach ($words as $key => $word) $words[$key] = trim($word);

		$stems = file(__DIR__.'/data/stems.txt');
		foreach ($stems as $key => $stem) $stems[$key] = trim($stem);

		$this->assertEquals($stemmer->process($words), $stems);
	}
}