<?php

namespace App\Providers;

use App\Repositories\UnitRepository;
use App\Repositories\BrandRepository;
use App\Repositories\StockRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\SalesmanRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\WarehouseRepository;
use App\Repositories\SalesInvoiceRepository;
use App\Repositories\PurchaseInvoiceRepository;
use App\Repositories\Interfaces\UnitRepositoryInterface;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\StockRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\SalesmanRepositoryInterface;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use App\Repositories\Interfaces\SalesInvoiceRepositoryInterface;
use App\Repositories\Interfaces\PurchaseInvoiceRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    /**
     * Master Services
     */
    $this->app->singleton(UnitRepositoryInterface::class, UnitRepository::class);
    $this->app->singleton(BrandRepositoryInterface::class, BrandRepository::class);
    $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
    $this->app->singleton(ProductRepositoryInterface::class, ProductRepository::class);
    $this->app->singleton(WarehouseRepositoryInterface::class, WarehouseRepository::class);
    
    /**
     * Inventories Services
     */
    $this->app->singleton(StockRepositoryInterface::class, StockRepository::class);

    /**
     * Purchases Services
     */
    $this->app->singleton(SupplierRepositoryInterface::class, SupplierRepository::class);
    $this->app->singleton(PurchaseInvoiceRepositoryInterface::class, PurchaseInvoiceRepository::class);

    /**
     * Sales Services
     */
    $this->app->singleton(SalesmanRepositoryInterface::class, SalesmanRepository::class);
    $this->app->singleton(CustomerRepositoryInterface::class, CustomerRepository::class);
    $this->app->singleton(SalesInvoiceRepositoryInterface::class, SalesInvoiceRepository::class);

  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
