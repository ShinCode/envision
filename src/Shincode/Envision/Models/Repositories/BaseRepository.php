<?php namespace Shincode\Envision\Models\Repositories;

class BaseRepository {

	/*
	| Store responses in a variable
	*/
	protected $cache = array();

	/*
	| Get all the results
	*/
	public function all() {

		return array(
			'id' => '1',
			'name' => 'foo',
			'lastname' => 'bar'
		);

	}
	
}