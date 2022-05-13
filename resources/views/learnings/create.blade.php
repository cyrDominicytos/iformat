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
                        <h4 class="fw-bolder text-dark">{{ isset($old_learning) ? "Edition" : "Création"}} de site de formation</h4>
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
                        <form class="form" action="<?= isset($old_learning) ? route('listLearnings.update') : route('listLearnings.store') ?>" method="post" id="create_modal_from">
                            @csrf   
                            @isset($old_learning):
                                <input type="hidden" name="id" id="old_id" value="{{$old_learning->learnings_id}}">   
                            @endisset
                            
                            <div class="col-md-12">
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Cabinet</label>
                                            <select name="learnings_author_id" data-value="{{ isset($old_learning) ? $old_learning->learnings_author_id : old('learnings_author_id') }}" data-control="select2" data-placeholder="Choisissez le cabinet..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="learnings_author_id">
                                            @foreach($cabinet_list as $key=> $list)
                                                <option value="{{$key}}">{{$list}}</option>
                                            @endforeach
                                            </select>
                                            @if($errors->has('learnings_author_id'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="learnings_author_id" data-validator="notEmpty">{{$errors->first('learnings_author_id')}}</div></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" _mstvisible="12">
                                         <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold mb-2 required">Titre de la formation</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="learnings_title"  type="text" id="learnings_title" value="<?= isset($old_learning) ? $old_learning->learnings_title :  old("learnings_title")	?>" />
                                            <!--end::Input-->
                                            @if($errors->has('learnings_title'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="learnings_title" data-validator="notEmpty">{{$errors->first('learnings_title')}}</div></div>
                                            @endif
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">
                                    <div class="col-md-6" _mstvisible="12">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold mb-2 required">Sous titre de la formation</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="learnings_title2"  type="text" id="learnings_title2" value="<?= isset($old_learning) ? $old_learning->learnings_title2 : old("learnings_title2")	?>" />
                                            <!--end::Input-->
                                            @if($errors->has('learnings_title2'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="learnings_title2" data-validator="notEmpty">{{$errors->first('learnings_title2')}}</div></div>
                                            @endif
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-md-6" _mstvisible="12">
                                         <!--begin::Input group-->
                                         <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold mb-2 required">Durée de la formation (en Heure)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="learnings_duration"  type="number" id="learnings_duration" min="1" value="<?=   isset($old_learning) ? $old_learning->learnings_duration : old("learnings_duration")	?>" />
                                            <!--end::Input-->
                                            @if($errors->has('learnings_duration'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="learnings_duration" data-validator="notEmpty">{{$errors->first('learnings_duration')}}</div></div>
                                            @endif
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>                               
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                         <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <!--end::Label-->
                                            <label class="fw-bolder text-dark fs-6 mb-2">Objectif</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="learnings_goal" id="learnings_goal" ><?=  isset($old_learning) ? $old_learning->learnings_goal : old("learnings_goal")?></textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-md-6" _mstvisible="12">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <!--end::Label-->
                                            <label class="fw-bolder text-dark fs-6 mb-2">Cibles</label>
                                            <!--end::Label-->
                                            <!--end::Input-->
                                            <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="learnings_target" id="learnings_target" ><?=  isset($old_learning) ? $old_learning->learnings_target : old("learnings_target")?></textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>                               
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                    <!--end::Label-->
                                    <label class="fw-bolder text-dark fs-6 mb-2">Informations supplémentaires</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="learnings_infos" id="learnings_infos" ><?= isset($old_learning) ? $old_learning->learnings_infos : old("learnings_infos")?></textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                    <label class="form-label fw-bolder text-dark fs-6 required">Jours de formation</label>
                                    <select name="learnings_days[]" multiple="multiple" data-control="select2" data-placeholder="Ajouter des jours de formaton" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="classrooms_countries_id">
                                   
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
                                    @if($errors->has('plannings_days'))
                                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('plannings_days')}}</div></div>
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
                                        <input class="form-control form-control-solid" placeholder="" name="learnings_time_slot1"  type="time" id="learnings_time_slot1"  />
                                        <!--end::Input-->
                                        @if($errors->has('learnings_time_slot1'))
                                        <div class="fv-plugins-message-container invalid-feedback"><div data-field="learnings_time_slot1" data-validator="notEmpty">{{$errors->first('learnings_time_slot1')}}</div></div>
                                        @endif
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-5" data-select2-id="select2-data-125-pfr6">
                                        <!--begin::Label-->
                                        <label class="fw-bolder text-dark fs-6 mb-2 required">Fin</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="" name="learnings_time_slot2"  type="time" id="learnings_time_slot2" />
                                        <!--end::Input-->
                                        @if($errors->has('learnings_time_slot2'))
                                        <div class="fv-plugins-message-container invalid-feedback"><div data-field="learnings_time_slot2" data-validator="notEmpty">{{$errors->first('learnings_time_slot2')}}</div></div>
                                        @endif
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-2">
                                        <!--begin::Label-->
                                        <label class="fw-bolder text-dark fs-6"></label>
                                        <!--end::Label-->
                                        <!--begin::Button-->
                                        <button type="button" id="addSlot" class="btn btn-primary mx-auto mt-5 pt-5 align-bottom" >
                                            <span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
													<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
												</svg>
											</span>
                                        </button>
                                        <!--end::Button--> 
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--end::Scroll-->
                                </div> 
                                <!--begin::Table-->
                                <h4 class="fw-bolder text-dark text-center mt-5 mb-5">Liste des horaires ajoutés</h4>
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_slot" >
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
                                        @isset($old_time_slot)
                                            @foreach($old_time_slot as $value)
                                            <tr class="text-center">
                                                <td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="{{$value}}"><span class="fa fa-minus"></span></button></td>
                                                <td> <input hidden name="learnings_time_slot[]"  type="text" value="{{$value}}">{{ explode( '-', $value )[0]}}</td>
                                                <td>{{ explode( '-', $value )[1]}}</td>
                                            </tr>
                                            @endforeach
                                        @endif                                            	
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
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
        var old_learning = <?php echo isset($old_learning) ? json_encode($old_learning) : (0)  ; ?>;
        var old_time_slot = <?php echo isset($old_time_slot) ? json_encode($old_time_slot) : (0)  ; ?>;
        var base_url = "<?=URL::to('/') ?>";
        var mes = "Etes-vous sûr de vouloir supprimer ce site de formation ?";
        var learnings_time_slot1 = document.getElementById("learnings_time_slot1");
        var learnings_time_slot2 = document.getElementById("learnings_time_slot2");
        var table_unique = [];
        $(document).on('click', '#addSlot', function(){
        if(!checkSelect()){
            message_dialog("Veuillez choisir une heure de début et de fin !")
            return;
        }
        var indexId =  learnings_time_slot1.value+' - '+learnings_time_slot2.value;
        if(table_unique.includes(indexId)){
            //row already exists
        }else{
            //new row
            var val = learnings_time_slot1.value+' - '+learnings_time_slot2.value;
            var html = '';
            html += '<tr class="text-center">';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="'+indexId+'"><span class="fa fa-minus"></span></button></td>';
            html += '<td> <input hidden name="learnings_time_slot[]"  type="text" value="'+val+'">'+learnings_time_slot1.value+'</td>';
            html += '<td>'+learnings_time_slot2.value+'</td></tr>';
            $('#table_slot').append(html);
            table_unique[table_unique.length] = indexId;
            checkForm()
        }
        checkForm()
       });

       $(document).on('click', '.remove', function(){
        var row_index =$(this).closest("tr").index();
        var rowId =  $(this).attr("id");
        table_unique.splice(row_index-1, 1);
        $(this).closest('tr').remove();
        checkForm()
    });

    function checkSelect() {
        if(learnings_time_slot1.value!=="" && learnings_time_slot2.value!=="")
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
              //alert(typeof old_learning)
              if(typeof old_learning!=="number"){
                  table_unique = old_time_slot;
                 // alert(table_unique.length)
                  document.getElementById("submit").disabled = false;
              }else{
                 // alert("toto")
              }
    });

    </script>
    @endsection
@endsection