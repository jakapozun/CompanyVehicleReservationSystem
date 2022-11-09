<template>
    <div class='reservations-calendar'>
        <FullCalendar
            class='app-calendar'
            ref="fullCalendar"
            defaultView="dayGridMonth"
            :options="calendarOptions"
        />
    </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'

import enLocale from '@fullcalendar/core/locales/en-gb';
import slLocale from '@fullcalendar/core/locales/sl';

export default {
    components: {
        FullCalendar
    },
    props: {
        events: {
            type: Array,
            default: [],
        },
        locale: {
            type: String,
            default: "sl",
        }
    },
    methods: {
        eventRender: function(info) {
            var tooltip = new Tooltip(info.el, {
                title: info.event.extendedProps.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        }
    },
    data: function () {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin, listPlugin],
                locales: [enLocale, slLocale],
                initialView: 'dayGridMonth',
                displayEventEnd: true,
                events: [],
            },
        }
    },
    created: function () {
        this.calendarOptions.events = this.events;
        this.calendarOptions.locale = this.locale;
    },
}
</script>

<style lang='scss'>
// you must include each plugins' css
// paths prefixed with ~ signify node_modules

.reservations-calendar {
    background: #fffffb;
    padding: 5px;
    border-radius: 10px;
}
</style>
