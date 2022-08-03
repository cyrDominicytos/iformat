<?php
use App\Mail\Contact;
use App\Models\CertificationModel;
use App\Models\Chambre;
use App\Models\GroupModel;
use App\Models\LearningModel;
use App\Models\PlanningModel;
use App\Models\PresenceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


if (!function_exists('str_ok')) {

    function str_ok($str) {
        $transliteration = array(
            'Ĳ' => 'I', 'Ö' => 'O','Œ' => 'O','Ü' => 'U','ä' => 'a','æ' => 'a',
            'ĳ' => 'i','ö' => 'o','œ' => 'o','ü' => 'u','ß' => 's','ſ' => 's',
            'À' => 'A','Á' => 'A','Â' => 'A','Ã' => 'A','Ä' => 'A','Å' => 'A',
            'Æ' => 'A','Ā' => 'A','Ą' => 'A','Ă' => 'A','Ç' => 'C','Ć' => 'C',
            'Č' => 'C','Ĉ' => 'C','Ċ' => 'C','Ď' => 'D','Đ' => 'D','È' => 'E',
            'É' => 'E','Ê' => 'E','Ë' => 'E','Ē' => 'E','Ę' => 'E','Ě' => 'E',
            'Ĕ' => 'E','Ė' => 'E','Ĝ' => 'G','Ğ' => 'G','Ġ' => 'G','Ģ' => 'G',
            'Ĥ' => 'H','Ħ' => 'H','Ì' => 'I','Í' => 'I','Î' => 'I','Ï' => 'I',
            'Ī' => 'I','Ĩ' => 'I','Ĭ' => 'I','Į' => 'I','İ' => 'I','Ĵ' => 'J',
            'Ķ' => 'K','Ľ' => 'K','Ĺ' => 'K','Ļ' => 'K','Ŀ' => 'K','Ł' => 'L',
            'Ñ' => 'N','Ń' => 'N','Ň' => 'N','Ņ' => 'N','Ŋ' => 'N','Ò' => 'O',
            'Ó' => 'O','Ô' => 'O','Õ' => 'O','Ø' => 'O','Ō' => 'O','Ő' => 'O',
            'Ŏ' => 'O','Ŕ' => 'R','Ř' => 'R','Ŗ' => 'R','Ś' => 'S','Ş' => 'S',
            'Ŝ' => 'S','Ș' => 'S','Š' => 'S','Ť' => 'T','Ţ' => 'T','Ŧ' => 'T',
            'Ț' => 'T','Ù' => 'U','Ú' => 'U','Û' => 'U','Ū' => 'U','Ů' => 'U',
            'Ű' => 'U','Ŭ' => 'U','Ũ' => 'U','Ų' => 'U','Ŵ' => 'W','Ŷ' => 'Y',
            'Ÿ' => 'Y','Ý' => 'Y','Ź' => 'Z','Ż' => 'Z','Ž' => 'Z','à' => 'a',
            'á' => 'a','â' => 'a','ã' => 'a','ā' => 'a','ą' => 'a','ă' => 'a',
            'å' => 'a','ç' => 'c','ć' => 'c','č' => 'c','ĉ' => 'c','ċ' => 'c',
            'ď' => 'd','đ' => 'd','è' => 'e','é' => 'e','ê' => 'e','ë' => 'e',
            'ē' => 'e','ę' => 'e','ě' => 'e','ĕ' => 'e','ė' => 'e','ƒ' => 'f',
            'ĝ' => 'g','ğ' => 'g','ġ' => 'g','ģ' => 'g','ĥ' => 'h','ħ' => 'h',
            'ì' => 'i','í' => 'i','î' => 'i','ï' => 'i','ī' => 'i','ĩ' => 'i',
            'ĭ' => 'i','į' => 'i','ı' => 'i','ĵ' => 'j','ķ' => 'k','ĸ' => 'k',
            'ł' => 'l','ľ' => 'l','ĺ' => 'l','ļ' => 'l','ŀ' => 'l','ñ' => 'n',
            'ń' => 'n','ň' => 'n','ņ' => 'n','ŉ' => 'n','ŋ' => 'n','ò' => 'o',
            'ó' => 'o','ô' => 'o','õ' => 'o','ø' => 'o','ō' => 'o','ő' => 'o',
            'ŏ' => 'o','ŕ' => 'r','ř' => 'r','ŗ' => 'r','ś' => 's','š' => 's',
            'ť' => 't','ù' => 'u','ú' => 'u','û' => 'u','ū' => 'u','ů' => 'u',
            'ű' => 'u','ŭ' => 'u','ũ' => 'u','ų' => 'u','ŵ' => 'w','ÿ' => 'y',
            'ý' => 'y','ŷ' => 'y','ż' => 'z','ź' => 'z','ž' => 'z','Α' => 'A',
            'Ά' => 'A','Ἀ' => 'A','Ἁ' => 'A','Ἂ' => 'A','Ἃ' => 'A','Ἄ' => 'A',
            'Ἅ' => 'A','Ἆ' => 'A','Ἇ' => 'A','ᾈ' => 'A','ᾉ' => 'A','ᾊ' => 'A',
            'ᾋ' => 'A','ᾌ' => 'A','ᾍ' => 'A','ᾎ' => 'A','ᾏ' => 'A','Ᾰ' => 'A',
            'Ᾱ' => 'A','Ὰ' => 'A','ᾼ' => 'A','Β' => 'B','Γ' => 'G','Δ' => 'D',
            'Ε' => 'E','Έ' => 'E','Ἐ' => 'E','Ἑ' => 'E','Ἒ' => 'E','Ἓ' => 'E',
            'Ἔ' => 'E','Ἕ' => 'E','Ὲ' => 'E','Ζ' => 'Z','Η' => 'I','Ή' => 'I',
            'Ἠ' => 'I','Ἡ' => 'I','Ἢ' => 'I','Ἣ' => 'I','Ἤ' => 'I','Ἥ' => 'I',
            'Ἦ' => 'I','Ἧ' => 'I','ᾘ' => 'I','ᾙ' => 'I','ᾚ' => 'I','ᾛ' => 'I',
            'ᾜ' => 'I','ᾝ' => 'I','ᾞ' => 'I','ᾟ' => 'I','Ὴ' => 'I','ῌ' => 'I',
            'Θ' => 'T','Ι' => 'I','Ί' => 'I','Ϊ' => 'I','Ἰ' => 'I','Ἱ' => 'I',
            'Ἲ' => 'I','Ἳ' => 'I','Ἴ' => 'I','Ἵ' => 'I','Ἶ' => 'I','Ἷ' => 'I',
            'Ῐ' => 'I','Ῑ' => 'I','Ὶ' => 'I','Κ' => 'K','Λ' => 'L','Μ' => 'M',
            'Ν' => 'N','Ξ' => 'K','Ο' => 'O','Ό' => 'O','Ὀ' => 'O','Ὁ' => 'O',
            'Ὂ' => 'O','Ὃ' => 'O','Ὄ' => 'O','Ὅ' => 'O','Ὸ' => 'O','Π' => 'P',
            'Ρ' => 'R','Ῥ' => 'R','Σ' => 'S','Τ' => 'T','Υ' => 'Y','Ύ' => 'Y',
            'Ϋ' => 'Y','Ὑ' => 'Y','Ὓ' => 'Y','Ὕ' => 'Y','Ὗ' => 'Y','Ῠ' => 'Y',
            'Ῡ' => 'Y','Ὺ' => 'Y','Φ' => 'F','Χ' => 'X','Ψ' => 'P','Ω' => 'O',
            'Ώ' => 'O','Ὠ' => 'O','Ὡ' => 'O','Ὢ' => 'O','Ὣ' => 'O','Ὤ' => 'O',
            'Ὥ' => 'O','Ὦ' => 'O','Ὧ' => 'O','ᾨ' => 'O','ᾩ' => 'O','ᾪ' => 'O',
            'ᾫ' => 'O','ᾬ' => 'O','ᾭ' => 'O','ᾮ' => 'O','ᾯ' => 'O','Ὼ' => 'O',
            'ῼ' => 'O','α' => 'a','ά' => 'a','ἀ' => 'a','ἁ' => 'a','ἂ' => 'a',
            'ἃ' => 'a','ἄ' => 'a','ἅ' => 'a','ἆ' => 'a','ἇ' => 'a','ᾀ' => 'a',
            'ᾁ' => 'a','ᾂ' => 'a','ᾃ' => 'a','ᾄ' => 'a','ᾅ' => 'a','ᾆ' => 'a',
            'ᾇ' => 'a','ὰ' => 'a','ᾰ' => 'a','ᾱ' => 'a','ᾲ' => 'a','ᾳ' => 'a',
            'ᾴ' => 'a','ᾶ' => 'a','ᾷ' => 'a','β' => 'b','γ' => 'g','δ' => 'd',
            'ε' => 'e','έ' => 'e','ἐ' => 'e','ἑ' => 'e','ἒ' => 'e','ἓ' => 'e',
            'ἔ' => 'e','ἕ' => 'e','ὲ' => 'e','ζ' => 'z','η' => 'i','ή' => 'i',
            'ἠ' => 'i','ἡ' => 'i','ἢ' => 'i','ἣ' => 'i','ἤ' => 'i','ἥ' => 'i',
            'ἦ' => 'i','ἧ' => 'i','ᾐ' => 'i','ᾑ' => 'i','ᾒ' => 'i','ᾓ' => 'i',
            'ᾔ' => 'i','ᾕ' => 'i','ᾖ' => 'i','ᾗ' => 'i','ὴ' => 'i','ῂ' => 'i',
            'ῃ' => 'i','ῄ' => 'i','ῆ' => 'i','ῇ' => 'i','θ' => 't','ι' => 'i',
            'ί' => 'i','ϊ' => 'i','ΐ' => 'i','ἰ' => 'i','ἱ' => 'i','ἲ' => 'i',
            'ἳ' => 'i','ἴ' => 'i','ἵ' => 'i','ἶ' => 'i','ἷ' => 'i','ὶ' => 'i',
            'ῐ' => 'i','ῑ' => 'i','ῒ' => 'i','ῖ' => 'i','ῗ' => 'i','κ' => 'k',
            'λ' => 'l','μ' => 'm','ν' => 'n','ξ' => 'k','ο' => 'o','ό' => 'o',
            'ὀ' => 'o','ὁ' => 'o','ὂ' => 'o','ὃ' => 'o','ὄ' => 'o','ὅ' => 'o',
            'ὸ' => 'o','π' => 'p','ρ' => 'r','ῤ' => 'r','ῥ' => 'r','σ' => 's',
            'ς' => 's','τ' => 't','υ' => 'y','ύ' => 'y','ϋ' => 'y','ΰ' => 'y',
            'ὐ' => 'y','ὑ' => 'y','ὒ' => 'y','ὓ' => 'y','ὔ' => 'y','ὕ' => 'y',
            'ὖ' => 'y','ὗ' => 'y','ὺ' => 'y','ῠ' => 'y','ῡ' => 'y','ῢ' => 'y',
            'ῦ' => 'y','ῧ' => 'y','φ' => 'f','χ' => 'x','ψ' => 'p','ω' => 'o',
            'ώ' => 'o','ὠ' => 'o','ὡ' => 'o','ὢ' => 'o','ὣ' => 'o','ὤ' => 'o',
            'ὥ' => 'o','ὦ' => 'o','ὧ' => 'o','ᾠ' => 'o','ᾡ' => 'o','ᾢ' => 'o',
            'ᾣ' => 'o','ᾤ' => 'o','ᾥ' => 'o','ᾦ' => 'o','ᾧ' => 'o','ὼ' => 'o',
            'ῲ' => 'o','ῳ' => 'o','ῴ' => 'o','ῶ' => 'o','ῷ' => 'o','А' => 'A',
            'Б' => 'B','В' => 'V','Г' => 'G','Д' => 'D','Е' => 'E','Ё' => 'E',
            'Ж' => 'Z','З' => 'Z','И' => 'I','Й' => 'I','К' => 'K','Л' => 'L',
            'М' => 'M','Н' => 'N','О' => 'O','П' => 'P','Р' => 'R','С' => 'S',
            'Т' => 'T','У' => 'U','Ф' => 'F','Х' => 'K','Ц' => 'T','Ч' => 'C',
            'Ш' => 'S','Щ' => 'S','Ы' => 'Y','Э' => 'E','Ю' => 'Y','Я' => 'Y',
            'а' => 'A','б' => 'B','в' => 'V','г' => 'G','д' => 'D','е' => 'E',
            'ё' => 'E','ж' => 'Z','з' => 'Z','и' => 'I','й' => 'I','к' => 'K',
            'л' => 'L','м' => 'M','н' => 'N','о' => 'O','п' => 'P','р' => 'R',
            'с' => 'S','т' => 'T','у' => 'U','ф' => 'F','х' => 'K','ц' => 'T',
            'ч' => 'C','ш' => 'S','щ' => 'S','ы' => 'Y','э' => 'E','ю' => 'Y',
            'я' => 'Y','ð' => 'd','Ð' => 'D','þ' => 't','Þ' => 'T','ა' => 'a',
            'ბ' => 'b','გ' => 'g','დ' => 'd','ე' => 'e','ვ' => 'v','ზ' => 'z',
            'თ' => 't','ი' => 'i','კ' => 'k','ლ' => 'l','მ' => 'm','ნ' => 'n',
            'ო' => 'o','პ' => 'p','ჟ' => 'z','რ' => 'r','ს' => 's','ტ' => 't',
            'უ' => 'u','ფ' => 'p','ქ' => 'k','ღ' => 'g','ყ' => 'q','შ' => 's',
            'ჩ' => 'c','ც' => 't','ძ' => 'd','წ' => 't','ჭ' => 'c','ხ' => 'k',
            'ჯ' => 'j','ჰ' => 'h' 
            );
            $links = str_replace( array_keys( $transliteration ),
                                array_values( $transliteration ),
                                $str);
                $links = str_replace("°", "_", $links);
                //$links = str_replace("/", "_", $links);
                $links = str_replace(" ", "_", $links);
                $links = str_replace("(", "", $links);
                $links = str_replace(")", "", $links);
                $links = str_replace("[", "", $links);
                $links = str_replace("]", "", $links);
                $links = str_replace("}", "", $links);
                $links = str_replace("{", "", $links);
                 return $links;
    }

}


