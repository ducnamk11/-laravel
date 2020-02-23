<?php 
// echo "<pre> image.blade.php";
// print_r($item);
// echo "</pre>";
// die('function stop in here');
?>


@php
use App\Helpers\Template as Template;
$name               = $item['name'];
$thumb              = asset('images/article/'.$item['thumb']);
$class = '';
if($class == null){
$class = "img-fluid w-100";
}
@endphp
<div class="post_image"><img src="{{$thumb}}" alt="{{$name}}" class="{{$class}}"></div>
