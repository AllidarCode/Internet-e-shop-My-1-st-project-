<?php
    
    require_once('files/functions.php');
    
    $id = $_POST['id'];
    
    $pro = get_product($id);
    if ($pro == null) {
        die('Product not found');
    }
    
    $pro['quantity'] = ((int)($_POST['quantity']));
    $_SESSION['cart '][$id] = $pro;
    
    alert('success', 'Product added to cart successfully.');
    header('Location: shop.php');