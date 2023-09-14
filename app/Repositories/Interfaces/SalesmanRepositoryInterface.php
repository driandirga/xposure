<?php

namespace App\Repositories\Interfaces;

interface SalesmanRepositoryInterface
{
    public function allSalesmen();

    public function storeSalesman($data);

    public function findSalesman($id);

    public function updateSalesman($data, $id);

    public function destroySalesman($id);
}
