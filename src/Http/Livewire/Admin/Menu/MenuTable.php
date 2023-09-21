<?php

namespace SujanSht\LaraAdmin\Http\Livewire\Admin\Menu;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use SujanSht\LaraAdmin\Models\Admin\Menu;
use Illuminate\Support\Facades\Blade;

class MenuTable extends DataTableComponent
{
    protected $model = Menu::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Action")
                ->label(
                    fn ($row) => Blade::render('<x-action :model="$model" route="menus" :show="true" />', ['model' => $row])
                )
                ->html(),
        ];
    }
}
