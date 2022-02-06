<div>
@include('livewire.time-trials._time-trial-header')
    <div class="py-4">
                <livewire:time-trials.track-time-trial-events-form :timeTrial="$timeTrial" />

                <livewire:time-trials.track-time-trial-events-index :timeTrial="$timeTrial" />
{{--                <livewire:time-trials.track-time-trial-running-event-results-index :time-trial="$timeTrial" />--}}
    </div>




</div>
