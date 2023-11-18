<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Agenda Sebastiano Nocera') }}
        </h2>
    </x-slot>

    <div id="calendar" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    This is home page!
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/dist/main.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    weekNumberCalculation: 'ISO',
                    initialView: 'timeGridWeek',
                    timeZone: 'Europe/Rome',
                    locale: 'it',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '20:00:00',
                    slotDuration: '00:15:00',
                    events: @json($events),
                    selectable: true, // Abilita la selezione di date e orari
                    select: function(info) {
                        var title = prompt('Inserisci il nome della/del cliente:');
                        if (title) {
                            calendar.addEvent({
                                title: title,
                                start: info.startStr,
                                end: info.endStr,
                                allDay: info.allDay
                            });
                        }
                        calendar.unselect(); // Deseleziona il periodo selezionato
                    },
                     eventClick: function(info) {
                    if (confirm('Sei sicuro di voler eliminare l\'appuntamento?')) {
                        info.event.remove();
                    }
                },
                });
                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
