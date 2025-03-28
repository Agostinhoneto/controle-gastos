@extends('layout')

@section('title', 'Calendário Financeiro')
@section('conteudo')
<div class="card">
    <div class="card-body">
        <div id="calendar" style="width: 60%; min-height: 500px;"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pt-br',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '/calendario/eventos',
            eventColor: '#3788d8',
            editable: true,
            eventDisplay: 'block'
        });

        calendar.render();

        // Tratamento de erros
        calendar.setOption('eventSources', [{
            url: '/calendario/eventos',
            failure: function() {
                alert('Erro ao carregar eventos!');
                // Eventos de fallback
                return [{
                    title: 'Evento de Exemplo',
                    start: new Date(),
                    color: 'red'
                }];
            }
        }]);
    });
</script>
@endpush