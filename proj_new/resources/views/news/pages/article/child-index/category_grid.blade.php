
<div class="posts">
	<div class="col-lg-12">
		<div class="row">
				<?php 
			echo "<pre> category child-index/ category";
			print_r($itemsCategory);
			echo "</pre>";
			// die('function stop in here');
			?>
			@foreach($item['related_article'] as $key=>$article)
			<div class="col-lg-6">
				<div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
					@include('news.partials.article.image',['item'=>$article])
					@include('news.partials.article.content',['item'=>$article,'lengthContent'=>220,'showCategory'=>false])
				</div>
			</div>
			@endforeach
		</div>
		<div class="row">
			<div class="home_button mx-auto text-center"><a href="#">Xem
			thêm</a></div>
		</div>
	</div>
</div>
</div>
