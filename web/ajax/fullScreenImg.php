<?php
$answer = array();
if(empty($_POST['imgSrc'])){
	$answer['error'] = 'No path to hires picture was received.';
	die(json_encode($answer));
}
?>
<figure class="img-block">
	<img src="http://<?php echo $_SERVER['HTTP_HOST'].$_POST['imgSrc'] ?>" alt="">
</figure>
<div class="help">
	Esc или клик мыши закрывает окно.
</div>
<div class="border"></div>
<?php 
// $answer['error'] = false;
// echo json_encode($answer); 
?>