<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Controle de Gastos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <style>
    .nav-link.custom-active {
      background-color: #cc0000;
      /* Fundo vermelho escuro */
      color: #ffffff;
      /* Texto branco */
    }

    .nav-link.custom-active-orange {
      background-color: #e0a800;
      /* Fundo laranja claro */
      color: #000000;
      /* Texto branco */
    }

    .nav-link.custom-active:hover {
      background-color: #ff4d4d;
      /* Fundo vermelho claro ao passar o mouse */
      color: #ffffff;
      /* Texto branco */
    }

    .nav-link.custom-active-green {
      background-color: #28a745;
      /* Verde padrão */
      color: #ffffff;
      /* Texto branco */
    }

    .nav-link.custom-active:hover {
      background-color: #218838;
      /* Verde mais escuro no hover */
      color: #ffffff;
    }

    .nav-link.custom-active-gray {
      background-color: #6C757D;
      /* Verde padrão */
      color: #ffffff;
      /* Texto branco */
    }

    .nav-link.custom-active:hover {
      background-color: #218838;
      /* Verde mais escuro no hover */
      color: #ffffff;
    }

    .nav-link.custom-active-blue {
      background-color: #007BFF;
      /* Azul padrão */
      color: #ffffff;
      /* Texto branco */
    }

    .nav-link.custom-active-blue:hover {
      background-color: #0056b3;
      /* Azul mais escuro no hover */
      color: #ffffff;
      /* Texto branco */
    }

    .nav-link.custom-active-gra {
      background-color:rgb(96, 99, 102);
      /* Azul padrão */
      color: #ffffff;
      /* Texto branco */
    }
    .nav-link.custom-active-gra:hover {
      background-color:rgb(82, 85, 88);
      /* Azul mais escuro no hover */
      color: #ffffff;
      /* Texto branco */
    }

    .nav-link.custom-active-lembrete {
      background-color:rgb(238, 122, 142);
      /* Azul padrão */
      color: #ffffff;
      /* Texto branco */
    }
    .nav-link.custom-active-lembrete:hover {
      background-color:rgb(4, 65, 27);
      /* Azul mais escuro no hover */
      color: #ffffff;
      /* Texto branco */
    }
    .nav-link.custom-active-calendar {
      background-color:rgb(4, 56, 26);
      /* Azul padrão */
      color: #ffffff;
      /* Texto branco */
    }
    .nav-link.custom-active-lembrete:hover {
      background-color:rgb(34, 218, 65);
      /* Azul mais escuro no hover */
      color: #ffffff;
      /* Texto branco */
    }

    .nav-link.custom-active-fin {
      color: #000;
      /* Texto preto para contraste */
      background-color: #F5F5F5;
      /* Cinza claro */
      border-radius: 5px;
      padding: 8px 16px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .nav-link.custom-active-fin:hover {
      background-color: #FFE8A1;
      /* Amarelo um pouco mais intenso no hover */
    }


    .nav-link.custom-active-rel {
      color: #fff;
      /* Texto branco para contraste */
      background-color: #6F42C1;/* Roxo elegante */
      border-radius: 5px;
      padding: 8px 16px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .nav-link.custom-active-fin:hover {
      background-color: #59389A; /* Roxo mais escuro no hover */
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{route('dashboard')}}" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Controle de gastos</span>
      </a>

      @php
      $hour = now()->hour;
      $greeting = '';
      if ($hour >= 5 && $hour < 12) {
        $greeting='Bom dia' ;
        } elseif ($hour>= 12 && $hour < 18) {
          $greeting='Boa tarde' ;
          } else {
          $greeting='Boa noite' ;
          }
          @endphp
          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="#" class="d-block">Olá, {{$greeting}} {{ Auth::user()->name }}! </a>

              </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <a href="{{route('receitas.index')}}" class="nav-link active">
                    <i class="nav-icon fas fa-dollar-sign"></i>
                    <p>
                      Receitas
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('despesas.index')}}" class="nav-link custom-active">
                    <i class="nav-icon fas fa-money-bill-wave"></i>
                    <p>
                      Despesas
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('financas.index')}}" class="nav-link custom-active-green">
                    <i class="fas fa-chart-line"></i>
                    <p>
                      Minhas Finanças
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('users.index')}}" class="nav-link custom-active-orange">
                    <i class="nav-icon fas fa-user"></i>
                    Usuários
                    <span class="right badge badge-danger"></span>
                  </a>
                </li>
               
                <li class="nav-item">
                  <a href="{{route('categorias.index')}}" class="nav-link custom-active-gray">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>
                      Catogorias
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('relatorios.index')}}" class="nav-link custom-active-rel">
                    <i class="fas fa-chart-pie"></i>
                    <p>
                      Relatórios
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('calendario.index')}}" class="nav-link custom-active-calendar">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                      Calendário Financeiro
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('lembretes.index')}}" class="nav-link custom-active-lembrete">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>
                      Lembretes
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('charts.index')}}" class="nav-link custom-active-gra">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                      Gráficos
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('contatos.index')}}" class="nav-link custom-active-blue">
                    <i class="nav-icon fas fa-address-book"></i>
                    <p>
                      Contatos
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>

                <li class="nav-header">OUTRAS FUNCIONALIDADES</li>
                <li class="nav-item">
                  <a href="pages/calendar.html" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                      Calendário
                      <span class="badge badge-info right">2</span>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Outros
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                      Extras
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Login & Register v1
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="pages/examples/login.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Login v1</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="pages/examples/register.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register v1</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="pages/examples/forgot-password.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Forgot Password v1</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-search"></i>
                    <p>
                      Pesquisar
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="pages/search/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Simple Search</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
    </aside>


    <!--
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
      </div>
      <strong></a>.</strong>
    </footer>
