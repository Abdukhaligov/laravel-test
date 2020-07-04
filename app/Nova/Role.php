<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Role extends Resource {
  public static $model = \App\Models\Role::class;
  public static $title = 'name';
  public static $search = [
      'id',
  ];

  public function fields(Request $request) {
    return [
        ID::make()->sortable(),
        Text::make("Name"),

        BelongsToMany::make('Users')
    ];
  }
}
