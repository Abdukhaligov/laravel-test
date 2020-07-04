<?php

namespace App\Providers;

use App\Repositories\CompanyRepository;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\MediaRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\MediaRepository;
use App\Repositories\PositionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
  public function register() {
    $this->app->bind(
        UserRepositoryInterface::class,
        UserRepository::class
    );
    $this->app->bind(
        CompanyRepositoryInterface::class,
        CompanyRepository::class
    );
    $this->app->bind(
        PositionRepositoryInterface::class,
        PositionRepository::class
    );
    $this->app->bind(
        MediaRepositoryInterface::class,
        MediaRepository::class
    );
    $this->app->bind(
        ProductRepositoryInterface::class,
        ProductRepository::class
    );
    $this->app->bind(
        RoleRepositoryInterface::class,
        RoleRepository::class
    );
  }

  public function boot() {
    //
  }
}
