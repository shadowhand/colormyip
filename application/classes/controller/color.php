<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Color extends Controller {

	public function action_index()
	{
		$view = View::factory('color')
			->bind('colors', $colors)
			->bind('ip', $ip)
			;

		// Get the client ip address
		$ip = Request::$client_ip;

		// Hash the ip address
		$hash = hash('sha512', $ip);

		if ($tail = (strlen($hash) % 6))
		{
			// Remove the tail
			$hash = substr($hash, 0, -$tail);
		}

		// Split the hash into 6-character groups
		$colors = str_split($hash, 6);

		$this->response->body($view);
	}

} // End Color
