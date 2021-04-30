<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">

                {!! $calendar->calendar() !!}
                {!! $calendar->script() !!}

    </div>
</x-app-layout>
