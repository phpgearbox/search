<?php namespace Gears\Search;
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

use Closure;
use RuntimeException;
use Gears\Di\Container;
use Gears\Arrays as Arr;
use Gears\Search\TextProcessors\Processor;
use Gears\Search\TextProcessors\Tokenizer;
use Gears\Search\TextProcessors\StopWords;
use Gears\Search\TextProcessors\Stemmer;

class Index extends Container
{
	/**
	 * Property: schema
	 * =========================================================================
	 * Contains an array that describes how this index will look and behave.
	 * The array might look something like this:
	 * 
	 * ```php
	 * [
	 * 		['name' => 'id', 'type' => 'ref'],
	 * 		['name' => 'title', 'boost' => 10],
	 * 		['name' => 'body']
	 * ]
	 * ```
	 * 
	 * Each field can have a boost number accept for the reference field.
	 * All fields are assumed to have a boost of 1 and a type of "field"
	 * unless otherwise stated.
	 * 
	 * *NOTE: You can only have one ref field.*
	 * 
	 * We provide a default schema with the id field already set.
	 * And because we are in instance of ```Gears\Arrays\Fluent```
	 * we can do things like this:
	 * 
	 * ```php
	 * $index = new Index();
	 * $index->schema->push(['name' => 'foobar']);
	 * $index->schema->push(['name' => 'baz', 'boost' => 50]);
	 * ```
	 */
	protected $injectSchema;

	/**
	 * Property: pipeline
	 * =========================================================================
	 * Again this is just another array. It lists the "TextProcessors" in the
	 * order that they will be run against an incoming document field or query.
	 * 
	 * At it's simplest a "TextProcessor" is just a closure.
	 * 
	 * Or it must be an instance of class that extends:
	 * ```Gears\Search\TextProcessors\Processor```
	 * 
	 * Because this is an instance of ```Gears\Arrays\Fluent```.
	 * You can use all the collection methods on the pipeline like so:
	 * 
	 * ```php
	 * $index = new Index();
	 * $index->pipeline->prepend(function($value){ return 'new value'; });
	 * $index->pipeline->push(function($value){ return 'new value'; });
	 * ```
	 */
	protected $injectPipeline;

	// The following are the default text processors
	protected $injectTokenizer;
	protected $injectStopWords;
	protected $injectStemmer;

	/**
	 * Property: documents
	 * =========================================================================
	 * We store the indexed documents here. The array looks like:
	 * 
	 * ```php
	 * [
	 * 		'ref-value' =>
	 * 		[
	 * 			'term' => 'term-frequency'
	 * 		],
	 * ]
	 * ```
	 */
	protected $injectDocuments;

	/**
	 * Property: tokens
	 * =========================================================================
	 * We store a list of all unique tokens here. The array looks like:
	 * 
	 * ```php
	 * [
	 * 		'term' => 'document-frequency'
	 * ]
	 * ```
	 * 
	 * NOTE: _document-frequency_ is the number of documents
	 * 		that contain the term.
	 */
	protected $injectTokens;

	/**
	 * Method: setDefaults
	 * =========================================================================
	 * This is where we set all our defaults. If you need to customise this
	 * container this is a good place to look to see what can be configured
	 * and how to configure it.
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 * n/a
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * void
	 */
	protected function setDefaults()
	{
		$this->schema = function()
		{
			return Arr::a([['name' => 'id', 'type' => 'ref']]);
		};

		$this->pipeline = function()
		{
			return Arr::a
			([
				$this->tokenizer,
				$this->stopWords,
				$this->stemmer
			]);
		};

		$this->tokenizer = $this->factory(function()
		{
			return new Tokenizer();
		});

		$this->stopWords = $this->factory(function()
		{
			return new StopWords();
		});

		$this->stemmer = $this->factory(function()
		{
			return new Stemmer();
		});

		$this->documents = function()
		{
			return Arr::a([]);
		};

		$this->tokens = function()
		{
			return Arr::a([]);
		};
	}

