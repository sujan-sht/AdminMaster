<?php

namespace SujanSht\LaraAdmin\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class UserTable extends DataTableComponent
{
    // protected $model = User::class;
    public function builder(): Builder
    {
        return User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'super admin');
        });
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Action")
                ->label(
                    fn ($row) => Blade::render('<x-lara-admin-action :model="$model" route="users" :show="false" />', ['model' => $row])
                )
                ->html(),
        ];

    }
}
