<?php

namespace App\Repositories\Interfaces;

interface SalesInvoiceRepositoryInterface
{
    public function allSalesInvoice();

    public function storeSalesInvoice($data);

    public function findSalesInvoice($id);

    public function updateSalesInvoice($data, $id);

    public function destroySalesInvoice($id);
}
