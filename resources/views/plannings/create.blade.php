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
                    <li class="breadcrumb-item text-muted text-capitalize">Session de formation</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Liste des sessions de formation</li>
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
                        <h4 class="fw-bolder text-dark">{{ isset($old_planning) ? "Edition" : "Création"}} d'une session de formation</h4>
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
                        <form class="form" action="<?= isset($old_planning) ? route('listPlannings.update') : route('listPlannings.store') ?>" method="post" id="create_modal_from">
                            @csrf   
                            @isset($old_planning):
                                <input type="hidden" name="id" id="old_id" value="{{$old_planning->plannings_id}}">   
                            @endisset
                            
                            <div class="col-md-12">
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Formation</label>
                                            <select name="plannings_learning_id" data-value="{{ isset($old_planning) ? $old_planning->plannings_learning_id : old('plannings_learning_id') }}" data-control="select2" data-placeholder="Choisissez la formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_learning_id">
                                            @foreach($learning_list as $key=> $list)
                                                <option value="{{$list->learnings_id}}">{{$list->learnings_code}}</option>
                                            @endforeach
                                            </select>
                                            @if($errors->has('plannings_learning_id'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="plannings_learning_id" data-validator="notEmpty">{{$errors->first('plannings_learning_id')}}</div></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Site</label>
                                            <select name="plannings_classroom_id" data-value="{{ isset($old_planning) ? $old_planning->plannings_classroom_id : old('plannings_classroom_id') }}" data-control="select2" data-placeholder="Choisissez le site de formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_classroom_id">
                                            @foreach($room_list as $key=> $list)
                                                <option value="{{$list->classrooms_id}}">{{$list->classrooms_name}}</option>
                                            @endforeach
                                            </select>
                                            @if($errors->has('plannings_classroom_id'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="plannings_classroom_id" data-validator="notEmpty">{{$errors->first('plannings_classroom_id')}}</div></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Formateurs</label>
                                            <select name="plannings_teachers[]" multiple="multiple" data-control="select2" data-placeholder="Ajouter les formateurs de cette session" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_teachers">
                                            @if(isset($old_days))
                                                @foreach($teacher_list as $key=> $list)
                                                <option value="{{$teacher_list->id}}" <?= in_array($key, $old_days) ? 'selected' : ''?>>{{$list->first_name.' '.$list->last_name}}</option>
                                                @endforeach
                                            @else
                                                @foreach($teacher_list as $key=> $list)
                                                    <option value="{{$list->id}}" <?= old('learnings_days')!==null ? (in_array($key, old('learnings_days')) ? 'selected' : '') : '' ?>>{{$list->first_name.' '.$list->last_name}}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                            @if($errors->has('plannings_teachers'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('plannings_teachers')}}</div></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Groupes de formation</label>
                                            <select name="plannings_user_groups[]" multiple="multiple" data-control="select2" data-placeholder="Ajouter les groupes de formaton" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_user_groups">
                                            @if(isset($old_days))
                                                @foreach($group_list as $key=> $list)
                                                <option value="{{$list->groups_id}}" <?= in_array($key, $old_days) ? 'selected' : ''?>>{{$list->groups_name}}</option>
                                                @endforeach
                                            @else
                                                @foreach($group_list as $key=> $list)
                                                    <option value="{{$list->groups_id}}" <?= old('learnings_days')!==null ? (in_array($key, old('learnings_days')) ? 'selected' : '') : '' ?>>{{$list->groups_name}}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                            @if($errors->has('plannings_user_groups'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('plannings_user_groups')}}</div></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                    <!--end::Label-->
                                    <label class="fw-bolder text-dark fs-6 mb-2">Informations supplémentaires</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="plannings_infos" id="plannings_infos" ><?= isset($old_planning) ? $old_planning->plannings_infos : old("plannings_infos")?></textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                    <label class="form-label fw-bolder text-dark fs-6 required">Jours de formation</label>
                                    <select name="plannings_days[]" multiple="multiple" data-control="select2" data-placeholder="Ajouter des jours de formaton" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="classrooms_countries_id">
                                        @if(isset($old_days))
                                            @foreach($days_list as $key=> $list)
                                            <option value="{{$key}}" <?= in_array($key, $old_days) ? 'selected' : ''?>>{{$list}}</option>
                                            @endforeach
                                        @else
                                            @foreach($days_list as $key=> $list)
                                                <option value="{{$key}}" <?= old('learnings_days')!==null ? (in_array($key, old('learnings_days')) ? 'selected' : '') : '' ?>>{{$list}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('classrooms_countries_id'))
                                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('classrooms_countries_id')}}</div></div>
                                    @endif
                                </div>
                                <!--begin::Row-->
                                <div class="row fv-row " data-select2-id="select2-data-126-fvxd">
                                    <!--begin::Col-->
                                    <div class="col-6" data-select2-id="select2-data-125-pfr6">
                                        <!--begin::Label-->
                                        <label class="fw-bolder text-dark fs-6 mb-2 required">Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="" name="plannings_date"  type="date" min="<?= date('Y-m-d') ?>" id="plannings_date"  />
                                        <!--end::Input-->
                                        @if($errors->has('plannings_date'))
                                        <div class="fv-plugins-message-container invalid-feedback"><div data-field="plannings_date" data-validator="notEmpty">{{$errors->first('plannings_date')}}</div></div>
                                        @endif
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Heure</label>
                                            <select name="plannings_time_slot" data-value="{{ isset($old_planning) ? $old_planning->plannings_time_slot : old('plannings_time_slot') }}" data-control="select2" data-placeholder="Choisissez l'heure de formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_time_slot">
                                            @foreach($cabinet_list as $key=> $list)
                                                <option value="{{$key}}">{{$list}}</option>
                                            @endforeach
                                            </select>
                                            @if($errors->has('plannings_time_slot'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="plannings_time_slot" data-validator="notEmpty">{{$errors->first('plannings_time_slot')}}</div></div>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--end::Scroll-->
                                </div> 
                                <!--begin::Table-->
                                
                                <!--end::Table--> 
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-danger me-3" data-bs-dismiss="modal">Quitter</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="submit" class="btn btn-primary">
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
        var old_planning = <?php echo isset($old_planning) ? json_encode($old_planning) : (0)  ; ?>;
        var base_url = "<?=URL::to('/') ?>";
      //  var plannings_time_slot1 = document.getElementById("plannings_time_slot1");
      //  var plannings_time_slot2 = document.getElementById("plannings_time_slot2");
      
    function checkSelect() {
        if(plannings_time_slot1.value!=="" && plannings_time_slot2.value!=="")
            return true;
            return false; 
    }

    function checkForm() {
        if(table_unique.length > 0)
            document.getElementById("submit").disabled = false;
        else
            document.getElementById("submit").disabled = true;
    }

    //Information dialog 
        function message_dialog(mes) {
            Swal.fire({
                html: mes,
                icon: "info",
                buttonsStyling: false,
                confirmButtonText: "C'est compris!",
                customClass: {
                    confirmButton: "btn btn-primary",
                }
            }).then((result)=>
                {
                    if(result.value) 
                        console.log(result.value);                         
                });  
        }
       
    $(window).on('load', function()
    {
              checkForm()
            //   if(old_planning!=0){
            //       document.getElementById("submit").disabled = false;
            //   }
    });

    </script>
    @endsection
@endsection