	/**
	 * Method: add
	 * =========================================================================
	 * This is how we add a new document to the index.
	 * 
	 * In an effort to make the search method as fast as possible,
	 * we do as much calculating as possible. This makes the index slightly
	 * harder to debug as the term frequencies are not true frequencies
	 * amounst other issues.
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 *  - $doc: Expected to be a simple array.
	 * 			It must validate against the indexes schema.
	 * 
	 * Throws:
	 * -------------------------------------------------------------------------
	 *  - If the index already contains the document.
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * void
	 */
	public function add($doc)
	{
		$this->validateDocument($doc);

		if ($this->documents->has($doc[$this->getRefFieldKey()]))
		{
			throw new RuntimeException
			(
				'Document already exists in index, use update method!'
			);
		}

		// This is what we will add to the index
		// This represents the index for this document
		$document = Arr::a([]);

		// We use this for the document frequency counting
		$terms_added = Arr::a([]);

		// Loop through each field as defined by the schema
		foreach ($this->schema as $field)
		{
			// Ignore the ref field
			if ($field['name'] != $this->getRefFieldKey())
			{
				// Run the field through the pipline
				foreach ($this->runPipe($doc[$field['name']]) as $term => $tf)
				{
					// Does this field have any boosts?
					if (isset($field['boost']))
					{
						$boost = $field['boost'];
					}
					else
					{
						$boost = 0;
					}

					// Create a list of terms for the document
					// This sums the term frequency across fields
					// We also add any boosts to the term frequency
					if ($document->has($term))
					{
						$document[$term] = $document[$term] + $tf + $boost;
					}
					else
					{
						$document[$term] = $tf + $boost;
					}

					// Add the terms / tokens to our overall tokens list
					// This is where we get the "document-frequency" from.
					if ($this->tokens->has($term))
					{
						if (!$terms_added->contains($term))
						{
							$this->tokens[$term] = $this->tokens[$term] + 1;
							$terms_added->push($term);
						}
					}
					else
					{
						$this->tokens[$term] = 1;
						$terms_added->push($term);
					}
				}
			}
		}

		// Add the documents index to the list
		$this->documents->put($doc[$this->getRefFieldKey()], $document);
	}

	/**
	 * Method: update
	 * =========================================================================
	 * This just runs the delete method and then the add method.
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 *  - $doc: Expected to be a simple array.
	 * 			It must validate against the indexes schema.
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * void
	 */
	public function update($doc)
	{
		$this->validateDocument($doc);

		$this->delete($doc[$this->getRefFieldKey()]);

		$this->add($doc);
	}

	/**
	 * Method: delete
	 * =========================================================================
	 * Removes a document from the index.
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 *  - $ref: This is the value of the ref field.
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * void
	 */
	public function delete($ref)
	{
		$terms_to_delete = Arr::a([]);

		foreach ($this->documents[$ref] as $term => $tf)
		{
			if (!$terms_to_delete->contains($term))
			{
				$terms_to_delete->push($term);
			}
		}

		foreach ($this->tokens as $term => $df)
		{
			if ($terms_to_delete->contains($term))
			{
				if ($df == 1)
				{
					$this->tokens->forget($term);
				}
				else
				{
					$this->tokens[$term] = $this->tokens[$term] - 1;
				}
			}
		}

		$this->documents->forget($ref);
	}

	/**
	 * Method: search
	 * =========================================================================
	 * And finally the whole point of this project.
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 *  - $query: A string to search the index with.
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * array
	 */
	public function search($query, $offset = 0, $limit = null)
	{
		// This is what we will return
		$matches = Arr::a([]);

		// Run the query through the same pipeline
		// that every document got processed through.
		$query = $this->runPipe($query);

		// Lets check to see if we have any matches at all.
		if (count(array_intersect($this->tokens->keys(), array_keys($query))) == 0)
		{
			return $matches;
		}

		// Loop through each search term
		foreach ($query as $search_term => $search_term_freq)
		{
			foreach ($this->documents as $ref => $terms)
			{
				// Check to see if this document has any matches
				if ($terms->has($search_term))
				{
					$tf_idf = $this->calcTfIdf($search_term, $terms);

					if ($matches->has($ref))
					{
						$matches[$ref] = $matches[$ref] + $tf_idf;
					}
					else
					{
						$matches[$ref] = $tf_idf;
					}
				}
			}
		}

		// Now normalise the scores for length
		foreach($matches as $ref => $score)
		{
			$matches[$ref] =
				$score /
				$this->documents[$ref]->sum(function($v){ return $v; })
			;
		}

		// Sort the matches (highest to lowest)
		$matches->sortByDesc(function($v){ return $v; });

		// Limit the result set
		$matches = $matches->slice($offset, $limit, true);

		return $matches;
	}

