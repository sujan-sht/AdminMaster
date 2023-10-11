<?php

namespace SujanSht\AdminMaster\Http\Livewire\Admin\Menu;

use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use SujanSht\AdminMaster\Models\Admin\Menu;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class MenuTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Menu::query()
            ->orderBy('position'); // Eager load anything; // Select some things
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Active')
                ->options([
                    '' => 'All',
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('active', true);
                    } elseif ($value === '0') {
                        $builder->where('active', false);
                    }
                }),
        ];
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No Menus Found !!!');

        $this->setReorderStatus(true);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Menu::find((int) $item['value'])->update(['position' => (int) $item['order']]);
        }
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Route", "route")
                ->searchable()
                ->format(
                    fn($value, $row) => '<a href="'.adminBaseUrl($row->route).'">'.$row->route.'</a>'
                )->html(),
            Column::make("Icon", "icon")
                ->format(
                    fn($value, $row) => '<i class="'.$row->icon.'"></i>'
                )->html(),
            BooleanColumn::make('Active', 'active'),
            Column::make("Action")
                ->label(
                    fn ($row) => Blade::render('<x-admin-master-action :model="$model" route="menus" :show="false" />', ['model' => $row])
                )
                ->html(),
        ];
    }
}
