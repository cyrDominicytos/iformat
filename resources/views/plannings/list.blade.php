@extends('layouts.app_layouts')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
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
                <span class="total">Total : {{$planning!=null ? count($planning) : 0}}</span>
                @if(in_array(Auth::user()->user_role_id,[1]))
                <!--begin::Button-->
                <a href="{{ route('addPlanning') }}" class="btn btn-sm btn-primary"  id="kt_toolbar_primary_button"  >Ajouter</a>
                <!--end::Button-->
                @endif
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Rechercher" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            @if(in_array(Auth::user()->user_role_id,[1]))
                                <!--begin::Add user-->
                                <a href="{{ route('addPlanning') }}" class="btn btn-primary">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Ajouter</a>
                                <!--end::Add user-->
                            @endif
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text-en min-w-100px">Actions</th>
                                <th class="min-w-125px">Code</th>
                                <th class="min-w-125px">Site</th>
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-125px">Heure</th>
                                <th class="min-w-125px">Formateur (S)</th>
                                <th class="min-w-125px">Groupe</th>
                                <th class="min-w-125px">Formation (S)</th>
                                <th class="min-w-125px">Crée par</th>
                                <th class="min-w-125px">Créé le</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            <!--begin::Table row-->
                            <?= $i=1?>
                            @foreach($planning as $learn)
                                <!--begin::Table row-->
                                    <tr>
                                        <td class="">
                                        @if(in_array(Auth::user()->user_role_id,[1]))
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="<?= route('listPlannings.edit',['id'=>$learn->plannings_id]) ?>"  class="menu-link px-3 text-primary"> Editer</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <p class="menu-link px-3"onclick="deleted(<?=$learn->plannings_id ?>)" ><?= deleteUser(1) ?></p>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                            @endif
                                        </td>
                                        <!--end::Action=-->
                                        <td class="">
                                           {{ $learn->plannings_code }}
                                        </td>
                                       
                                        <td class="">
                                        {{  $learn->classrooms_name." :  ".countries_list()[$learn->classrooms_countries_id]}}
                                        </td>
                                       
                                        <td class="">
                                            @if($learn->plannings_date)
                                            <ul>
                                                @foreach(json_decode($learn->plannings_date) as $value)
                                                <li>
                                                   {{format_date($value , "d/m/Y")}} 
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </td>
                                        <td class="">
                                        @if($learn->plannings_time_slot)
                                            <ul>
                                                @foreach(json_decode($learn->plannings_time_slot) as $value)
                                                <li>
                                                   {{$value}} 
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                       
                                        </td>
                                        <td class="">
                                        @if($learn->plannings_teachers)
                                            <ul>
                                                @foreach(json_decode($learn->plannings_teachers) as $value)
                                                <li>
                                                   {{getUser($value)->first_name." ".getUser($value)->last_name}} 
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                       
                                        </td>
                                        <td class="">
                                        {{ $learn->groups_name }}

                                        </td>
                                        <td> 
                                        {{  $learn->learnings_title }}
                                       </td>
                                        <td> 
                                        {{  $learn->plannings_user_updated_by.' '.$learn->plannings_user_updated_by }}
                                       </td>
                                        <td><?= format_date($learn->plannings_created_at , "d/m/Y à H:i:s")  ?></td>
                                    </tr>
                                    <!--end::Table row-->	
                                    <?= $i++?>
                                @endforeach						
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
 <!--end::Content-->
    @section('js')
    <script type="text/javascript">
      
        var showModal = "<?= Route::currentRouteName() == '' ? ('') : ('') ?>";
        var base_url = "<?=URL::to('/') ?>";
        var mes = "Etes-vous sûr de vouloir supprimer cette session de formation ?";
        function deleted(id) {
             Swal.fire({
                html: mes,
                icon: "warning" ,
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "J'en suis certain!",
                cancelButtonText: "Non, J'abandonne.",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result)=>
                {
                    if(result.value) 
                        {
                            document.location.href=base_url+"/listPlannings/delete/"+id;
                        }
                });  
            
        }

      
       
        $(window).on('load', function() {
            // if(showModal == 1)
            //      $('#external_create_new').modal('show');
    });

    function updateCategory(category) {
           
    }
    </script>
    @endsection
@endsection