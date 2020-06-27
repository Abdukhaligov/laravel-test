<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class User extends Resource {
  public static $model = \App\Models\User::class;
  public static $title = 'name';
  public static $search = [
      'id', 'name', 'email',
  ];

  public function fields(Request $request) {
    return [
        ID::make()->sortable(),

        Text::make('Name')
            ->sortable()
            ->rules('required', 'max:255'),

        Text::make('Email')
            ->sortable()
            ->rules('required', 'email', 'max:254')
            ->creationRules('unique:users,email')
            ->updateRules('unique:users,email,{{resourceId}}'),

        Password::make('Password')
            ->onlyOnForms()
            ->creationRules('required', 'string', 'min:8')
            ->updateRules('nullable', 'string', 'min:8'),


        Files::make('Multiple files', 'user_media'),

        BelongsTo::make('Company'),

        BelongsTo::make('Position'),
    ];
  }
}
