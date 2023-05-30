<?php
    
    require_once('files/functions.php');
    
    $id = (int)($_GET['id']);
    
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $v) {
            if ($v['pro']['id'] == $id) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
    
    alert('success', 'Product removed from cart successfully.');
    header('Location: shop.php');