if (!function_exists('getUser')) {
    function getUser($id) {
       return User::find($id);       
    }

}
if (!function_exists('getGroup')) {

    function getGroup($id) {
       return GroupModel::find($id);       
    }

}



if (!function_exists('roles_list')) {
    function roles_list() {
        
        return  [
            "1"=>"Administrateur",
            "2"=>"Commanditaire",
            "3"=>"Formateur",
            "4"=>"Participant",
            "5"=>"Cabinet",
        ];
    }

}
if (!function_exists('roles_routes')) {
    function roles_routes() {
        
        return  [
            "1"=>"register",
            "2"=>"addSponsor",
            "3"=>"addTeacher",
            "4"=>"addParticipant",
            "5"=>"register",
        ];
    }

}
if (!function_exists('countries_list')) {
    function countries_list() {
        
        return  [
            "1"=>"Cotonou",
            "2"=>"Porto-Novo",
            "3"=>"Parakou",
            "4"=>"Abomey-Calavi",
            "5"=>"Bohicon",
            "6"=>"Abomey",
            "7"=>"Ouidah",
            "8"=>"Lokossa",
            "9"=>"Comé",
            "10"=>"Possotomè",
            "11"=>"Bopa",
            "12"=>"Pobè",
            "13"=>"Kandi",
        ];
    }
}
if (!function_exists('cabinet_list')) {
    function cabinet_list() {
        
        return  [
            "1"=>"WIN AFRICA",
        ];
    }
}
if (!function_exists('days_list')) {
    function days_list() {
        
        return  [
            "0"=>"Dimanche",
            "1"=>"Lundi",
            "2"=>"Mardi",
            "3"=>"Mercredi",
            "4"=>"Jeudi",
            "5"=>"Vendredi",
            "6"=>"Samedi",
        ];
    }
}

