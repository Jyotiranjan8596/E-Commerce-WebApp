<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserCount extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('User Count',User::count())->
                description('Total Number of User'),

            Card::make('Product Count',Product::count())->
                description('Total Number of Products'),

            Card::make('Order Count',Order::count())->
                description('Total Number of Orders'),

        ];
    }
}
