@extends('layouts.app_layouts')

@section('css')
<style>
    td {
        text-align: center;
    }

    .acc-body {
        margin: 10px;
    }

    .radio-title {
        margin-top: 10px;
    }

    .radio {
        margin: 10px;
    }

    .radio-label {}
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
                                            <select name="evaluations_learning_id" data-control="select2" data-placeholder="Choisissez la formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="assessments_learning_id">
                                                @foreach($learning_list as $key=> $list)
                                                <option value="{{$list->learnings_id}}" <?= old('plannings_learning_id') !== null ? ($list->learnings_id == old('evaluations_learning_id') ? 'selected' : '') : '' ?> title="{{$list->learnings_code}} : {{$list->learnings_title2}}">{{$list->learnings_title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('evaluations_learning_id'))
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_learning_id')}}</div>
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
                                                    <div class="row acc-body">
                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Atteinte des objectifs 
                                                                @if($errors->has('evaluations_goal_mark'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_goal_mark')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_goal_mark1" name="evaluations_goal_mark" value="1" class="radio">
                                                            <label for="evaluations_goal_mark1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_goal_mark2" name="evaluations_goal_mark" value="2" class="radio">
                                                            <label for="evaluations_goal_mark2" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_goal_mark3" name="evaluations_goal_mark" value="3" class="radio">
                                                            <label for="evaluations_goal_mark3" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_goal_mark4" name="evaluations_goal_mark" value="4" class="radio">
                                                            <label for="evaluations_goal_mark4" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Progression pédagogique
                                                            @if($errors->has('evaluations_progression_mark'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_progression_mark')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_progression_mark1" name="evaluations_progression_mark" value="1" class="radio">
                                                            <label for="evaluations_progression_mark1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_progression_mark2" name="evaluations_progression_mark" value="2" class="radio">
                                                            <label for="evaluations_progression_mark2" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_progression_mark3" name="evaluations_progression_mark" value="3" class="radio">
                                                            <label for="evaluations_progression_mark3" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_progression_mark4" name="evaluations_progression_mark" value="4" class="radio">
                                                            <label for="evaluations_progression_mark4" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Méthodes d'animation
                                                            @if($errors->has('evaluations_method_mark'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_method_mark')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_method_mark1" name="evaluations_method_mark" value="1" class="radio">
                                                            <label for="evaluations_method_mark1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_method_mark2" name="evaluations_method_mark" value="2" class="radio">
                                                            <label for="evaluations_method_mark2" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_method_mark3" name="evaluations_method_mark" value="3" class="radio">
                                                            <label for="evaluations_method_mark3" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_method_mark4" name="evaluations_method_mark" value="4" class="radio">
                                                            <label for="evaluations_method_mark4" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Conditions matérielles
                                                            @if($errors->has('evaluations_material_condition_mark'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_material_condition_mark')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_material_condition_mark1" name="evaluations_material_condition_mark" value="1" class="radio">
                                                            <label for="evaluations_material_condition_mark1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_material_condition_mark2" name="evaluations_material_condition_mark" value="2" class="radio">
                                                            <label for="evaluations_material_condition_mark2" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_material_condition_mark3" name="evaluations_material_condition_mark" value="3" class="radio">
                                                            <label for="evaluations_material_condition_mark3" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_material_condition_mark4" name="evaluations_material_condition_mark" value="4" class="radio">
                                                            <label for="evaluations_material_condition_mark4" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Satisfaction des attentes
                                                            @if($errors->has('evaluations_satisfaction_mark'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_satisfaction_mark')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_satisfaction_mark1" name="evaluations_satisfaction_mark" value="1" class="radio">
                                                            <label for="evaluations_satisfaction_mark1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_satisfaction_mark2" name="evaluations_satisfaction_mark" value="2" class="radio">
                                                            <label for="evaluations_satisfaction_mark2" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_satisfaction_mark3" name="evaluations_satisfaction_mark" value="3" class="radio">
                                                            <label for="evaluations_satisfaction_mark3" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_satisfaction_mark4" name="evaluations_satisfaction_mark" value="4" class="radio">
                                                            <label for="evaluations_satisfaction_mark4" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Gestion du temps
                                                            @if($errors->has('evaluations_time_managment_mark'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_time_managment_mark')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_time_managment_mark1" name="evaluations_time_managment_mark" value="1" class="radio">
                                                            <label for="evaluations_time_managment_mark1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_time_managment_mark2" name="evaluations_time_managment_mark" value="2" class="radio">
                                                            <label for="evaluations_time_managment_mark2" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_time_managment_mark3" name="evaluations_time_managment_mark" value="3" class="radio">
                                                            <label for="evaluations_time_managment_mark3" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_time_managment_mark4" name="evaluations_time_managment_mark" value="4" class="radio">
                                                            <label for="evaluations_time_managment_mark4" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Climat relationnel
                                                            @if($errors->has('evaluations_relational_climat_mark'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_relational_climat_mark')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_relational_climat_mark1" name="evaluations_relational_climat_mark" value="1" class="radio">
                                                            <label for="evaluations_relational_climat_mark1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_relational_climat_mark2" name="evaluations_relational_climat_mark" value="2" class="radio">
                                                            <label for="evaluations_relational_climat_mark2" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_relational_climat_mark3" name="evaluations_relational_climat_mark" value="3" class="radio">
                                                            <label for="evaluations_relational_climat_mark3" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_relational_climat_mark4" name="evaluations_relational_climat_mark" value="4" class="radio">
                                                            <label for="evaluations_relational_climat_mark4" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Supports
                                                            @if($errors->has('evaluations_support_mark'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_support_mark')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_support_mark1" name="evaluations_support_mark" value="1" class="radio">
                                                            <label for="evaluations_support_mark1" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_support_mark2" name="evaluations_support_mark" value="2" class="radio">
                                                            <label for="evaluations_support_mark2" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_support_mark3" name="evaluations_support_mark" value="3" class="radio">
                                                            <label for="evaluations_support_mark3" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_support_mark4" name="evaluations_support_mark" value="4" class="radio">
                                                            <label for="evaluations_support_mark4" class="radio-label">Excellent</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item  custom-accordion-item ">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed  custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mark_b" aria-expanded="false" aria-controls="mark_b">
                                                    Pertinence de la formation
                                                </button>
                                            </h2>
                                            <div id="mark_b" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row acc-body">
                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Le formateur maîtrisait son sujet
                                                            @if($errors->has('evaluations_b1'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_b1')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_b11" name="evaluations_b1" value="1" class="radio">
                                                            <label for="evaluations_b11" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_b12" name="evaluations_b1" value="2" class="radio">
                                                            <label for="evaluations_b12" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_b13" name="evaluations_b1" value="3" class="radio">
                                                            <label for="evaluations_b13" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_b14" name="evaluations_b1" value="4" class="radio">
                                                            <label for="evaluations_b14" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Le formateur a été efficace et a répondu aux questions de manière satisfaisante
                                                            @if($errors->has('evaluations_b2'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_b2')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_b21" name="evaluations_b2" value="1" class="radio">
                                                            <label for="evaluations_b21" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_b22" name="evaluations_b2" value="2" class="radio">
                                                            <label for="evaluations_b22" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_b23" name="evaluations_b2" value="3" class="radio">
                                                            <label for="evaluations_b23" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_b24" name="evaluations_b2" value="4" class="radio">
                                                            <label for="evaluations_b24" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Le formateur a respecté le rythme d’apprentissage des participants
                                                            @if($errors->has('evaluations_b3'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_b3')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_b31" name="evaluations_b3" value="1" class="radio">
                                                            <label for="evaluations_b21" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_b32" name="evaluations_b3" value="2" class="radio">
                                                            <label for="evaluations_b22" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_b33" name="evaluations_b3" value="3" class="radio">
                                                            <label for="evaluations_b23" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_b34" name="evaluations_b3" value="4" class="radio">
                                                            <label for="evaluations_b24" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Cette formation m’a permis d’augmenter mon niveau de connaissance 
                                                            @if($errors->has('evaluations_b4'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_b4')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_b41" name="evaluations_b4" value="1" class="radio">
                                                            <label for="evaluations_b41" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_b42" name="evaluations_b4" value="2" class="radio">
                                                            <label for="evaluations_b42" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_b43" name="evaluations_b4" value="3" class="radio">
                                                            <label for="evaluations_b43" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_b44" name="evaluations_b4" value="4" class="radio">
                                                            <label for="evaluations_b44" class="radio-label">Excellent</label>
                                                        </div>

                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Je recommanderais cette formation à mes collègues de travail
                                                            @if($errors->has('evaluations_b5'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_b5')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_b51" name="evaluations_b5" value="1" class="radio">
                                                            <label for="evaluations_b51" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_b52" name="evaluations_b5" value="2" class="radio">
                                                            <label for="evaluations_b52" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_b53" name="evaluations_b5" value="3" class="radio">
                                                            <label for="evaluations_b53" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_b54" name="evaluations_b5" value="4" class="radio">
                                                            <label for="evaluations_b54" class="radio-label">Excellent</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item  custom-accordion-item ">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed  custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mark_c" aria-expanded="false" aria-controls="mark_b">
                                                    Note globale de la formation
                                                </button>
                                            </h2>
                                            <div id="mark_c" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row acc-body">
                                                        <div class="col-md-7">
                                                            <strong class="radio-title">Veuillez noter cette formation
                                                            @if($errors->has('evaluations_c1'))
                                                                <div class="fv-plugins-message-container invalid-feedback">
                                                                    <div data-field="assessments_learning_id" data-validator="notEmpty">{{$errors->first('evaluations_c1')}}</div>
                                                                </div>
                                                                @endif
                                                            </strong>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="radio" id="evaluations_c11" name="evaluations_c1" value="1" class="radio">
                                                            <label for="evaluations_c11" class="radio-label">Mauvais</label>

                                                            <input type="radio" id="evaluations_c12" name="evaluations_c1" value="2" class="radio">
                                                            <label for="evaluations_c12" class="radio-label">Moyen</label>

                                                            <input type="radio" id="evaluations_c13" name="evaluations_c1" value="3" class="radio">
                                                            <label for="evaluations_c13" class="radio-label">Bien</label>

                                                            <input type="radio" id="evaluations_c14" name="evaluations_c1" value="4" class="radio">
                                                            <label for="evaluations_c14" class="radio-label">Excellent</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item  custom-accordion-item ">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed  custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mark_d" aria-expanded="false" aria-controls="mark_b">
                                                    Appréciations complémentaires et remarques particulières :
                                                </button>
                                            </h2>
                                            <div id="mark_d" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row acc-body">
                                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                                            <!--end::Label-->
                                                            <label class="fw-bolder text-dark fs-6 mb-2">Appréciations/Remarques</label>
                                                            <!--end::Label-->
                                                            <!--end::Input-->
                                                            <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="evaluations_d1" id="evaluations_d1"><?= isset($old_evaluation) ? $old_evaluation->evaluations_d1 : old("evaluations_d1") ?></textarea>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
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