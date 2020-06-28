<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource {
  public static $model = \App\Models\Product::class;
  public static $title = 'id';
  public static $search = [
      'id',
  ];

  public function fields(Request $request) {
    return [
        ID::make()->sortable(),
        Text::make("Name"),
        Text::make("Category"),
        Number::make("Price"),
        BelongsTo::make("User")
    ];
  }
}
