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
		// First remove all un-needed whitespace
		$input = preg_replace('/\s+/', ' ', $input);

		// Make everything lowercase
		$input = strtolower($input);

		// Remove any html tags
		$input = strip_tags($input);

		// Remove any remaining special characters, we want english words only.
		$input = preg_replace('/[^A-Za-z0-9\-\s]/', '', $input);

		// Return an array of words
		return explode(' ', $input);
	}
}