-->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery UI -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/fullcalendar/main.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {

      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function() {

          // create an Event Object (https://fullcalendar.io/docs/event-object)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)

          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex: 1070,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
          })

        })
      }

      ini_events($('#external-events div.external-event'))

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;

      var containerEl = document.getElementById('external-events');
      var checkbox = document.getElementById('drop-remove');
      var calendarEl = document.getElementById('calendar');

      // initialize the external events
      // -----------------------------------------------------------------

      new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
          return {
            title: eventEl.innerText,
            backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
            borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
            textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
          };
        }
      });

      var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: [{
            title: 'All Day Event',
            start: new Date(y, m, 1),
            backgroundColor: '#f56954', //red
            borderColor: '#f56954', //red
            allDay: true
          },
          {
            title: 'Long Event',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2),
            backgroundColor: '#f39c12', //yellow
            borderColor: '#f39c12' //yellow
          },
          {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 30),
            allDay: false,
            backgroundColor: '#0073b7', //Blue
            borderColor: '#0073b7' //Blue
          },
          {
            title: 'Lunch',
            start: new Date(y, m, d, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false,
            backgroundColor: '#00c0ef', //Info (aqua)
            borderColor: '#00c0ef' //Info (aqua)
          },
          {
            title: 'Birthday Party',
            start: new Date(y, m, d + 1, 19, 0),
            end: new Date(y, m, d + 1, 22, 30),
            allDay: false,
            backgroundColor: '#00a65a', //Success (green)
            borderColor: '#00a65a' //Success (green)
          },
          {
            title: 'Click for Google',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'https://www.google.com/',
            backgroundColor: '#3c8dbc', //Primary (light-blue)
            borderColor: '#3c8dbc' //Primary (light-blue)
          }
        ],
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        }
      });

      calendar.render();
      // $('#calendar').fullCalendar()

      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      // Color chooser button
      $('#color-chooser > li > a').click(function(e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color': currColor
        })
      })
      $('#add-new-event').click(function(e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
          return
        }

        // Create events
        var event = $('<div />')
        event.css({
          'background-color': currColor,
          'border-color': currColor,
          'color': '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)

        // Add draggable funtionality
        ini_events(event)

        // Remove event from text input
        $('#new-event').val('')
      })
    })
  </script>
</body>

</html>