if (!function_exists('mark_list')) {
    function mark_list() {
        
        return  [
            "20"=>"Excellent",
            "16"=>"Très bien",
            "14"=>"Bien",
            "10"=>"Passable",
            "10"=>"Insuffisant",
            "5"=>"Médiocre",
            "0"=>"Nul",
        ];
    }
}
if (!function_exists('learning_time_slot')) {
    function learning_time_slot($id) {
        
        $learning_time_slot = LearningModel::find($id);
			$output = '';
            if($learning_time_slot){
                
                $learning_time_slot = json_decode($learning_time_slot->learnings_time_slot, true);
                foreach ($learning_time_slot as $result){
                    $output .= '<option value="'.$result.'">'.$result.'</option>';
                }
            }
			//echo $output;
			return  response()->json($output);

    }
}
if (!function_exists('learning_days')) {
    function learning_days($id) {
        
        $learnings_days = LearningModel::find($id);
			$output = '';
            if($learnings_days){
                
                $learnings_days = json_decode($learnings_days->learnings_days, true);
                foreach ($learnings_days as $result){
                    $output .= '<option value="'.$result.'">'.days_list()[$result].'</option>';
                }
            }
			//echo $output;
			return  response()->json($output);

    }
}

if (!function_exists('get_participant_group')) {
    function get_participant_group($id) {
        
        $model = GroupModel::where("groups_status", 1)->get();
        foreach ($model as $group){
            if(in_array($id, json_decode($group->groups_participant)))
                return  $group;
        }
        return null;

    }
}
if (!function_exists('get_learning_planning_by_group')) {
    function get_learning_planning_by_group($id,$group) {
        
       $model = PlanningModel::where("plannings_status",1)->where("plannings_learning_id",$id)->get();
        foreach ($model as $planning){
            //if(in_array($group, json_decode($planning->plannings_user_groups)))
            if($group==$planning->plannings_user_groups)
                return  $planning;
        }
        return null;

    }
}

