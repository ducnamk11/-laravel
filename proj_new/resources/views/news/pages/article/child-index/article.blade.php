@include('news.partials.article.image',['item'=>$itemsArticle,'type'=>'single'])
@php
use App\Helpers\Template as Template;
use App\Helpers\URL;
$lengthContent = 'full';
if($lengthContent ==  'full'){
    $content = $itemsArticle['content'];
    }else{
    $content      = Template::showContent($itemsArticle['content'],$lengthContent);
}
$showCategory = true;
$name         = $itemsArticle['name'];
$linkCategory =  URL::linkCategory($itemsArticle['category_id'],$itemsArticle['name']);
$linkArticle =  URL::linkArticle($itemsArticle['id'],$itemsArticle['name']);
$created      = Template::showDateTimeFrontEnd($itemsArticle['created']);
@endphp
<div class="post_content">
  @if($showCategory)
  <div class="post_category cat_technology "> <a href="{{$linkCategory}}">{{$itemsArticle['category_name']}}</a>    </div> 
  @endif
  <div class="post_title"><a href="{{$linkArticle}}">{{$name}}</a></div>
  <div class="post_info d-flex flex-row align-items-center justify-content-start">
    <div class="post_author d-flex flex-row align-items-center justify-content-start">
      <div class="post_author_image"><img src="{{'news/images/author_1.jpg'}}/" alt=""></div>
      <div class="post_author_name"><a href="#">Ducnamjr</a>
      </div>
  </div>
  <div class="post_date"><a href="#">{{$created}}</a></div>
</div>
@if($lengthContent>0)
<div class="post_text">
    <p>{{$content}}
    </p>
</div>
@endif
@if($lengthContent=='full')
<div class="post_text">
    <p>{!!$content!!}
    </p>
</div>
@endif
</div>