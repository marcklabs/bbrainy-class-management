document.addEventListener('DOMContentLoaded', function() {
    const currentDateElement = document.getElementById('current-date');
    const eventList = document.getElementById('event-list');
    const calendarElement = document.getElementById('calendar');
    const currentYearElement = document.getElementById('current-year');
    const currentMonthElement = document.getElementById('current-month');

    let currentDate = new Date();

    function updateCurrentDate(date) {
        const options = { weekday: 'short', day: 'numeric', month: 'long' };
        currentDateElement.textContent = date.toLocaleDateString('it-IT', options).toUpperCase();
    }

    function fetchMonthEvents(year, month) {
        fetch(`fetch_events.php?year=${year}&month=${month + 1}`)
            .then(response => response.json())
            .then(events => {
                // Organize events by date
                const eventsByDate = events.reduce((acc, event) => {
                    acc[event.date] = acc[event.date] || [];
                    acc[event.date].push(event);
                    return acc;
                }, {});
                markCalendarDays(eventsByDate);
            })
            .catch(error => console.error('Errore:', error));
    }

    function markCalendarDays(eventsByDate) {
        const dateCells = calendarElement.querySelectorAll('td[data-date]');
        dateCells.forEach(cell => {
            const cellDate = cell.getAttribute('data-date');
            if (eventsByDate[cellDate]) {
                cell.classList.add('has-event'); // Add class for styling
            }
        });
    }

    function createCalendar(date) {
        const year = date.getFullYear();
        const month = date.getMonth();
        currentYearElement.textContent = year;
        currentMonthElement.textContent = new Date(year, month, 1).toLocaleString('it-IT', { month: 'long' });

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        
        let calendarHTML = '<table>';
        calendarHTML += '<tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Gio</th><th>Ven</th><th>Sab</th><th>Dom</th></tr>';

        let day = 1;
        let startDay = (firstDay.getDay() + 6) % 7;

        for (let i = 0; i < 6; i++) {
            calendarHTML += '<tr>';
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < startDay) {
                    calendarHTML += '<td></td>';
                } else if (day > lastDay.getDate()) {
                    calendarHTML += '<td></td>';
                } else {
                    const formattedDate = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                    calendarHTML += `<td data-date="${formattedDate}">${day}</td>`;
                    day++;
                }
            }
            calendarHTML += '</tr>';
            if (day > lastDay.getDate()) break;
        }
        calendarHTML += '</table>';
        calendarElement.innerHTML = calendarHTML;

        fetchMonthEvents(year, month);
    }

    document.getElementById('prev-year').addEventListener('click', () => {
        currentDate.setFullYear(currentDate.getFullYear() - 1);                                     
        createCalendar(currentDate);
    });

    document.getElementById('next-year').addEventListener('click', () => {
        currentDate.setFullYear(currentDate.getFullYear() + 1);
        createCalendar(currentDate);
    });

    document.getElementById('prev-month').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        createCalendar(currentDate);
    });

    document.getElementById('next-month').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        createCalendar(currentDate);
    });

    updateCurrentDate(currentDate);
    createCalendar(currentDate);
});
