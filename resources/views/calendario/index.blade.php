<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/pt-br.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="calendario"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarioEl = document.getElementById('calendario');
            var calendario = new FullCalendar.Calendar(calendarioEl, {
                locale: 'pt-br',
                initialView: 'dayGridMonth',
                events: '/calendario/eventos',
                eventColor: 'blue'
            });
            calendario.render();
        });
    </script>
</body>
</html>
