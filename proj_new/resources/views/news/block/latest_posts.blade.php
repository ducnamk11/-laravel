@php
use App\Helpers\URL;
use App\Helpers\Template;
@endphp
<div class="sidebar_latest">
    <div class="sidebar_title">Bài viết mới nhất</div>
    <div class="latest_posts">
        <!-- Latest Post -->
        @foreach ($item as $item)
        @php
        $thumb         =asset('news/images/article/'.$item['thumb']);
        $name         =$item['name'];
        $category     =$item['category_name'];
        $created      =Template::showDateTimeFrontEnd($item['created']);
        $linkCategory =  URL::linkCategory($item['category_id'],$item['name']);
        $linkArticle =  URL::linkArticle($item['id'],$item['name']);
        @endphp
        <div class="latest_post d-flex flex-row align-items-start justify-content-start">
            <div>
                <div class="latest_post_image"><img src="{!! $thumb!!}" alt="">
                </div>
            </div>
            <div class="latest_post_content">
                <div class="post_category_small cat_video"><a href="{!!$linkCategory!!}">{!!$category!!}</a></div>
                <div class="latest_post_title"><a href="{!!$linkArticle!!}">{!!$name!!}</a></div>
                <div class="latest_post_date">{!!$created!!}</div> 
            </div>
        </div>
        @endforeach
    </div>
</div>






