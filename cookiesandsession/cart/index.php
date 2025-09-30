<?php include "connect.php" ?>
<?php session_start(); ?>
<html>
<body>
<h1>Hi, <?=$_SESSION["username"]?>!</h1>
	<?php
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart']=array();
	}	
	?>
	<a href="cart.php?action=">สินค้าในตะกร้า (<?=sizeof($_SESSION['cart'])?>)</a>
	<div style="display:flex">	
	<?php
		$stmt = $pdo->prepare("SELECT * FROM product");
		$stmt->execute();
		while ($row = $stmt->fetch()) { 
	?>
		<div style="padding: 15px; text-align: center">
			<a href="detail.php?pid=<?=$row["pid"]?>">
				<img src='img/<?=$row["pid"]?>.jpg' width='100'></a><br>
			<?=$row ["pname"]?><br><?=$row ["price"]?> บาท<br>	
			<form method="post" action="cart.php?action=add&pid=<?=$row["pid"]?>&pname=<?=$row["pname"]?>&price=<?=$row["price"]?>">
				<input type="number" name="qty" value="1" min="1" max="9">
				<input type="submit" value="ซื้อ">	   
			</form>
		</div>
	<?php } ?>
	</div>
    <a href="../myShop/customer_page.php">ย้อนกลับไปหน้ารายการออเดอร์</a>
</body>
</html>