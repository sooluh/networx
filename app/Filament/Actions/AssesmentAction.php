<?php

namespace App\Filament\Actions;

use App\Models\Alternative;
use App\Models\Assesment;
use App\Models\Criteria;
use App\Models\Subcriteria;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;

class AssesmentAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'assesment';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $criterias = Criteria::all();

        $this->label('Penilaian')
            ->modalHeading(fn (Alternative $record) => "Penilaian $record->name")
            ->icon('heroicon-o-clipboard-document')
            ->modalWidth(MaxWidth::ExtraLarge)
            ->form(function (?Alternative $record) use ($criterias) {
                $fields = [];

                foreach ($criterias as $criteria) {
                    $options = Subcriteria::query()
                        ->where('criteria_id', $criteria->id)
                        ->pluck('name', 'id');

                    if ($record) {
                        $existing = Assesment::query()
                            ->where('alternative_id', $record->id)
                            ->where('criteria_id', $criteria->id)
                            ->first();
                    }

                    $fields[] = Forms\Components\Select::make("criteria_$criteria->id")
                        ->label($criteria->name)
                        ->options($options)
                        ->searchable()
                        ->default($existing?->subcriteria_id);
                }

                return $fields;
            })
            ->action(function (array $data, Alternative $record) use ($criterias) {
                foreach ($criterias as $criteria) {
                    $name = "criteria_$criteria->id";
                    $id = $data[$name] ?? null;

                    if ($id) {
                        Assesment::updateOrCreate(
                            ['alternative_id' => $record->id, 'criteria_id' => $criteria->id, 'subcriteria_id' => $id],
                            ['subcriteria_id' => $id],
                        );
                    }
                }

                Notification::make()
                    ->title('Data penilaian berhasil diperbarui.')
                    ->success()
                    ->send();
            });
    }
}
