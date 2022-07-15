<!--begin::Modal - Create New-->
<div class="modal fade" id="create_modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{ route('rooms.store')}}" method="post" id="create_modal_from">
                @csrf   
            <input type="hidden" name="id" id="old_id"  >   
            <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_new_address_header">
                    <!--begin::Modal title-->
                    <h2 class="text-dark" id="modalTitle">Création de site de formation</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
                         
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold mb-2 required">Désignation</label>
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
                            <label class="form-label fw-bolder text-dark fs-6 required">Départements</label>
                            <select name="classrooms_state" aria-label="Selectionnez un département" data-control="select2" data-placeholder="Sélectionnez un département..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="classrooms_state">
                            @foreach(departments() as $key=> $list)
                                <option value="{{$list}}">{{$list}}</option>
                            @endforeach
                            </select>
                            @if($errors->has('classrooms_state'))
                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name" data-validator="notEmpty">{{$errors->first('classrooms_state')}}</div></div>
                            @endif
                        </div>
                        <!--end::Input group-->
                         <!--begin::Input group-->
                         <div class="d-flex flex-column mb-5 fv-row  text-dark">
                            <label class="form-label fw-bolder text-dark fs-6 required">Villes</label>
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
                             <!--end::Label-->
                             <label class="fw-bolder text-dark fs-6 mb-2">Description</label>
                            <!--end::Label-->
                            <!--end::Input-->
                            <textarea class="form-control form-control-solid" placeholder="Brève description ici..." name="classrooms_detail" id="classrooms_detail" ><?= old("classrooms_detail")?></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-danger me-3" data-bs-dismiss="modal">Quitter</button>
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
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Create New-->