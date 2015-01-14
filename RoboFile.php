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

/*
 * Include our local composer autoloader just in case
 * we are called with a globally installed version of robo.
 */
require_once(__DIR__.'/vendor/autoload.php');

class RoboFile extends Robo\Tasks
{
	/**
	 * Method: test
	 * =========================================================================
	 * This will run our unit / acceptance testing. All the *gears* within
	 * the **PhpGearBox** utlise PhpUnit as the basis for our testing with the
	 * addition of the built in PHP Web Server, making the acceptance tests
	 * almost as portable as standard unit tests.
	 *
	 * Just run: ```php ./vendor/bin/robo test```
	 *
	 * Parameters:
	 * -------------------------------------------------------------------------
	 * n/a
	 *
	 * Returns:
	 * -------------------------------------------------------------------------
	 * void
	 */
	public function test()
	{
		$this->taskPHPUnit()->arg('./tests')->run();
	}

	public function example()
	{
		$index = new Gears\Search\Index();
		$index->schema->push(['name' => 'title', 'boost' => 10]);
		$index->schema->push(['name' => 'body']);

		$index->add
		([
			'id' => 1,
			'title' => 'Foo',
			'body' => 'Foo foo   <br /> <b<dsfhgfdsG>>sdkjhfsdkg</b>  '."\n\n".' foo!'
		]);

		$index->add
		([
			'id' => 2,
			'title' => 'Bar',
			'body' => 'Bar bar bar ho hum! really real go going some something cook cooking purposeful foo Bar bar bar ho hum! really real go going some something cook cooking purposeful foo'
		]);
		
		print_r($index->search('how to cook real bar pie while cooking banna foo'));
	}

}