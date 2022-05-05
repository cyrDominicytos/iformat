@extends('layouts.app_layouts')

@section('css')
<style>
    td{
        text-align: center;
    }
</style>
@endsection()
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Gestion des actions de formation</h1>
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
                    <li class="breadcrumb-item text-muted text-capitalize">Action de formation</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Liste des actions de formation</li>
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
                <button class="btn btn-sm btn-primary"  id="kt_toolbar_primary_button"  data-bs-toggle="modal" data-bs-target="#create_modal">Ajouter</button>
                <!--end::Button-->
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
                        <h4 class="fw-bolder text-dark">Création de site de formation</h4>
                       
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                           
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
                    <div class="row">
                        <form class="form" action="{{ route('rooms.store')}}" method="post" id="create_modal_from">
                            @csrf   
                            <input type="hidden" name="id" id="old_id"  >   
                            <div class="col-md-12">
                                        
                                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                    <label class="form-label fw-bolder text-dark fs-6 required">Cabinet</label>
                                                    <select name="classrooms_countries_id" aria-label="Selectionnez un profile" data-control="select2" data-placeholder="Attribuer un role..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="classrooms_countries_id">
                                                    @foreach($countries_list as $key=> $list)
                                                        <option value="{{$key}}">{{$list}}</option>
                                                    @endforeach
                                                    </select>
                                                    @if($errors->has('classrooms_countries_id'))
                                                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('classrooms_countries_id')}}</div></div>
                                                    @endif
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-bold mb-2 required">Titre de la formation</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" placeholder="" name="classrooms_name"  type="text" id="classrooms_name" value="<?= old("classrooms_name")	?>" />
                                                    <!--end::Input-->
                                                    @if($errors->has('classrooms_name'))
                                                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('classrooms_name')}}</div></div>
                                                    @endif
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-bold mb-2 required">Sous titre de la formation</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" placeholder="" name="classrooms_name"  type="text" id="classrooms_name" value="<?= old("classrooms_name")	?>" />
                                                    <!--end::Input-->
                                                    @if($errors->has('classrooms_name'))
                                                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('classrooms_name')}}</div></div>
                                                    @endif
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                    <!--end::Label-->
                                                    <label class="fw-bolder text-dark fs-6 mb-2">Objectif</label>
                                                    <!--end::Label-->
                                                    <!--end::Input-->
                                                    <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="classrooms_detail" id="classrooms_detail" ><?= old("classrooms_detail")?></textarea>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                    <!--end::Label-->
                                                    <label class="fw-bolder text-dark fs-6 mb-2">Cibles</label>
                                                    <!--end::Label-->
                                                    <!--end::Input-->
                                                    <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="classrooms_detail" id="classrooms_detail" ><?= old("classrooms_detail")?></textarea>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                    <!--end::Label-->
                                                    <label class="fw-bolder text-dark fs-6 mb-2">Informations supplémentaires</label>
                                                    <!--end::Label-->
                                                    <!--end::Input-->
                                                    <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="classrooms_detail" id="classrooms_detail" ><?= old("classrooms_detail")?></textarea>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                    <label class="form-label fw-bolder text-dark fs-6 required">Jours de formation</label>
                                                    <select name="learnings_days[]" aria-label="Selectionnez les jours de formation" multiple="multiple" data-control="select2" data-placeholder="Ajouter des jours de formaton" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="classrooms_countries_id">
                                                    @foreach($days_list as $key=> $list)
                                                        <option value="{{$key}}">{{$list}}</option>
                                                    @endforeach
                                                    </select>
                                                    @if($errors->has('classrooms_countries_id'))
                                                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('classrooms_countries_id')}}</div></div>
                                                    @endif
                                                </div>
                                                <!--begin::Row-->
                                                <div class="row fv-row " data-select2-id="select2-data-126-fvxd">
                                                    <!--begin::Col-->
                                                    <div class="col-5" data-select2-id="select2-data-125-pfr6">
                                                        <!--begin::Label-->
                                                        <label class="fw-bolder text-dark fs-6 mb-2 required">Début</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid" placeholder="" name="classrooms_name"  type="time" id="classrooms_name" value="<?= old("classrooms_name")	?>" />
                                                        <!--end::Input-->
                                                        @if($errors->has('classrooms_name'))
                                                        <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('classrooms_name')}}</div></div>
                                                        @endif
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-5" data-select2-id="select2-data-125-pfr6">
                                                        <!--begin::Label-->
                                                        <label class="fw-bolder text-dark fs-6 mb-2 required">Fin</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid" placeholder="" name="classrooms_name"  type="time" id="classrooms_name" value="<?= old("classrooms_name")	?>" />
                                                        <!--end::Input-->
                                                        @if($errors->has('classrooms_name'))
                                                        <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('classrooms_name')}}</div></div>
                                                        @endif
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-2">
                                                        <!--begin::Label-->
                                                        <label class="fw-bolder text-dark fs-6"></label>
                                                        <!--end::Label-->
                                                            <!--begin::Button-->
                                                        <button type="button" id="addSlot" class="btn btn-primary mx-auto mt-5 align-bottom" >Ajouter</button>
                                                        <!--end::Button--> 
                                                        </div>
                                                        <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            <!--end::Scroll-->
                                        </div>                                       
                                        <!--begin::Modal footer-->
                                        <div class="modal-footer flex-center">
                                            <!--begin::Button-->
                                            <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-danger" >Quitter</button>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="submit" id="kt_modal_new_address_submit" class="btn btn-primary">
                                                <span class="indicator-label" id="submitText">Enregistrer</span>
                                                <span class="indicator-progress">Patientez...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Modal footer-->
                                    
                            </div>
                        </form>
                    </div>
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" >
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-center text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text-en min-w-100px">Actions</th>
                                <th class="min-w-125px">Heure de Début</th>
                                <th class="min-w-125px">Heure de Fin</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            <!--begin::Table row-->
                            <?= $i=1?>
                            @foreach($learning as $room)
                                <!--begin::Table row-->
                                <tr class="text-center">
                                    <td>
                                        
                                    </td>
                                    <!--end::Action=-->
                                    <td >
                                        {{  $room->classrooms_name }}
                                    </td>
                                    <td>
                                    {{  countries_list()[$room->classrooms_countries_id]  }}
                                    </td>
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
    @section('javascript')
    <script type="text/javascript">
      
        var showModal = "<?= Route::currentRouteName() == '' ? ('') : ('') ?>";
        var base_url = "<?=URL::to('/') ?>";
        var mes = "Etes-vous sûr de vouloir supprimer ce site de formation ?";
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
                            document.location.href=base_url+"/rooms/delete/"+id;
                        }
                });  
            
        }

        function edit(id, country,rowId) {
          /* let table = document.getElementById("kt_table_users");
           document.getElementById("create_modal_from").action = "{{ route('rooms.edit')}}";
           document.getElementById("old_id").value = id;
           document.getElementById("modalTitle").innerHTML = "Mise à jour de site de formation";
           document.getElementById("submitText").innerHTML = "Sauvegarder";
           document.getElementById("classrooms_name").value = table.rows[rowId].cells[1].innerHTML.trim();
           document.getElementById("classrooms_detail").value = table.rows[rowId].cells[3].innerHTML.trim();

           document.getElementById("classrooms_countries_id").value = country;
           document.getElementById("classrooms_countries_id").dispatchEvent(new Event('change'));*/
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