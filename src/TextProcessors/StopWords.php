<?php namespace Gears\Search\TextProcessors;
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

use Gears\Search\TextProcessors\Processor;

class StopWords implements Processor
{
	// This list came from: http://git.io/T37UJA
	private $words =
	[
		'', 'a', 'able', 'about', 'across', 'after', 'all', 'almost', 'also',
		'am', 'among', 'an', 'and', 'any', 'are', 'as', 'at', 'be', 'because',
		'been', 'but', 'by', 'can', 'cannot', 'could', 'dear', 'did', 'do',
		'does', 'either', 'else', 'ever', 'every', 'for', 'from', 'get', 'got',
		'had', 'has', 'have', 'he', 'her', 'hers', 'him', 'his', 'how',
		'however', 'i', 'if', 'in', 'into', 'is', 'it', 'its', 'just', 'least',
		'let', 'like', 'likely', 'may', 'me', 'might', 'most', 'must', 'my',
		'neither', 'no', 'nor', 'not', 'of', 'off', 'often', 'on', 'only', 'or',
		'other', 'our', 'own', 'rather', 'said', 'say', 'says', 'she', 'should',
		'since', 'so', 'some', 'than', 'that', 'the', 'their', 'them', 'then',
		'there', 'these', 'they', 'this', 'tis', 'to', 'too', 'twas', 'us',
		'wants', 'was', 'we', 'were', 'what', 'when', 'where', 'which', 'while',
		'who', 'whom', 'why', 'will', 'with', 'would', 'yet', 'you', 'your'
	];

	public function process($input)
	{
		return array_filter($input, function($token)
		{
			if (in_array($token, $this->words))
			{
				return false;
			}
			else
			{
				return true;
			}
		});
	}
}