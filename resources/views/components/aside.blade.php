<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="">
            <img alt="Logo" src="{{ asset('assets/logo/logo.png') }}" class="h-50px logo rounded-circle" style="background-color:rgba(255,255,255,0.1);"/>
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item menu-accordion">
                    <a class="menu-link" href="{{ route('home') }}">
                        <span class="menu-icon">
                            <i class="bi bi-bar-chart-steps fs-3"></i>
                        </span>
                        <span class="menu-title">Tableau de bord</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-sectio text-muted text-uppercase fs-8 ls-1"  style="color: #fff;">Fonctionnalités</span>
                    </div>
                </div>
                <!-- Cabinet, admin -->
                @if(in_array(Auth::user()->user_role_id,[1, 5]))
                <!-- Classrooms -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Sites de formation</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('listRooms') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Consulter liste</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Groups -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Groupes de formation</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('addGroup') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ajouter</span>
                            </a>
                            <a class="menu-link" href="{{ route('listGroups') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Consulter liste</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Actions de formation -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Actions de formation</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('addLearning') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ajouter</span>
                            </a>
                            <a class="menu-link" href="{{ route('listLearnings') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Consulter liste</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Session de formation -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Sessions de formation</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('addPlanning') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ajouter</span>
                            </a>
                            <a class="menu-link" href="{{ route('listPlannings') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Consulter liste</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Presence des participants -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Présence formation</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('addPresence') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ajouter</span>
                            </a>
                            <a class="menu-link" href="{{route('listPresence')  }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Consulter liste</span>
                                </a>
                        </div>
                    </div>
                </div>
                
                <div class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <a class="" href="{{route('getAssessments')}}">
                        <span class="menu-title">Evaluations</span>
                        </a>
                    </span>
                </div>

                <!-- Certification des participants -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Présence certification</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('addExamPresence') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ajouter</span>
                            </a>
                            <a class="menu-link" href="{{route('listExamPresence')  }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Consulter liste</span>
                                </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Certification</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('addCertification') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ajouter</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!-- Admin -->
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-sectio text-muted text-uppercase fs-8 ls-1"  style="color: #fff;">Administration</span>
                        </div>
                    </div>
                    <!-- Cabinet -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-person-plus fs-3"></i>
                            </span>
                            <span class="menu-title">Commanditaires</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item menu-accordion">
                                <a class="menu-link" href="{{ route('addSponsor') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title" >Ajouter</span>
                                </a>
                                <a class="menu-link" href="{{ route('users_list',[2]) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Consulter liste</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Participants -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-user fs-3"></i>
                            </span>
                            <span class="menu-title">Participants</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item menu-accordion">
                                <a class="menu-link" href="{{ route('addParticipant') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title" >Ajouter</span>
                                </a>
                                <a class="menu-link" href="{{ route('users_list',[4]) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Liste</span>
                                </a>
                            </div>
                        </div>
                    </div>							
                    <!-- Teachers -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-user fs-3"></i>
                            </span>
                            <span class="menu-title">Formateurs</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item menu-accordion">
                                <a class="menu-link" href="{{ route('addTeacher') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title" >Ajouter</span>
                                </a>
                                <a class="menu-link" href="{{ route('users_list',[3]) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Liste</span>
                                </a>
                            </div>
                        </div>
                    </div>							
                    <!-- Utilisateur -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-user fs-3"></i>
                            </span>
                            <span class="menu-title">Administrateurs</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item menu-accordion">
                                <a class="menu-link" href="{{ route('addAdmin') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title" >Ajouter</span>
                                </a>
                                <a class="menu-link" href="{{ route('users_list',[1]) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Consulter liste</span>
                                </a>
                            </div>
                        </div>
                    </div>							
                </div>
                @else
                <div class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <a class="" href="{{route('planningsView')}}">
                        <span class="menu-title">Plan</span>
                        </a>
                    </span>
                </div>
                <div class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <a class="" href="{{route('listLearnings')}}">
                        <span class="menu-title">Formations</span>
                        </a>
                    </span>
                </div>
                @if(in_array(Auth::user()->user_role_id,[4]))
                <div class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <a class="" href="{{route('addAssessment')}}">
                        <span class="menu-title">Evaluations</span>
                        </a>
                    </span>
                </div>
                @endif
                @if(Auth::user()->user_role_id != 4)
                <div class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <a class="" href="{{route('listPlannings')}}">
                        <span class="menu-title">Sessions</span>
                        </a>
                    </span>
                </div>
                @endif
                @if(Auth::user()->user_role_id == 2)
                <div class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <a class="" href="{{ route('users_list',[4]) }}">
                        <span class="menu-title">Participants</span>
                        </a>
                    </span>
                </div>
                @endif
                <!-- teachers -->
                @if(in_array(Auth::user()->user_role_id,[3]))                
                <div class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <a class="" href="{{route('getAssessments')}}">
                        <span class="menu-title">Evaluations</span>
                        </a>
                    </span>
                </div>
                <!-- Presence des participants -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Présence formation</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('addPresence') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ajouter</span>
                            </a>
                            <a class="menu-link" href="{{route('listPresence')  }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Consulter liste</span>
                                </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </span>
                        <span class="menu-title">Présence certification</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="{{ route('addExamPresence') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ajouter</span>
                            </a>
                            <a class="menu-link" href="{{route('listExamPresence')  }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Consulter liste</span>
                                </a>
                        </div>
                    </div>
                <!-- Groups -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-cash-coin fs-3"></i>
                            </span>
                            <span class="menu-title">Groupes de formation</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item menu-accordion">
                                <a class="menu-link" href="{{ route('addGroup') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Ajouter</span>
                                </a>
                                <a class="menu-link" href="{{ route('listGroups') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Consulter liste</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <!-- Participants -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-user fs-3"></i>
                            </span>
                            <span class="menu-title">Participants</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item menu-accordion">
                                <a class="menu-link" href="{{ route('addParticipant') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title" >Ajouter</span>
                                </a>
                                <a class="menu-link" href="{{ route('users_list',[4]) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Liste</span>
                                </a>
                            </div>
                        </div>
                    </div>	
                     
                @endif

                @endif
            </div>
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->