	/**
	 * Method: calcTfIdf
	 * =========================================================================
	 * This is how we rank the results. Its some complicated mathametics that
	 * my poor head still struggles to full understand.
	 * 
	 * For more info see:
	 * 	- http://en.wikipedia.org/wiki/Tf%E2%80%93idf
	 * 	- http://phpir.com/simple-search-the-vector-space-model/
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 *  - $search_term: The term to calculate the td-idf for.
	 * 	- $documents_terms: The current documents terms array.
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * float
	 */
	private function calcTfIdf($search_term, $documents_terms)
	{
		$term_frequency = $documents_terms[$search_term];

		$total_document_count = $this->documents->count() + 1;

		$documents_with_term = $this->tokens[$search_term] + 1;

		$idf = $total_document_count / $documents_with_term;

		return $term_frequency * (1 + log($idf, 2));
	}

	/**
	 * Method: validateDocument
	 * =========================================================================
	 * Each document thats gets added to the index must pass this validation.
	 * Basically we just check to make sure the array contains the correct keys
	 * as per the schema.
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 *  - $doc: An array representing the document to check.
	 * 
	 * Throws:
	 * -------------------------------------------------------------------------
	 * 	- If the provided doc array does not have a field defined in the schema.
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * void
	 */
	private function validateDocument($doc)
	{
		foreach ($this->schema as $field)
		{
			if (!isset($doc[$field['name']]))
			{
				throw new RuntimeException
				(
					'Document does not match index schema!'
				);
			}
		}
	}

	/**
	 * Method: getRefFieldKey
	 * =========================================================================
	 * Returns the name of the field that is our reference field,
	 * as per the set schema.
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 * n/a
	 * 
	 * Throws:
	 * -------------------------------------------------------------------------
	 * 	- If the schema does not contain a field with it's type set to "ref".
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * string
	 */
	private function getRefFieldKey()
	{
		if (!empty($this->refFieldKey)) return $this->refFieldKey;

		foreach ($this->schema as $field)
		{
			if (isset($field['type']) && $field['type'] == 'ref')
			{
				$this->refFieldKey = $field['name'];
				return $this->refFieldKey;
			}
		}

		throw new RuntimeException('Schema Invalid, no ref field!');
	}

	// I added this in to save a few CPU cycles.
	private $refFieldKey = null;

	/**
	 * Method: runPipe
	 * =========================================================================
	 * This runs a string through the text processing
	 * pipeline and returns a list of tokens.
	 * 
	 * Basically it loops through the each of the processors passing the output
	 * from the last processor to the input of the next. The initial input will
	 * always be a string, the [Method: add](#) ensures this however it is
	 * possible this gets converted to an array or other types as it passes
	 * through the pipeline.
	 * 
	 * _ie: when it gets passed through the Tokenizer_
	 * 
	 * So some common sense needs to be applied if you wish
	 * to make your own or modify the existing pipeline.
	 * 
	 * Parameters:
	 * -------------------------------------------------------------------------
	 *  - $input: A string to extract token from.
	 * 
	 * Throws:
	 * -------------------------------------------------------------------------
	 * 	- If we find a processor that we don't know how to run.
	 * 
	 * Returns:
	 * -------------------------------------------------------------------------
	 * array
	 */
	private function runPipe($input)
	{
		foreach ($this->pipeline as $processor)
		{
			if (is_object($processor) && $processor instanceof Processor)
			{
				$input = $processor->process($input);
			}
			elseif (is_object($processor) && $processor instanceof Closure)
			{
				$input = call_user_func($processor, $input);
			}
			else
			{
				throw new RuntimeException('Processor not supported!');
			}
		}

		// Now count the term frequency
		return array_count_values($input);
	}
}