if (!function_exists('learning_available_groupe')) {
    function learning_available_groupe($id) {
        
        $planning = PlanningModel::where("plannings_learning_id", $id)->where("plannings_status", 1)->get();
			$output = '';
            $old_groups =array();
            if($planning){
                foreach ($planning as $result){
                   // $old_groups = array_merge($old_groups,json_decode($result->plannings_user_groups));
                    array_push($old_groups,$result->plannings_user_groups);
                }
                $learning_available_groupe = GroupModel::where("groups_status",1)->whereNotIn("groups_id",$old_groups)->get();
               // $learnings_days = json_decode($learnings_days->learnings_days, true);
                foreach ($learning_available_groupe as $result){
                    $output .= '<option value="'.$result->groups_id.'">'.$result->groups_name.'</option>';
                }
            }
			//echo $output;
			return  response()->json($output);

    }
}

if (!function_exists('learning_available_groupe2')) {
    function learning_available_groupe2($id, $session_id, $old_groups1) {
        
        $planning = PlanningModel::where("plannings_learning_id", $id)->whereNotIn("plannings_id", [$session_id])->where("plannings_status", 1)->get();
			$output = '';
            $old_groups =array();
            if($planning){
                foreach ($planning as $result){
                    array_push($old_groups,$result->plannings_user_groups);
                    //$old_groups = array_merge($old_groups,json_decode($result->plannings_user_groups));
                }
                $learning_available_groupe = GroupModel::where("groups_status",1)->whereNotIn("groups_id",$old_groups)->get();
               // $learnings_days = json_decode($learnings_days->learnings_days, true);
              // var_dump($learning_available_groupe);

                foreach ($learning_available_groupe as $result){
                    $output .= '<option value="'.$result->groups_id.'" '.($result->groups_id== $old_groups1 ? ' selected="selected"' : '').'>'.$result->groups_name.'</option>';
                }
            }
			//dd($output);
			return  response()->json($output);

    }
}

