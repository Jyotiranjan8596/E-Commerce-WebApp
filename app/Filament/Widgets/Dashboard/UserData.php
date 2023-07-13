<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\User;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class UserData extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return User::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
                TextColumn::make('id'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email'),
                // TextColumn::make('roles'),
                TextColumn::make('created_at'),
                TextColumn::make('updated_at')

        ];
    }
}
