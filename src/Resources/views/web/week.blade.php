<x-hub::layouts.web pageName="This week at the Westville Community Hub">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <h3>Bookings for {{date('l, j F Y',strtotime($week))}}</h3>
        <div id="ec"></div>
        <script>
            let ec = EventCalendar.create(document.getElementById('ec'), {
                view: 'timeGridWeek',
                events: [
                    // your list of events
                ]
            });
        </script>
    </div>
</x-hub::layout>