if (!function_exists('certif_learning_groups')) {
    function certif_learning_groups($id) {
        
        $planning = PlanningModel::where("plannings_learning_id", $id)->where("plannings_status", 1)->get();
            $output = '';
            if($planning){
                foreach ($planning as $result){
                    //$groups = json_decode($result->plannings_user_groups);
                    $group_id = $result->plannings_user_groups;
                    //foreach ($groups  as $value){
                        $group =  GroupModel::where('groups_id', $group_id)->where('groups_status', 1)->first();
                        $output .= '<option value="'.$group->groups_id.'">'.$group->groups_name.'</option>';
                    // }
                   
                }
            }
			return  response()->json($output);
    }
}
if (!function_exists('planning_list')) {
    function planning_list($id) {
        $userRole = Auth::user()->user_role_id;
        $modelPlan = new PlanningModel();
        if ($userRole == 3) {
             //formateur
             $planning = $modelPlan->get_teachers_learning_planning(Auth::user()->id, $id);
        }else{
            $planning = PlanningModel:: join('classrooms', 'classrooms_id', '=', 'plannings_classroom_id')->where("plannings_learning_id", $id)->where("plannings_status", 1)->get();
        }
        $output = '';
        if($planning){
           // dd(var_dump($planning));
            //$output .= '<option value="">Choisissez un plan</option>'; 

            foreach ($planning as $result){
                $text = $result->plannings_code.' - '.countries_list()[$result->classrooms_countries_id].' - '.$result->classrooms_name;
                $output .= '<option value="'.$result->plannings_id.'" title="'.$text.'">'.$text.'</option>'; 
                //title="{{$list->learnings_code}} : {{$list->learnings_title2}}" >{{$list->learnings_title}}</option>
            }
        }
        return  response()->json($output);
    }
}

