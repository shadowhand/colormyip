<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Color extends Controller {

	public $view;

	public function action_index()
	{
		$this->view = View::factory('color')
			->bind('colors', $colors)
			->bind('ip', $ip)
			;

		// IP address specified?
		$ip = Arr::get($_GET, 'ip');

		if ( ! Valid::ip($ip))
		{
			// Use the client IP address
			$ip = Request::$client_ip;
		}

		if (strpos($ip, ':') !== FALSE)
		{
			// Normalize IPv6 addresses
			$ip = $this->normalize_ipv6($ip);
		}

		// Hash the ip address
		$hash = hash('sha512', $ip);

		if ($tail = (strlen($hash) % 6))
		{
			// Remove the tail
			$hash = substr($hash, 0, -$tail);
		}

		// Split the hash into 6-character groups
		$colors = str_split($hash, 6);
	}

	public function after()
	{
		// Load response body
		$this->response->body($this->view);

		return parent::after();
	}

	/**
	 * Normalizes an IPv6 address to long notation.
	 *
	 * Examples:
	 *  -- ::1
	 *  -> 0000:0000:0000:0000:0000:0000:0000:0001
	 *  -- 2001:db8:85a3::8a2e:370:7334
	 *  -> 2001:0db8:85a3:0000:0000:8a2e:0370:7334
	 *
	 * [!!] http://svn.kd2.org/svn/misc/libs/tools/ip_utils.php
	 *
	 * @param string $ip Input IPv6 address
	 * @return string IPv6 address
	 */
	protected function normalize_ipv6($ip)
	{
		if (strpos($ip, '::') !== false)
		{
			$ip = str_replace('::', str_repeat(':0', 8 - substr_count($ip, ':')).':', $ip);
		}

		if ($ip[0] == ':')
		{
			$ip = '0' . $ip;
		}

		$ip = explode(':', $ip);

		foreach ($ip as &$part)
		{
			$part = str_pad($part, 4, '0', STR_PAD_LEFT);
		}

		return implode(':', $ip);
	}

} // End Color
