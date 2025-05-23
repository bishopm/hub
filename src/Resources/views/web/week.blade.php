<x-hub::layouts.web pageName="This week at the Westville Community Hub">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <div id="ec"></div>
        <script>
            let ec = EventCalendar.create(document.getElementById('ec'), {
                view: 'resourceTimeGridDay',
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek resourceTimeGridDay'
                },
                resources: {!! json_encode($venues) !!},
                slotMinTime: '07:00:00',
                slotMaxTime: '21:30:00',
                events: {!! json_encode($diaries) !!}
            });
        </script>
    </div>
</x-hub::layout>