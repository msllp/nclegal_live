<?php

namespace MS\Core\Helper;



Class Notify{




	public static $channels=[
	'admin'=>[
				'app_name'=>'ncc-admin-development',
				'app_id'=>'594535',
				'key'=>'7024edd71fa0cc81b030',
				'secret'=>'278eda560885ec86d5f1',
				'cluster'=>'ap2',

				],

	'agency'=>[
				'app_name'=>'ncc-agency-development',
				'app_id'=>'603283',
				'key'=>'5c61357a2f0f57a5f3be',
				'secret'=>'ed9dacab4a32baae8ed7',
				'cluster'=>'ap2',

				],



	];


	public static function send($channel,$event,$data){




			if(array_key_exists($channel, self::$channels)){
				$channels=self::$channels;
				$options = [
							'cluster' => $channels[$channel]['cluster'],
							'useTLS' => true
										];
				
					
					$p=new \Pusher(
						$channels[$channel]['key'],
			   			$channels[$channel]['secret'],
			    		$channels[$channel]['app_id'],
			    		$options
			    		);
			
				$p->trigger($channels[$channel]['app_name'], $event, (array)$data);
					//dd($p->trigger($channels[$channel]['app_name'], $event, (array)$data));
			}


	}
}