if (!function_exists('planning_details_list')) {
    function planning_details_list($id) {
        
        /*$planning = PlanningModel::where("plannings_id", $id)->where("plannings_status", 1)->first();
            $output = '';
            $output1 = '';
            if($planning){
                $date =json_decode($planning->plannings_date);
                $hour =json_decode($planning->plannings_time_slot);
                foreach ($date  as $key => $result){
                    if($result<= date('Y-m-d'))
                        $output1 .= '<option value="'.$result.' de '.$hour[$key].'">'.$result.' de '.$hour[$key].'</option>';
                }

              
                $groups =json_decode($planning->plannings_user_groups);
                foreach ($groups  as $result){
                   $group =  GroupModel::where('groups_id', $result)->where('groups_status', 1)->first();
                   $output .= '<option value="'.$group->groups_id.'">'.$group->groups_name.'</option>';
                }


            }*/
        
            $planning = PlanningModel::join('groups','groups_id', 'plannings_user_groups')->where("plannings_id", $id)->where("plannings_status", 1)->where("groups_status", 1)->first();
            $output = '';
            $output1 = '';
            if($planning){
                $date =json_decode($planning->plannings_date);
                $hour =json_decode($planning->plannings_time_slot);
                foreach ($date  as $key => $result){
                    if($result<= date('Y-m-d'))
                        $output1 .= '<option value="'.$result.' de '.$hour[$key].'">'.format_date($result,"d-m-Y").' de '.$hour[$key].'</option>';
                }

              
                $output .= '<option value="'.$planning->groups_id.'">'.$planning->groups_name.'</option>';
               
            }
			return  response()->json(['groups'=> $output, 'date'=>$output1]);
    }
}
if (!function_exists('group_participant_list')) {
    function group_participant_list($id, $date_time) {
        $datetime = explode(' de ', $date_time);
        $planning = GroupModel::where("groups_id", $id)->where("groups_status", 1)->first();
            $output = '';
            if($planning){
                $old = PresenceModel::where("presences_date", $datetime[0])->where("presences_time_slot", $datetime[1])->where("presences_group_id", $id)->first();
                $groups_participant =json_decode($planning->groups_participant);
                if($old){
                    $old_presence = json_decode($old->presences_participant_list);
                    foreach ($groups_participant  as  $result){
                        $user = User::where("id", $result)->where("status", 1)->first();
                        if($user){
                            $output .= '<tr class="text-center">';
                            $output .= '<td> <input class="participant_checkbox"  name="presences_participant[]"  type="checkbox" value="'.$user->id.'" '.(in_array($user->id,$old_presence) ? "checked" : "").'></td>';
                            $output .= '<td><input hidden name="participant[]"  type="text" value="'.$user->id.'"> '.$user->first_name.' '.$user->last_name.'</td></tr>';
                        }
                    }
                }else{
                    foreach ($groups_participant  as  $result){
                        $user = User::where("id", $result)->where("status", 1)->first();
                        if($user){
                            $output .= '<tr class="text-center">';
                            $output .= '<td> <input class="participant_checkbox"  name="presences_participant[]"  type="checkbox" value="'.$user->id.'"></td>';
                            $output .= '<td><input hidden name="participant[]"  type="text" value="'.$user->id.'"> '.$user->first_name.' '.$user->last_name.'</td></tr>';
                        }
                    }
                }
                
             }
			return  response()->json($output);

    }
}
if (!function_exists('group_participant_list')) {
    function group_participant_list($id, $date_time) {
        $datetime = explode(' de ', $date_time);
        $planning = GroupModel::where("groups_id", $id)->where("groups_status", 1)->first();
            $output = '';
            if($planning){
                $old = PresenceModel::where("presences_date", $datetime[0])->where("presences_time_slot", $datetime[1])->where("presences_group_id", $id)->first();
                $groups_participant =json_decode($planning->groups_participant);
                if($old){
                    $old_presence = json_decode($old->presences_participant_list);
                    foreach ($groups_participant  as  $result){
                        $user = User::where("id", $result)->where("status", 1)->first();
                        if($user){
                            $output .= '<tr class="text-center">';
                            $output .= '<td> <input class="participant_checkbox"  name="presences_participant[]"  type="checkbox" value="'.$user->id.'" '.(in_array($user->id,$old_presence) ? "checked" : "").'></td>';
                            $output .= '<td><input hidden name="participant[]"  type="text" value="'.$user->id.'"> '.$user->first_name.' '.$user->last_name.'</td></tr>';
                        }
                    }
                }else{
                    foreach ($groups_participant  as  $result){
                        $user = User::where("id", $result)->where("status", 1)->first();
                        if($user){
                            $output .= '<tr class="text-center">';
                            $output .= '<td> <input class="participant_checkbox"  name="presences_participant[]"  type="checkbox" value="'.$user->id.'"></td>';
                            $output .= '<td><input hidden name="participant[]"  type="text" value="'.$user->id.'"> '.$user->first_name.' '.$user->last_name.'</td></tr>';
                        }
                    }
                }
                
             }
			return  response()->json($output);

    }
}
if (!function_exists('certify_group_participant_list')) {
    function certify_group_participant_list($id, $learning) {
        $planning = GroupModel::where("groups_id", $id)->where("groups_status", 1)->first();
            $output = '';
            if($planning){
                $old = CertificationModel::where("certifications_learnings_id", $learning)->where("certifications_group_id", $id)->first();
                $groups_participant =json_decode($planning->groups_participant);
                if($old){
                    $old_presence = json_decode($old->certifications_participant_list);
                    foreach ($groups_participant  as  $result){
                        $user = User::where("id", $result)->where("status", 1)->first();
                        if($user){
                            $output .= '<tr class="text-center">';
                            $output .= '<td> <input  name="presences_participant[]"  type="checkbox" value="'.$user->id.'" '.(in_array($user->id,$old_presence) ? "checked" : "").'></td>';
                            $output .= '<td><input hidden name="participant[]"  type="text" value="'.$user->id.'"> '.$user->first_name.' '.$user->last_name.'</td></tr>';
                        }
                    }
                }else{
                    foreach ($groups_participant  as  $result){
                        $user = User::where("id", $result)->where("status", 1)->first();
                        if($user){
                            $output .= '<tr class="text-center">';
                            $output .= '<td> <input  name="presences_participant[]"  type="checkbox" value="'.$user->id.'"></td>';
                            $output .= '<td><input hidden name="participant[]"  type="text" value="'.$user->id.'"> '.$user->first_name.' '.$user->last_name.'</td></tr>';
                        }
                    }
                }
                
             }
			return  response()->json($output);

    }
}

if (!function_exists('generate_learning_code')) {
    function generate_learning_code() {
        
        return  "FORM".LearningModel::max('learnings_id')+1; 
    }
}
if (!function_exists('generate_planning_code')) {
    function generate_planning_code() {
        
        return  "PLAN". PlanningModel::max('plannings_id')+1; 
    }
}
if (!function_exists('generate_presence_code')) {
    function generate_presence_code() {
        
        return  "PRE". PresenceModel::max('presences_id')+1; 
    }
}
if (!function_exists('generate_certif_code')) {
    function generate_certif_code() {
        
        return  "ICDL". CertificationModel::max('certifications_id')+1; 
    }
}
if (!function_exists('no_assign_participants_to_group')) {
    function no_assign_participants_to_group() {
        
        $model = new GroupModel();
        $gorups = $model->get_group_list(1);
        $result = [];
        foreach ($gorups as $group){
            $result = array_merge($result, json_decode($group->groups_participant));
        }
    return $result;
    }
}
if (!function_exists('no_assign_participants_to_group_for_update')) {
    function no_assign_participants_to_group_for_update($id) {
        
        $model = new GroupModel();
        $gorups = $model->get_group_list_for_update(1,$id);
        $result = [];
        foreach ($gorups as $group){
            $result = array_merge($result, json_decode($group->groups_participant));
        }
    return $result;
    }
}

