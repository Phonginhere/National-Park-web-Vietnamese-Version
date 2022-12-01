<?php
// Nếu giỏ hàng có sản phẩm:
//if (cartGetProductsWithFormat())
if(cartHasProducts())
{
	include_once "view-cart-products.php" ;
} 
else 
{
	// Nếu giỏ hàng không có sản phẩm
	include_once "view-cart-empty.php";
} 



