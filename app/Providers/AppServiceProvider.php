<?php

namespace App\Providers;

use App\Repositories\UnitRepository;
use App\Repositories\BrandRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\UnitRepositoryInterface;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton(UnitRepositoryInterface::class, UnitRepository::class);
    $this->app->singleton(BrandRepositoryInterface::class, BrandRepository::class);
    $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
    
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
