<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gửi mail google</title>
</head>
<body>
	<h1>Mail được gửi từ : {{$name}}</h1>
	<h4>Với nội dung : {{$body}}</h4>
	<?php foreach ($products as $key => $value): ?>
		<h5>Tên sản phẩm :{{$value['info']->productName}} - Giá :{{$value['info']->unitPrice}} </h5>
	<?php endforeach ?>
	<h4>Chân thành cảm ơn</h4>
	

</body>
</html>