if (!function_exists("deleteUser")) {
	function deleteUser()
	{
		return ("<span class='text-danger'>Supprimer</span>") ; 
       
    }
}



// Function: used to convert a string to revese in order
if (!function_exists("status")) {
	function status($statusId)
	{
		switch ($statusId) {
			case -2:
				return ("<div class='badge badge-danger fw-bolder'>Fermé</div>"); 
			case -1:
				return ("<div class='badge badge-danger fw-bolder'>Supprimé</div>"); 
			case 0:
				return ("<div class='badge badge-danger fw-bolder'>InActif</div>"); 
			case 1:
				return ("<div class='badge badge-success fw-bolder'>Actif</div>"); 
			case 2:
				return ("<div class='badge badge-info fw-bolder'>Réglée</div>"); 
			case 3:
				return ("<div class='badge badge-warning fw-bolder'>Facturée</div>"); 
			case 4:
				return  ("<div class='badge badge-success fw-bolder'>Normalisée</div>"); 
			default:
				return ("<div class='badge badge-danger fw-bolder'>Default status</div>") ; 
		}
	}
}
// Function: used to convert a string to revese in order
if (!function_exists("evaluation_status")) {
	function evaluation_status($statusId)
	{
        if($statusId<2){
            return ("<div class='badge badge-danger fw-bolder'>Mauvais : ".round($statusId,2)."/4</div>"); 
        }else if($statusId <3){
            return ("<div class='badge badge-danger fw-bolder'>Moyen : ".round($statusId,2)."/4</div>"); 
        }else if($statusId<4)
        {
            return ("<div class='badge badge-info fw-bolder'>Bien : ".round($statusId,2)."/4</div>"); 
        }else{
            return  ("<div class='badge badge-success fw-bolder'>Excellent : ".round($statusId,2)."/4</div>"); 
        }
		
	}
}

if (!function_exists('teachers_list')) {
    function teachers_list($list) {
        $output = '';
        if($list)
            foreach ($list  as  $user){
                $output .= '<tr class="text-center">';
                $output .= '<td> '.$user->first_name.' '.$user->last_name.'</td></tr>';
                //return  response()->json($output);
            }
        return  $output;
    }
}

//GET PLANNING TO DISPLAY EVENTS LIST
if (!function_exists('get_events_list')) {
    function get_events_list($result, $beginDate,$endDate) {
        $events = [];
        $eventElements = [];
        if($result){
            foreach($result as $value){
             $date_slots = json_decode($value->plannings_date);
             $time_slots = json_decode($value->plannings_time_slot);
                foreach ($date_slots as $date_key=> $date_value){
                    if($date_value >= $beginDate && $date_value <= $endDate){
                        array_push($eventElements,
                            array(
                            'date'=>  $date_value,
                            'title'=>"<div style='width:100%' title='Cliquer pour avoir plus de détail'><p style='text-align:center; font-weight:bolder; color:white; font-size:15px'>".$time_slots[$date_key]."</p> \n\n ".$value->learnings_title."</div>",
                            'learnTime'=>  $time_slots[$date_key],
                            'learnClass'=> $value->classrooms_name."( ".countries_list()[$value->classrooms_countries_id]." )",
                            'learnText'=> $value->learnings_title,
                            'learnGoal'=> $value->learnings_goal,
                            'learnDesc'=> $value->learnings_infos,
                            'learnGroup'=> implode(", ",GroupModel::where('groups_id',$value->plannings_user_groups)->where('groups_status',1)->pluck('groups_name')->toArray()),

                        )
                            );
                    }
                }

            }
        }
        foreach ($eventElements as $key=>$value){
            if(!array_key_exists($value['date'],$events))
                $events[$value['date']] = [];
            array_push($events[$value['date']],$value );  
           
        }

        return $events;
    }
}

if (!function_exists("format_date")) {
    function format_date($text, $format)
        {
            $date=date_create($text);
            return  date_format($date,$format);
        }
    }

if (!function_exists("mark_honors")) {
    function mark_honors($val)
        {
            if($val<5){
                return "nul";

            }else if($val < 8){
              return  "médiocre";

            }else if($val < 10){
                return  "Insuffisant";

            }else if($val < 12){
                return  "Passable";

            }else if($val < 14){
                return  "Assez-Bien";

            }else if($val < 16){
                return "Bien";

            }else if($val < 18){
                return "Très Bien";

            }else{
                return "Excellent";
            }
        }
    }


    if (!function_exists('disponibilite')) {

    function  disponibilite( $dispo=0)
     {  
         return $dispo==1 ? ("<span class='label label-success'>Disponible</span>") : ("<span class='label label-danger'>Non Disponible</span>");
         
     }
 
 }

