<?php

namespace App\Http\Livewire\Calendar;

use App\Models\Calendar\Calendar;
use Carbon\Carbon;
use Livewire\Component;

class MonthlyCalendar extends Component
{
    public $selectedMonth;

    public function mount(): Carbon
    {
        return $this->selectedMonth = Carbon::now();
    }

    public function goToNextMonth()
    {
        return $this->selectedMonth->month++;
    }

    public function goToPreviousMonth()
    {
        return $this->selectedMonth->month--;
    }
    public function render()
    {
        return view('livewire.calendar.monthly-calendar', [
            'dates' => Calendar::with('teamEvents')
                ->where('month', $this->selectedMonth->month)
                ->where('year', $this->selectedMonth->year)
                ->get()
        ]);
    }
}
