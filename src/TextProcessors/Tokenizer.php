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

class Tokenizer implements Processor
{
	public function process($input)
	{
		// Make everything lowercase
		$input = strtolower($input);

		// Strip tags isn't smart enough to remove script blocks
		$input = preg_replace('#<script(.*?)>(.*?)</script>#is', ' ', $input);

		// Remove all other html tags
		$input = strip_tags($input);

		// Decode HTML entities
		$input = html_entity_decode($input);

		// Remove all un-needed whitespace
		$input = preg_replace('/\s+/', ' ', $input);

		// Remove any remaining special characters.
		// This is so that in both the following examples:
		// "Hello Bob." and "Hello Bob!" we still only get
		// 2 tokens "hello" and "bob" not "hello", "bob." & "bob!"
		$input = preg_replace('/[^A-Za-z0-9\s]/', '', $input);

		// Return an array of words
		return explode(' ', $input);
	}
}