if (!function_exists('disponibilite2')) {

    function  disponibilite2( $dispo=0)
     {  
         return $dispo==1 ? ("<span class='label text-success font-weight-bold'>Disponible</span>") : ("<span class='label text-danger font-weight-bold'>Non Disponible</span>"); 
     }
 }

if (!function_exists('mail_queue')) {

    function mail_queue($classEnvoi) {
        try{
            if (app()->environment() == 'local') {
                \Mail::send($classEnvoi->onConnection('sync'));
            }elseif (app()->environment() == 'production') {
                \Mail::queue($classEnvoi->onConnection('sync'));
            }else{
                \Mail::queue($classEnvoi->onConnection('sync'));
            }
        } catch (Exception $ex) {
            \Log::info($ex->getMessage());
        }
    }

}


if (!function_exists('institutions')) {
    function institutions() {
        
        return  [
            "MAEC"=>["name"=>"Ministère des Affaires Etrangères et de la Coopération", "sigle"=>"MAEC"],
            "MAEP"=>["name"=>"Ministère de l'Agriculture, de l'Élevage et de la Pêche", "sigle"=>"MAEP"],
            "MASM"=>["name"=>"Ministère des Affaires Sociales et de la Microfinance", "sigle"=>"MASM"],
            "MCVDD"=>["name"=>"Ministère du Cadre de Vie et du Développement Durable", "sigle"=>"MCVDD"],
            "MDGL"=>["name"=>"Ministère de la Décentralisation et de la Gouvernance Locale", "sigle"=>"MDGL"],
            "MDN"=>["name"=>"Ministère Délégué Auprès du Président de la République, Chargé 
            de la Défense Nationale", "sigle"=>"MDN"],
            "ME"=>["name"=>"Ministère de l’Énergie", "sigle"=>"ME"],
            "MEF"=>["name"=>"Ministère de l'Économie et des Finances", "sigle"=>"MEF"],
            "MEM"=>["name"=>"Ministère de l’Eau et des Mines", "sigle"=>"MEM"],
            "MEMP"=>["name"=>"Ministère des Enseignements Maternel et Primaire", "sigle"=>"MEMP"],
            "MESRS"=>["name"=>"Ministère de l'Enseignement Supérieur et de la Recherche 
            Scientifique", "sigle"=>"MESRS"],
            "MESTFP"=>["name"=>"Ministère des Enseignements Secondaire, Technique et de la 
            Formation Professionnelle", "sigle"=>"MESTFP"],
            "MIC"=>["name"=>"Ministère de l'Industrie et du Commerce", "sigle"=>"MIC"],
            "MISP"=>["name"=>"Ministère de l'Intérieur et de la Sécurité Publique", "sigle"=>"MISP"],
            "MIT"=>["name"=>"Ministère des infrastructures et des Transports", "sigle"=>"MIT"],
            "MJL"=>["name"=>"Ministère de la Justice et de la Législation", "sigle"=>"MJL"],
            "MND"=>["name"=>"Ministère du Numérique et de la Digitalisation", "sigle"=>"MND"],
            "MPD"=>["name"=>"Ministère Chargé du Plan et du Développement", "sigle"=>"MPD"],
            "MPMEPE"=>["name"=>"Ministère des Petites et Moyennes Entreprises et de la Promotion 
            de l'Emploi", "sigle"=>"MPMEPE"],
            "MS"=>["name"=>"Ministère de la Santé", "sigle"=>"MS"],
            "MSp"=>["name"=>"Ministère des Sports", "sigle"=>"MSp"],
            "MTCA"=>["name"=>"Ministère du Tourisme, de la Culture et des Arts", "sigle"=>"MTCA"],
            "MTFP"=>["name"=>"Ministère du Travail et de la Fonction Publique", "sigle"=>"MTFP"],
            "Présidence"=>["name"=>"Présidence", "sigle"=>"Présidence"],
           
        ];
    }
}

if (!function_exists('departments')) {
    function departments() {
        
        return  [
            "Alibori",
            "Atacora",
            "Atlantique",
            "Borgou",
            "Collines",
            "Couffo",
            "Donga",
            "Littoral",
            "Mono",
            "Ouémé",
            "Plateau",
            "Zou",
                       
        ];
    }
}

if (!function_exists('mail_send')) {

function mail_send(String $view_url,  $data, Array $destinataires, String $sujet) {
   $attributes = [
            'view_url' => $view_url,
            'data' => $data,
            'destinataires' => $destinataires,
            'sujet' => $sujet
        ];    
   
   mail_queue(new \App\Mail\CourrielNotifier($attributes)); //  Telescope ne marche pas ici (à trouver pourquoi)
   if (app()->environment() == 'local') {
   return new \App\Mail\CourrielNotifier($attributes); //  Cette partie permet simplement de voir dans telescope en attentant de trouver pourquoi    
   }
   }

}
