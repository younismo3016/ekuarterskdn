<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [

	
		'filteradmin' => \App\Filters\FilterAdmin::class,
		'filteruser' => \App\Filters\FilterUser::class,
		'filterpelanggan' => \App\Filters\FilterPelanggan::class,
		// 'filterpemohon' => \App\Filters\FilterPemohon::class,
		'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			'filteradmin' => ['except' => [
				'auth', 'auth/*',
				'web', 'web/*',
				'/',
				
			]],
			'filteruser' => ['except' => [
				'auth', 'auth/*',
				'web', 'web/*',
				'/',
				
			]],
			// 'filterpemohon' => ['except' => [
			// 	'auth', 'auth/*',
			// 	'web', 'web/*',
			// 	'/',
				
			// ]],
			'filterpelanggan' => ['except' => [
				'auth', 'auth/*',
				'web', 'web/*',
				'/',
				
			]]
			// 'honeypot',
			// 'honeypot',
			// 'csrf',
		],
		'after'  => [
			'filteradmin' => ['except' => [
				'home', 'home/*',
				'admin', 'admin/*',
				'AjaxServer', 'AjaxServer/*',
				
			]],
			'filteruser' => ['except' => [
				'home', 'home/*',
				'user', 'user/*',
				
			]],
			// 'filterpemohon' => ['except' => [
			// 	'home', 'home/*',
			// 	'user', 'user/*',
				
			// ]],
			'filterpelanggan' => ['except' => [
				'home', 'home/*',
				'user', 'user/*',
				
			]],
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
