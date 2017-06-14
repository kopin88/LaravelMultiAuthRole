<?php

namespace kopin88\LaravelMultiAuthRole\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  protected $routeMiddleware = [
      'roles' => \kopin88\LaravelMultiAuthRole\Http\CheckRole::class,
  ];
}
