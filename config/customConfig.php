<?php



return [
	//site setting
	'site'=>[
		'logo' 			 => env('SITE_LOGO','default-small.svg'),
		'name'			 => env('APP_NAME','Laravel'),
		'email' 		 => env('SITE_EMAIL','laravel.com'),
		'contact' 		 => env('SITE_CONTACT','example.com'),
		'address' 		 => env('SITE_ADDRESS','example'),
		'timezone'		=> env('SITE_TIMEZONE','UTC'),
	],

	'admin' => [
		'name'    		 => env('ADMIN_NAME','example'),
		'email'   		 => env('SITE_EMAIL','example'),
		'contact'        => env('ADMIN_CONTECT','example'),
	],

	'email'=>[
		'reply_to'  	 => env('MAIL_TO','example'),
		'header'    	 => env('MAIL_HEADER','example'),
		'footer'         => env('MAIL_FOOTER','example'),
		'signature'      => env('MAIL_SIGNATURE','example'),
	],
	'pages'=>[
		'about_us'  	 => env('ABOUT_US','example'),
		'blog'      	 => env('BLOG','example'),
		'privacy_policy' => env('PRIVACY_POLICY','example'),
		'terms' 		 => env('TERMS','example'),
	],
	'aws'=>[
		'key'   		 => env('AWS_ACCESS_KEY_ID','example'),
		'secret'		 => env('AWS_SECRET_ACCESS_KEY','example'),
		'region'		 => env('AWS_DEFAULT_REGION','example'),
		'buket' 		 => env('AWS_BUCKET','example'),
	],
	'social_links'=>[
		'instagram'		 =>env('INSTAGRAM','example'),
		'facebook'		 =>env('FACEBOOK','example'),
		'twitter'		 =>env('TWITTER','example'),
	],
	'environment'=>[
		'ip_address'	=>env('IP_ADDRESS', '127.0.0.1'),
		'production_mode'	=>env('PRODUCTION_MODE', '0'),
	],
	'maintance' => [
		'maintance_mode'	=>env('MAINTANCE_MODE', '1'),
	]

];
