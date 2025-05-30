<?php

namespace App\Controllers;

use App\Services\ProductService;
use DomainException;
use SplFileObject;
use Throwable;

class ProductController extends BaseController
{
    private ProductService $productService;

    public function __construct()
    {
        parent::__construct();

        $this->productService = new ProductService();
    }

    public function index(): void
    {
        $items = $this->productService->getAll();

        $this->view->render('products/index', compact('items'));
    }

    public function importCsv(): void
    {
        $backUrl = $_SERVER['HTTP_REFERER'] ?? '/products';

        try {
            if (empty($_FILES['csv']['tmp_name'])) {
                throw new DomainException('CSV файл обязателен');
            }

            $csv = new SplFileObject($_FILES['csv']['tmp_name']);
            $importedRows = $this->productService->importCsv($csv);

            header('Location: ' . $backUrl . '?imported=' . $importedRows);
            exit;

        } catch (DomainException $e) {
            header('Location: ' . $backUrl . '?error=' . urlencode($e->getMessage()));
            exit;
        }
        catch (Throwable $e) {
            header('Location: ' . $backUrl . '?error=' . urlencode($e->getMessage()));
            exit;
        }
    }

}