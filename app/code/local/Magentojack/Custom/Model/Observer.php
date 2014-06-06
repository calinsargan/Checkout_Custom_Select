<?php
class Magentojack_Custom_Model_Observer{
	public function saveQuoteBefore($evt){
		$quote = $evt->getQuote();
		$post = Mage::app()->getFrontController()->getRequest()->getPost();
		if(isset($post['custom']['contacttype'])){
			$var = $post['custom']['contacttype'];
			$quote->setContacttype($var);
		}
	}
	public function saveQuoteAfter($evt){
		$quote = $evt->getQuote();
		if($quote->getContacttype()){
			$var = $quote->getContacttype();
			if(!empty($var)){
				$model = Mage::getModel('custom/custom_quote');
				$model->deteleByQuote($quote->getId(),'contacttype');
				$model->setQuoteId($quote->getId());
				$model->setKey('contacttype');
				$model->setValue($var);
				$model->save();
			}
		}
	}
	public function loadQuoteAfter($evt){
		$quote = $evt->getQuote();
		$model = Mage::getModel('custom/custom_quote');
		$data = $model->getByQuote($quote->getId());
		foreach($data as $key => $value){
			$quote->setData($key,$value);
		}
	}
	public function saveOrderAfter($evt){
		$order = $evt->getOrder();
		$quote = $evt->getQuote();
		if($quote->getContacttype()){
			$var = $quote->getContacttype();
			if(!empty($var)){
				$model = Mage::getModel('custom/custom_order');
				$model->deleteByOrder($order->getId(),'contacttype');
				$model->setOrderId($order->getId());
				$model->setKey('contacttype');
				$model->setValue($var);
				$order->setContacttype($var);
				$model->save();
			}
		}
	}
	public function loadOrderAfter($evt){
		$order = $evt->getOrder();
		$model = Mage::getModel('custom/custom_order');
		$data = $model->getByOrder($order->getId());
		foreach($data as $key => $value){
			$order->setData($key,$value);
		}
	}

}