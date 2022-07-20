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
                                    <div class="col-md-4" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Formation</label>
                                            <select name="plannings_learning_id" data-control="select2" data-placeholder="Choisissez la formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_learning_id">
                                                @if(isset($old_planning))
                                                    @foreach($learning_list as $key=> $list)
                                                        <option value="{{$list->learnings_id}}" <?= $list->learnings_id==$old_planning->plannings_learning_id ? 'selected' : ''?> title="{{$list->learnings_code}} : {{$list->learnings_title2}}" >{{$list->learnings_title}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($learning_list as $key=> $list)
                                                        <option value="{{$list->learnings_id}}" <?= old('plannings_learning_id')!==null ? ($list->learnings_id==old('plannings_learning_id') ? 'selected' : '') : '' ?> title="{{$list->learnings_code}} : {{$list->learnings_title2}}" >{{$list->learnings_title}}</option>
                                                    @endforeach 
                                                @endif                                           
                                            </select>
                                            @if($errors->has('plannings_learning_id'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="plannings_learning_id" data-validator="notEmpty">{{$errors->first('plannings_learning_id')}}</div></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Site</label>
                                            <select name="plannings_classroom_id" data-control="select2" data-placeholder="Choisissez le site de formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_classroom_id">
                                                @if(isset($old_planning))
                                                    @foreach($room_list as $key=> $list)
                                                        <option value="{{$list->classrooms_id}}"  <?= $list->classrooms_id==$old_planning->plannings_classroom_id ? 'selected' : ''?>>{{$list->classrooms_name}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($room_list as $key=> $list)
                                                        <option value="{{$list->classrooms_id}}"  <?= old('plannings_classroom_id')!==null ? ($list->classrooms_id==old('plannings_classroom_id') ? 'selected' : '' ) : '' ?>>{{$list->classrooms_name}}</option>
                                                    @endforeach
                                                @endif                                                 
                                                </select>
                                                @if($errors->has('plannings_classroom_id'))
                                                <div class="fv-plugins-message-container invalid-feedback"><div data-field="plannings_classroom_id" data-validator="notEmpty">{{$errors->first('plannings_classroom_id')}}</div></div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Groupes de formation</label>
                                            <select name="plannings_user_groups"  data-control="select2" data-placeholder="Ajouter les groupes de formaton" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_user_groups">
                                            @if(isset($old_groups))
                                                @foreach($group_list as $key=> $list)
                                                <option value="{{$list->groups_id}}" <?= $list->groups_id, $old_groups ? 'selected' : ''?>>{{$list->groups_name}}</option>
                                                @endforeach
                                            @else
                                                @foreach($group_list as $key=> $list)
                                                    <option value="{{$list->groups_id}}" <?= old('plannings_user_groups')!==null ? ($list->groups_id==old('plannings_user_groups') ? 'selected' : '') : '' ?>>{{$list->groups_name}}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                            @if($errors->has('plannings_user_groups'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('plannings_user_groups')}}</div></div>
                                            @endif
                                        </div>
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-md-12" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Formateurs</label>
                                            <select name="plannings_teachers[]" multiple="multiple" data-control="select2" data-placeholder="Ajouter les formateurs de cette session" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_teachers">
                                            @if(isset($old_teachers))
                                                @foreach($teacher_list as $key=> $list)
                                                <option value="{{$list->id}}" <?= in_array($list->id, $old_teachers) ? 'selected' : ''?>>{{$list->first_name.' '.$list->last_name}}</option>
                                                @endforeach
                                            @else
                                                @foreach($teacher_list as $key=> $list)
                                                    <option value="{{$list->id}}" <?= old('plannings_teachers')!==null ? (in_array($list->id, old('plannings_teachers')) ? 'selected' : '') : '' ?>>{{$list->first_name.' '.$list->last_name}}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                            @if($errors->has('plannings_teachers'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('plannings_teachers')}}</div></div>
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
                               
                                <!--begin::Row-->
                                <div class="row fv-row " data-select2-id="select2-data-126-fvxd">
                                    <!--begin::Col-->
                                    <div class="col-5" data-select2-id="select2-data-125-pfr6">
                                        <!--begin::Label-->
                                        <label class="fw-bolder text-dark fs-6 mb-2 required">Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="" name="plannings_date1"  type="date" min="<?= date('Y-m-d') ?>" id="plannings_date"  />
                                        <!--end::Input-->
                                        @if($errors->has('plannings_date'))
                                        <div class="fv-plugins-message-container invalid-feedback"><div data-field="plannings_date" data-validator="notEmpty">{{$errors->first('plannings_date')}}</div></div>
                                        @endif
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-5" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Heure</label>
                                            <select name="plannings_time_slot1"  data-control="select2" data-placeholder="Choisissez l'heure de formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_time_slot">
                                           
                                            </select>
                                            @if($errors->has('plannings_time_slot'))
                                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="plannings_time_slot" data-validator="notEmpty">{{$errors->first('plannings_time_slot')}}</div></div>
                                            @endif
                                        </div>
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
                                            <th class="min-w-125px">Date</th>
                                            <th class="min-w-125px">Heure</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-bold">
                                        @isset($old_time_slot)
                                           <?php $old_table_data=[]; ?>
                                            @foreach($old_time_slot as $key=>$value)
                                            <?php $old_table_data[count($old_table_data)]=$old_date[$key].''.$value; ?>
                                            <tr class="text-center">
                                                <td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="{{$old_date[$key].''.$value}}"><span class="fa fa-minus"></span></button></td>
                                                <td> <input hidden name="plannings_date[]"  type="text" value="{{$old_date[$key]}}"> {{ $old_date[$key] }}</td>
                                                <td> <input hidden name="plannings_time_slot[]"  type="text" value="{{$value}}"> {{ $value}}</td>
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
                                <button type="reset"  class="btn btn-danger me-3" onclick="history.go(-1)">Quitter</button>
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
    @section('js')
    <script type="text/javascript">
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        var showModal = "<?= Route::currentRouteName() == '' ? ('') : ('') ?>";
        var old_planning = <?php echo isset($old_planning) ? json_encode($old_planning) : (0)  ; ?>;
        var old_groups = <?php echo  isset($old_groups) ? json_encode($old_groups) : (0)  ; ?>;
        var base_url = "<?=URL::to('/') ?>";
        var learning_time_slot_route = "<?=route('listPlannings.learning_time_slot') ?>";
        var plannings_date1 = document.getElementById("plannings_date");
        var plannings_time_slot1 = document.getElementById("plannings_time_slot");
        var table_unique = [];
        var old_table_data = <?php echo isset($old_table_data) ? json_encode($old_table_data) : (0)  ; ?>;

        $(document).on('click', '#addSlot', function(){
        if(!checkSelect()){
            message_dialog("Veuillez choisir la date et l'heure de la session de formation !")
            return;
        }
        var indexId =  plannings_date1.value+''+plannings_time_slot1.value;
        if(table_unique.includes(indexId)|| table_unique.length==3 ){
            //row already exists
        }else{
            //new row
            var html = '';
            html += '<tr class="text-center">';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" id="'+indexId+'"><span class="fa fa-minus"></span></button></td>';
            html += '<td> <input hidden name="plannings_date[]"  type="text" value="'+plannings_date1.value+'">'+plannings_date1.value+'</td>';
            html += '<td> <input hidden name="plannings_time_slot[]"  type="text" value="'+plannings_time_slot1.value+'">'+plannings_time_slot1.value+'</td></tr>';
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
        if(plannings_date1.value!=="" && plannings_time_slot1.value!=="")
            return true;
            return false; 
    }

    function checkForm() {
       
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
       
           document.getElementById("plannings_learning_id").dispatchEvent(new Event('change'));
              checkForm()
              if(old_planning!=0){
                table_unique = old_table_data;
                document.getElementById("submit").disabled = false;
              }
    });


     //learning change set time slot
     $('#plannings_learning_id').change(function(){
        
        if($(this).val() != '')
        {
            var value = $(this).val();  
            //load product code
            $.ajax({
                url: learning_time_slot_route,
                type:"POST",
                data:{
                    id:value,
                },
              
                success:function(result)
                {
                $('#plannings_time_slot').html(result);
                }
            });

            //load product code
            if(old_planning!=0){
                console.log(value+' '+old_planning['plannings_learning_id'])
               // if(old_planning['plannings_learning_id'] == value){
                    $.ajax({
                        url: "<?=route('listPlannings.learning_available_groupe2') ?>",
                        type:"POST",
                        data:{
                            id:value,
                            session_id:old_planning['plannings_id'],
                            old_groups:old_groups,
                        },
                        success:function(result)
                        {
                        $('#plannings_user_groups').html(result);
                        }
                    });
                    console.log(value+' '+old_planning['plannings_id'])
                // }else{
                //     //update other learning session
                //     $.ajax({
                //         url: "<?=route('listPlannings.learning_available_groupe') ?>",
                //         type:"POST",
                //         data:{
                //             id:value,
                //         },
                //         success:function(result)
                //         {
                //         $('#plannings_user_groups').html(result);
                //         }
                //     });
                //     console.log(2)
                // }
              }else{
                $.ajax({
                    url: "<?=route('listPlannings.learning_available_groupe') ?>",
                    type:"POST",
                    data:{
                        id:value,
                    },
                    success:function(result)
                    {
                    $('#plannings_user_groups').html(result);
                    }
                });
                console.log(3)
              }
            

          
        }
    });




    </script>
    @endsection
@endsection