@extends('layouts.app_layouts')

@section('css')
<style>
    td {
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Gestion des évaluations de formation</h1>
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
                    <li class="breadcrumb-item text-muted text-capitalize">Formateurs</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Evaluation à chaud</li>
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
                        <h4 class="fw-bolder text-dark">Evaluer une formation</h4>
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
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
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
                        <form class="form" action="<?= route('listAssessment.store') ?>" method="post" id="create_modal_from">
                            @csrf

                            <div class="col-md-12">
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Formation</label>
                                            <select name="assessments_learning_id" data-control="select2" data-placeholder="Choisissez la formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="assessments_learning_id">
                                                @foreach($learning_list as $key=> $list)
                                                <option value="{{$list->learnings_id}}" <?= old('plannings_learning_id') !== null ? ($list->learnings_id == old('plannings_learning_id') ? 'selected' : '') : '' ?> title="{{$list->learnings_code}} : {{$list->learnings_title2}}">{{$list->learnings_title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('assessments_learning_id'))
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('assessments_learning_id')}}</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" _mstvisible="12">
                                        <!-- <h4 class="fw-bolder text-dark text-center mt-5 mb-5">Liste des formateurs</h4> -->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_slot">
                                            <!--begin::Table head-->
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-center text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-125px">Liste des formateurs</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="text-gray-600 fw-bold">

                                                <tr>
                                                    <td colspan="2" class="text-center">
                                                        <div class="fv-plugins-message-container invalid-feedback text-center">
                                                            <div id="tb_error" data-field="participant" data-validator="notEmpty"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">

                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item custom-accordion-item ">
                                            <h2 class="accordion-header " id="headingOne">
                                                <button class="accordion-button custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mark_a" aria-expanded="true" aria-controls="mark_a">
                                                    Cadre - Méthodologie - Timing
                                                </button>
                                            </h2>
                                            <div id="mark_a" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row" style="padding:20px">
                                                        <div class="col-md-3">
                                                            <strong class="radio-title">Atteinte des objectifs</strong>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="1" class="radio">
                                                            <label for="contactChoice1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="2"  class="radio">
                                                            <label for="contactChoice1" class="radio-label">Moyen</label>

                                                            <input type="radio" id="contactChoice2" name="evaluations_goal_mark" value="3"  class="radio">
                                                            <label for="contactChoice2" class="radio-label">Bien</label>

                                                            <input type="radio" id="contactChoice3" name="evaluations_goal_mark" value="4"  class="radio">
                                                            <label for="contactChoice3" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <strong class="radio-title">Progression pédagogique</strong>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="1" class="radio">
                                                            <label for="contactChoice1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="2"  class="radio">
                                                            <label for="contactChoice1" class="radio-label">Moyen</label>

                                                            <input type="radio" id="contactChoice2" name="evaluations_goal_mark" value="3"  class="radio">
                                                            <label for="contactChoice2" class="radio-label">Bien</label>

                                                            <input type="radio" id="contactChoice3" name="evaluations_goal_mark" value="4"  class="radio">
                                                            <label for="contactChoice3" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <strong class="radio-title">Méthodes d'animation</strong>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="1" class="radio">
                                                            <label for="contactChoice1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="2"  class="radio">
                                                            <label for="contactChoice1" class="radio-label">Moyen</label>

                                                            <input type="radio" id="contactChoice2" name="evaluations_goal_mark" value="3"  class="radio">
                                                            <label for="contactChoice2" class="radio-label">Bien</label>

                                                            <input type="radio" id="contactChoice3" name="evaluations_goal_mark" value="4"  class="radio">
                                                            <label for="contactChoice3" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <strong class="radio-title">Conditions matérielles</strong>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="1" class="radio">
                                                            <label for="contactChoice1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="2"  class="radio">
                                                            <label for="contactChoice1" class="radio-label">Moyen</label>

                                                            <input type="radio" id="contactChoice2" name="evaluations_goal_mark" value="3"  class="radio">
                                                            <label for="contactChoice2" class="radio-label">Bien</label>

                                                            <input type="radio" id="contactChoice3" name="evaluations_goal_mark" value="4"  class="radio">
                                                            <label for="contactChoice3" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <strong class="radio-title">Satisfaction des attentes</strong>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="1" class="radio">
                                                            <label for="contactChoice1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="2"  class="radio">
                                                            <label for="contactChoice1" class="radio-label">Moyen</label>

                                                            <input type="radio" id="contactChoice2" name="evaluations_goal_mark" value="3"  class="radio">
                                                            <label for="contactChoice2" class="radio-label">Bien</label>

                                                            <input type="radio" id="contactChoice3" name="evaluations_goal_mark" value="4"  class="radio">
                                                            <label for="contactChoice3" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <strong class="radio-title">Gestion du temps</strong>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="1" class="radio">
                                                            <label for="contactChoice1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="2"  class="radio">
                                                            <label for="contactChoice1" class="radio-label">Moyen</label>

                                                            <input type="radio" id="contactChoice2" name="evaluations_goal_mark" value="3"  class="radio">
                                                            <label for="contactChoice2" class="radio-label">Bien</label>

                                                            <input type="radio" id="contactChoice3" name="evaluations_goal_mark" value="4"  class="radio">
                                                            <label for="contactChoice3" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <strong class="radio-title">Climat relationnel</strong>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="1" class="radio">
                                                            <label for="contactChoice1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="contactChoice1" name="evaluations_goal_mark" value="2"  class="radio">
                                                            <label for="contactChoice1" class="radio-label">Moyen</label>

                                                            <input type="radio" id="contactChoice2" name="evaluations_goal_mark" value="3"  class="radio">
                                                            <label for="contactChoice2" class="radio-label">Bien</label>

                                                            <input type="radio" id="contactChoice3" name="evaluations_goal_mark" value="4"  class="radio">
                                                            <label for="contactChoice3" class="radio-label">Excellent</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item  custom-accordion-item ">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed  custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mark_b" aria-expanded="false" aria-controls="mark_b">
                                                    Accordion Item #2
                                                </button>
                                            </h2>
                                            <div id="mark_b" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center" style="margin-top: 10px">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-danger me-3" onclick="location.go(-1)">Quitter</button>
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
@section('js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var base_url = "<?= URL::to('/') ?>";
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
        }).then((result) => {
            if (result.value)
                console.log(result.value);
        });
    }

    $(window).on('load', function() {
        document.getElementById("assessments_learning_id").dispatchEvent(new Event('change'));
    });


    //learning change set time slot
    $('#assessments_learning_id').change(function() {

        if ($(this).val() != '') {
            var value = $(this).val();
            //load product code
            $.ajax({
                url: "<?= route('listLearnings.getLearning') ?>",
                type: "POST",
                data: {
                    id: value,
                },
                success: function(result) {
                    if (result != 0) {
                        // $('#learnings_title').val(result.learning['learnings_title']);
                        // $('#learnings_goal').val(result.learning['learnings_goal']);
                        // $('#learnings_target').val(result.learning['learnings_target']);
                        $("table tbody").html(result.teachers);
                        $('#tb_error').html("");
                        $('#submit').prop("disabled", false);

                    } else {
                        $('#tb_error').html("Vous n'avez pas participé à cette formation ou avez été retiré !!!");
                        $('#submit').prop("disabled", true);

                    }
                }
            });


        }
    });

    $("#assessments_value").change(function() {
        let val = $(this).val();
        if (val < 5) {
            $('#mark_text').val("nul");

        } else if (val < 8) {
            $('#mark_text').val("médiocre");

        } else if (val < 10) {
            $('#mark_text').val("Insuffisant");

        } else if (val < 12) {
            $('#mark_text').val("Passable");

        } else if (val < 14) {
            $('#mark_text').val("Assez-Bien");

        } else if (val < 16) {
            $('#mark_text').val("Bien");

        } else if (val < 18) {
            $('#mark_text').val("Très Bien");

        } else {
            $('#mark_text').val("Excellent");
        }

    })
</script>
@endsection
@endsection