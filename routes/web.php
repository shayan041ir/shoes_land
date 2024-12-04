<?php
// مسیریابی صفحات اصلی
if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/home') {
    require_once '../app/controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index();
} elseif ($_SERVER['REQUEST_URI'] === '/products') {
    require_once '../app/controllers/ProductController.php';
    $controller = new ProductController();
    $controller->index();
}
// مسیرهای دیگر...
?>
