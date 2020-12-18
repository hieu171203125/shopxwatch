<?php
namespace App;
class Cart 
{
	public $list =  null;
	public $totalPrice = 0;
	public $totalQuantity = 0;
	public function __construct($cart){
		if($cart){
			$this->list = $cart->list;
			$this->totalPrice = $cart->totalPrice;
			$this->totalQuantity = $cart->totalQuantity;
		}
	}
	public function AddCart($product,$productID,$quantity){
		$newProduct = ['quantity'=>0,'info'=>$product,'total'=>$product->unitPrice];
		if($this->list)//nếu trong giỏ hàng tồn tại sản phẩm
		{
			if(array_key_exists($productID, $this->list))
			//kiểm tra $id xem có tồn tải trong products(của cart) không,nếu có thì sẽ cập nhật số lượng,nếu không thì sẽ gán vào sản phẩm mới
			{
				$newProduct = $this->list[$productID];
			}
		}
		$newProduct['quantity'] += $quantity;
		$newProduct['total'] = $newProduct['quantity'] * $product->unitPrice*(1-0.01*(double)$product->discount);
		$this->list[$productID]=$newProduct;
		$this->totalPrice += $quantity * $product->unitPrice*(1-0.01*(double)$product->discount);;	
		$this->totalQuantity += $quantity;


	}
	public function delete_cart($productID)
	{
		$this->totalQuantity -= $this->list[$productID]['quantity'];
		$this->totalPrice -= $this->list[$productID]['total'];
		unset($this->list[$productID]);
	}

}
