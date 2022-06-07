@extends('layouts.app_layouts')
@section('css')

@endSection()

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar" style="">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Gestion des sessions de formation</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted text-capitalize">Sessions de formation</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Liste des sesssions de formation</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Wrapper-->
                <div class="me-4">
                    
                </div>
                <!--end::Wrapper-->
                <!--begin::Button-->
                <a href="{{ route('addPlanning') }}" class="btn btn-sm btn-primary"  id="kt_toolbar_primary_button"  >Ajouter</a>
                <!--end::Button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="row mb-5" style="margin-bottom:20px">
        <div class="col-md-12 mb-5">
        <!-- <div id="calendar" style="width: 100%; min-height: 1000px;"></div> -->
        <div class="main">
  <div id="dp"></div>
</div>
        </div>
    </div>
    <!--end::Post-->
</div>
 <!--end::Content-->
    @section('javascript')
    <script src="{{ asset('assets/calendars/daypilot/daypilot-all.min.js') }}"></script>
    <script>
  const disableWeekends = false;
  const disablePast = false;
  const disableHolidays = false;
  const disableMaintenance = true;

  const holidays = [
    {date: "2022-05-01", name: "Labour Day"}
  ];

  const maintenance = [
    {start: "2022-05-09", end: "2022-05-10"}
  ];

  const calendar = new DayPilot.Month("dp", {
    locale: "fr-fr",
    viewType: "Month",
    showWeekend: true,
    timeRangeSelectedHandling: "Enabled",
    onTimeRangeSelected: async (args) => {
      const modal = await DayPilot.Modal.prompt("Create a new event:", "Event 1");
      const dp = args.control;
      dp.clearSelection();
      if (modal.canceled) { return; }
      dp.events.add({
        start: args.start,
        end: args.end,
        id: DayPilot.guid(),
        text: modal.result
      });
    },
    onBeforeCellRender: args => {

      if (disablePast) {
        // const disabled = args.cell.start < DayPilot.Date.today();
        const disabled = args.cell.start < new DayPilot.Date("2022-05-04");
        if (disabled) {
          args.cell.properties.disabled = true;
          args.cell.properties.areas = [
            {
              left: 0,
              right: 0,
              bottom: 0,
              height: 5,
              backColor: "#aaaaaa"
            },
          ];
        }
      }

      if (disableWeekends) {
        const dayOfWeek = args.cell.start.getDayOfWeek();
        const disabled = dayOfWeek === 0 || dayOfWeek === 6;
        if (disabled) {
          args.cell.properties.disabled = true;
          args.cell.properties.areas = [
            {
              left: 3,
              width: 15,
              bottom: 5,
              height: 20,
              fontColor: "#3c78d8",
              html: "&#10006;",
            },
            {
              left: 0,
              right: 0,
              bottom: 0,
              height: 5,
              backColor: "#3c78d8"
            },
          ];

        }
      }

      if (disableHolidays) {
        const disabled = holidays.find(item => new DayPilot.Date(item.date) === args.cell.start);
        if (disabled) {
          args.cell.properties.disabled = true;
          args.cell.properties.areas = [
            {
              left: 3,
              width: 15,
              bottom: 5,
              height: 20,
              fontColor: "#f1c232",
              html: "&#10006;",
            },
            {
              left: 0,
              right: 0,
              bottom: 5,
              height: 20,
              text: disabled.name,
              horizontalAlignment: "center"
            },
            {
              left: 0,
              right: 0,
              bottom: 0,
              height: 5,
              backColor: "#f1c232"
            },
          ];
        }
      }

      if (disableMaintenance) {
        const disabled = maintenance.find(item => DayPilot.Util.overlaps(args.cell.start, args.cell.end, new DayPilot.Date(item.start), new DayPilot.Date(item.end).addDays(1)));
        if (disabled) {
          args.cell.properties.disabled = true;
          args.cell.properties.areas = [
            {
              left: 3,
              width: 15,
              bottom: 5,
              height: 20,
              fontColor: "#cc4125",
              html: "&#10006;",
            },
            {
              left: 0,
              right: 0,
              bottom: 5,
              height: 20,
              text: "Maintenance",
              horizontalAlignment: "center"
            },
            {
              left: 0,
              right: 0,
              bottom: 0,
              height: 5,
              backColor: "#cc4125"
            },
          ];
        }
      }

    }
  });
  calendar.events.list = [];
  calendar.init();
</script>

    
    <script type="text/javascript">
            
        $(window).on('load', function() {
            
        });
    </script>
    @endsection
@endsection