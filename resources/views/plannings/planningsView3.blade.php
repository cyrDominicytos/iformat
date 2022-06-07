@extends('layouts.app_layouts')
@section('css')
<link href="{{ asset('assets/calendars/themes/peach.css') }}" rel="stylesheet" />
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
        <div id="calendar" style="width: 100%; min-height: 1000px;"></div>
        </div>
    </div>
    <!--end::Post-->
</div>
 <!--end::Content-->
    @section('javascript')
    <script src="{{ asset('assets/calendars/MindFusion.Scheduling.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/calendars/MyFirstSchedule.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
             
        $(window).on('load', function() {
            
        });
    </script>
    @endsection
@endsection