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
    protected int | string | array $columnSpan = 'full';
    protected function getTableColumns(): array
    {
        return [
                TextColumn::make('id')->visibleFrom('md'),
                TextColumn::make('name')->searchable()->visibleFrom('md'),
                TextColumn::make('email')->visibleFrom('md'),
                // TextColumn::make('roles'),
                TextColumn::make('created_at')->visibleFrom('md'),
                TextColumn::make('updated_at')->visibleFrom('md')
            ];
    }
}
