<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifController extends Controller
{
	public function test()
	{
		$data = [
			'phone' => '6282131188759',
			'body' => 'Hello, Dea!', 
		];
		$json = json_encode($data); 

		$url = 'https://eu112.chat-api.com/instance117791/sendMessage?token='.env('CHAT_API_TOKEN');

		$options = stream_context_create(['http' => ['method'  => 'POST',
			'header'  => 'Content-type: application/json',
			'content' => $json ]
		]);

		$result = file_get_contents($url, false, $options);
		return $result;
	}
}
