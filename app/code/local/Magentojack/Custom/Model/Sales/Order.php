<?php
class Magentojack_Custom_Model_Sales_Order extends Mage_Sales_Model_Order{
	public function hasCustomFields(){
		$var = $this->getContacttype();
		if($var && !empty($var)){
			return true;
		}else{
			return false;
		}
	}
	public function getFieldHtml(){
		$var = $this->getContacttype();
		$html = '<b>Mod contact:</b>'.$var.'<br/>';
		return $html;
	}
}