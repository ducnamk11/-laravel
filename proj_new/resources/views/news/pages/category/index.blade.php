@extends('news.main')
@section('content')
<div class="section-category">
		<?php 
			// echo "<pre> category child-index/ category";
			// print_r($itemsCategory);
			// echo "</pre>";
			// // die('function stop in here');
			?>
	@include('news.block.breadcrumb',['item'=>$itemsCategory]);

	<div class="content_container container_category">
		<div class="featured_title">
			<div class="container">
				<div class="row">
					<!-- Main Content -->
					<div class="col-lg-9">
						@include('news.pages.category.child-index.category',['item'=>$itemsCategory])
					</div>
					<!-- Sidebar -->
					<div class="col-lg-3">
						<div class="sidebar">
							<!-- Latest Posts -->
							@include('news.block.latest_posts',['item'=>$itemsLatest])
  							@include('news.block.advertisement',['item'=>[]])
 							@include('news.block.most_viewed',['item'=>[]])
							@include('news.block.tags',['item'=>[]])
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection