<?php
Route::get('/', function () {
	return view('welcome');
});
$prefixAdmin = Config::get('zvn.url.prefix_admin' );	 //admin
$prefixNews = Config::get('zvn.url.prefix_news' );	 //admin
Route::group(['prefix' => $prefixAdmin,'namespace'=>'admin','middleware'=>['permission.admin']], function()  {
		//============SLIDER=================
	$prefix = 'slider';
	$controllerName = 'slider';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',				['as'             =>$controllerName, 			'uses' =>$controller.'index']);
		Route::get('form/{id?}',	['as'             =>$controllerName.'/form', 	'uses' => $controller.'form' ])->where('id','[0-9]+');
		Route::get('delete/{id}',	['as'             =>$controllerName.'/delete', 	'uses' => $controller.'delete' ])->where('id','[0-9]+');
		Route::post('save',			['as'             =>$controllerName.'/save', 	'uses' => $controller.'save' ]);
		Route::get('change-status-{status}/{id}',['as' =>$controllerName.'/status',	'uses'=> $controller.'status' ])->where('id','[0-9]+');
	});
			//============categry=================
	$prefix = 'category';
	$controllerName = 'category';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',				['as'             =>$controllerName, 			'uses' =>$controller.'index']);
		Route::get('form/{id?}',	['as'             =>$controllerName.'/form', 	'uses' => $controller.'form' ])->where('id','[0-9]+');
		Route::get('delete/{id}',	['as'             =>$controllerName.'/delete', 	'uses' => $controller.'delete' ])->where('id','[0-9]+');
		Route::post('save',			['as'             =>$controllerName.'/save', 	'uses' => $controller.'save' ]);
		Route::get('change-status-{status}/{id}',['as' =>$controllerName.'/status',	'uses'=> $controller.'status' ])->where('id','[0-9]+');
		Route::get('change-is_home-{is_home}/{id}',['as' =>$controllerName.'/is_home',	'uses'=> $controller.'is_home' ])->where('id','[0-9]+');
		Route::get('change-display-{display}/{id?}',['as' =>$controllerName.'/display',	'uses'=> $controller.'display' ])->where('id','[0-9]+');
	});
		//============article=================
	$prefix = 'article';
	$controllerName = 'article';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',				['as'                 =>$controllerName, 			'uses' =>$controller.'index']);
		Route::get('form/{id?}',	['as'                 =>$controllerName.'/form', 	'uses' => $controller.'form' ])->where('id','[0-9]+');
		Route::get('delete/{id}',	['as'                 =>$controllerName.'/delete', 	'uses' => $controller.'delete' ])->where('id','[0-9]+');
		Route::post('save',			['as'                 =>$controllerName.'/save', 	'uses' => $controller.'save' ]);
		Route::get('change-status-{status}/{id}',['as'    =>$controllerName.'/status',	'uses'=> $controller.'status' ])->where('id','[0-9]+');
		Route::get('change-is_home-{is_home}/{id}',['as'  =>$controllerName.'/is_home',	'uses'=> $controller.'is_home' ])->where('id','[0-9]+');
		Route::get('change-display-{display}/{id?}',['as' =>$controllerName.'/display',	'uses'=> $controller.'display' ])->where('id','[0-9]+');
		Route::get('change-type-{type}/{id?}',['as'       =>$controllerName.'/type',	'uses'=> $controller.'type' ])->where('id','[0-9]+');
	});
			//============user=================

	$prefix = 'user';
	$controllerName = 'user';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',				['as'              =>$controllerName, 			'uses' =>$controller.'index']);
		Route::get('form/{id?}',	['as'              =>$controllerName.'/form', 	'uses' => $controller.'form' ])->where('id','[0-9]+');
		Route::get('delete/{id}',	['as'              =>$controllerName.'/delete', 	'uses' => $controller.'delete' ])->where('id','[0-9]+');
		Route::post('change-password',	['as'          =>$controllerName.'/change-password', 'uses' => $controller.'changePassword' ]);
		Route::post('change-level',	['as'          =>$controllerName.'/change-level', 'uses' => $controller.'changeLevel' ]);
		Route::post('save',			['as'              =>$controllerName.'/save', 	'uses' => $controller.'save' ]);
		Route::get('change-status-{status}/{id}',['as' =>$controllerName.'/status',	'uses'=> $controller.'status' ])->where('id','[0-9]+');
		Route::get('change-level-{level}/{id?}',['as'  =>$controllerName.'/level',	'uses'=> $controller.'level' ]);
	});

		//============DASHBOARD=================
	$prefix = 'dashboard';
	$controllerName = 'dashboard';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',['as'=>$controllerName, 'uses'=>$controller.'index']);
	});
});
// -----prefixNews-----
Route::group(['prefix' => $prefixNews,'namespace'=>'News'], function()  {
		//============HOMEPAGE=================

	$prefix = '';
	$controllerName = 'home';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/',['as'=>$controllerName, 'uses'=>$controller.'index'	]);
	});
		//============category=================

	$prefix         = 'chuyen-muc';
	$controllerName = 'category';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/{category_name}-{category_id}.php',['as'=>$controllerName.'/index', 'uses'=>$controller.'index'])
		->where('category_name','[0-9a-zA-Z_-]+')
		->where('category_id','[0-9]+');
	});
		//============article=================

	$prefix         = 'bai-viet';
	$controllerName = 'article';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
		Route::get('/{article_name}-{article_id}.php',['as'=>$controllerName.'/index', 'uses'=>$controller.'index'])
		->where('article_name','[0-9a-zA-Z_-]+')
		->where('article_id','[0-9]+');
	});

    // ============================== NOTIFY ==============================
    $prefix         = '';
    $controllerName = 'notify';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/no-permission',                             [ 'as' => $controllerName . '/noPermission',                  'uses' => $controller . 'noPermission' ]);
    });

			//============login=================

	$prefix         = '';
	$controllerName = 'auth';
	Route::group(['prefix' => $prefix], function() use($controllerName) {
		$controller = ucfirst($controllerName).'Controller@';
					//============login=================
		Route::get('/login', ['as'        =>$controllerName.'/login', 'uses'=>$controller.'login'])->middleware('check.login');
		Route::post('/postLogin',	['as' =>$controllerName.'/postLogin', 'uses' => $controller.'postLogin' ]);
					//============logout=================
        Route::get('/logout',       ['as' => $controllerName.'/logout',     'uses' => $controller . 'logout']);

	});

});

