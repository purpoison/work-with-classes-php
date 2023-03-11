<?php
    class Product{
        private $name;
        private $price;
        public function __construct($name, $price)
        {
            $this->name = $name;
            $this->price = $price;

        }
        public function getProduct(){
            echo '<h5>'. $this->name . ': '. $this->price. '$ </h5>';
        }
        public function getName(){
            return $this->name;
        }
    }
    $p = new Product('iPhone 14', 1000);
    $p->getName();

    class Category{
        private $name;
        private $list_products;
        public function __construct($name, $list_products){
            $this->name = $name;
            $this->list_products = $list_products;
        }
        public function getCategoryName(){
            return $this->name;
        }
        public function getCategoryProducts(){
            return $this->list_products;
        }
    }
?>