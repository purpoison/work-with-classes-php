<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    h5{
        margin: 5px;
    }
    a{
        text-decoration: none;
        color: #000;
    }
    a:hover{
        color: red;
    }
</style>
<body>
    <?php 
    require_once __DIR__.'/class.php';
    require_once __DIR__.'/functions.php';
    require_once __DIR__.'/functions.php';

    $dataPath = __DIR__ . '/data.json';
    $categoriesPath = __DIR__.'/categories.json';
    $dataList = getData($dataPath);
    $products = [];
    if(isset($_POST['isSubmit'])){
        array_push($dataList, array(
            'name' => $_POST['productName'],
            'price' =>  $_POST['price'],
        ));
    };

    putData($dataList, $dataPath);

    if($dataList) {
        foreach ($dataList as $item) {
            $product = new Product($item['name'], $item['price']);
            array_push($products, $product);
        }
    }

    ?>
    <div class="container">
        <form action="" method="post">
            <input type="text" name="productName" placeholder="Enter name" required>
            <input type="text" name="price" placeholder="Enter price" required>
            <button type="submit" name="isSubmit">Add</button>
        </form>
        <?php     
            if(count($products) > 0 && $products){
                foreach ($products as $class){
                $class->getProduct();
                }
            };
        ?>
        <hr>
        <br>
        <form action="" method="post">
            <input type="text" name="search" placeholder="Enter key word">
            <button type="submit" name="submit">Search</button>
        </form>
        <br>
        <hr>
        <?php   

        if(isset($_POST['submit'])){
            searchByName($products, $_POST['search']);
        }
    ?>
        <form action="" method="post">
            <h2>Categories</h2>
            <input type="text" placeholder="Enter new category" name="category">
            <button type="submit" name="isSent">Add</button>
        </form>
        <br>
        <?php 
            $categories = [];

            $categoriesData = getData($categoriesPath);
            if(isset($_POST['isSent'])){
                if($dataList){
                    $catName = $_POST['category'];
                    array_push($categoriesData, array(
                        $catName=>$dataList
                    ));
                }
                putData($categoriesData, $categoriesPath);
                putData([], $dataPath);
            }

            if($categoriesData) {
                foreach ($categoriesData as $key => $value) {
                    foreach($value as $name => $list){
                        $category = new Category($name, $list);
                        array_push($categories, $category);
                    }

                }
            }
            if($categories):
        ?>
            <ul>
                <?php foreach($categories as $category):?>
                    <li> <a href="?name=<?php echo $category->getCategoryName()?>"><?php echo $category->getCategoryName()?></a></li>
                <?php endforeach?>
                <?php 
                    $findName = $_GET['name'];
                    $myObject = searchCategory($categories, $findName)->getCategoryProducts();
                    foreach($myObject as $object){
                        $rez = implode(' : ', $object);
                        echo "<p> {$rez} $</p>";
                    }
                ?>
            </ul>
        <?php endif?>
    </div>
</body>
</html>
