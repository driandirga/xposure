<?php

namespace App\Repositories\Interfaces;

interface PurchaseInvoiceRepositoryInterface
{
    public function allPurchasesInvoice();

    public function storePurchaseInvoice($data);

    public function findPurchaseInvoice($id);

    public function updatePurchaseInvoice($data, $id);

    public function destroyPurchaseInvoice($id);
}
