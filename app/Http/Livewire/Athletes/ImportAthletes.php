<?php

namespace App\Http\Livewire\Athletes;

use Livewire\Component;
use App\Csv;
use Validator;
use App\Models\Athletes\Athlete;
use Livewire\WithFileUploads;

class ImportAthletes extends Component
{
    use WithFileUploads;

    public $showImportModal = false;
    public $upload;
    public $columns;
    public $fieldColumnMap = [
        'first_name' => '',
        'last_name' => '',
        'sex' => '',
        'grad_year' => '',
        'dob' => '',
        'status' => '',
    ];

    protected $listeners = ['showImportModal' => 'showModal'];

    protected $rules = [
        'fieldColumnMap.first_name' => 'required',
        'fieldColumnMap.last_name' => 'required',
        'fieldColumnMap.sex' => 'required',
        'fieldColumnMap.grad_year' => 'required',
        'fieldColumnMap.status' => 'required',
    ];

    protected $customAttributes = [
        'fieldColumnMap.first_name' => 'first_name',
        'fieldColumnMap.last_name' => 'last_name',
        'fieldColumnMap.sex' => 'sex',
        'fieldColumnMap.grad_year' => 'grad_year',
        'fieldColumnMap.dob' => 'dob',
        'fieldColumnMap.status' => 'status',
    ];

    public function showModal()
    {
        $this->showImportModal = true;
    }

    public function updatingUpload($value)
    {
        Validator::make(
            ['upload' => $value],
            ['upload' => 'required|mimes:txt,csv'],
        )->validate();
    }

    public function updatedUpload()
    {
        $this->columns = Csv::from($this->upload)->columns();

        $this->guessWhichColumnsMapToWhichFields();
    }

    public function import()
    {
        $this->validate();

        $importCount = 0;

        Csv::from($this->upload)
            ->eachRow(function ($row) use (&$importCount) {
                Athlete::create(
                    $this->extractFieldsFromRow($row)
                );

                $importCount++;
            });

        $this->reset();

        $this->emit('refreshAthletes');

//        $this->notify('Imported ' . $importCount . ' athletes!');
    }

    public function extractFieldsFromRow($row)
    {
        $attributes = collect($this->fieldColumnMap)
            ->filter()
            ->mapWithKeys(function ($heading, $field) use ($row) {
                return [$field => $row[$heading]];
            })
            ->toArray();

        return $attributes + ['status' => 'success', 'date_for_editing' => now()];
    }

    public function guessWhichColumnsMapToWhichFields()
    {
        $guesses = [
            'first_name' => ['First', 'First Name', 'first_name'],
            'last_name' => ['Last', 'Last Name', 'last_name'],
            'sex' => ['sex', 'gender'],
            'grad_year' => ['grad_year', 'grade', 'year'],
            'dob' => ['birthday'],
        ];

        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn($options) => in_array(strtolower($column), $options));

            if ($match) $this->fieldColumnMap[$match] = $column;
        }
    }
}
