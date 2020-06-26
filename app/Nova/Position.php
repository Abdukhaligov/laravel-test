<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Position extends Resource {
  public static $model = \App\Models\Position::class;
  public static $title = 'name';
  public static $search = [
      'id',
  ];

  public function fields(Request $request) {
    return [
        ID::make()->sortable(),

        Text::make('Name'),

        HasMany::make('Companies')
    ];
  }
}
