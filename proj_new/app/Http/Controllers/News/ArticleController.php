<?php

namespace App\Http\Controllers\news;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\View;
class ArticleController extends Controller
{
	private $pathViewSlider = 'news.pages.article.';
	private $controllerName = 'article';
	private $model;
	private $params;

	public function __construct()
	{
		view()->share('controllerName', $this->controllerName);  
	}	
	public function index( Request $request)
	{
		$params['category_id'] = $request->category_id;
		$params['article_id'] = $request->article_id;
		$articleModel  = new ArticleModel(); 
		$itemsArticle   = $articleModel->getItem($params,['task'=>'news-get-item']); 
		if(isset($itemsArticle['category_id'])) $params['category_id']  = $itemsArticle['category_id']; 
		$itemsArticle['related_articles']   = $articleModel->listItems($params,['task'=>'news-list-items-related-in-category']); 

		if (empty($itemsArticle))  return redirect()->route('home');
		$itemsLatest   = $articleModel->listItems($params,['task'=>'news-list-items-latest']); 
		return view($this->pathViewSlider.'index',[
			'params'        =>$this->params,  
			'itemsLatest'   => $itemsLatest,
			'itemsArticle'   => $itemsArticle
		]);
	}

}
