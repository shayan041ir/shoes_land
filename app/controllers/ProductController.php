<?php

class ProductController
{
    public function index()
    {
        require_once __DIR__ . '/../models/Product.php';
        $productModel = new Product();
        $products = $productModel->getAll();
        require_once __DIR__ . '/../views/admin/products.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'image' => $_FILES['image']['name']
            ];

            require_once __DIR__ . '/../models/Product.php';
            $productModel = new Product();
            $productModel->create($data);

            // آپلود تصویر
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/uploads/' . $_FILES['image']['name']);

            header('Location: /admin/products');
            exit;
        }
        require_once __DIR__ . '/../views/admin/product-create.php';
    }

    public function edit($id)
    {
        require_once __DIR__ . '/../models/Product.php';
        $productModel = new Product();
        $product = $productModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'image' => $_FILES['image']['name'] ?? $product['image']
            ];

            $productModel->update($data);

            if (!empty($_FILES['image']['name'])) {
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/uploads/' . $_FILES['image']['name']);
            }

            header('Location: /admin/products');
            exit;
        }

        require_once __DIR__ . '/../views/admin/product-edit.php';
    }

    public function delete($id)
    {
        require_once __DIR__ . '/../models/Product.php';
        $productModel = new Product();
        $productModel->delete($id);
        header('Location: /admin/products');
        exit;
    }
}
