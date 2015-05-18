<?php

namespace core\component\tools;

/**
 * Description of Date
 *
 * @author Thibault
 */
class Date extends \DateTime {
    
    public function _new($date = "") {
        return new Date($date);
    }
    
    public function affiche($format = "full") {
        switch ($format) {
            case 'full':
                return $this->_translate_day()." ".$this->format('d')." ".$this->_translate_month(). " ".$this->format('Y');
                break;

            case 'numeric':
                return $this->format('d')."/".$this->format('m'). "/".$this->format('Y');
                break;
            
           
        }
        
    }
    
    public function _translate_day($day = null) {
        if(is_null($day)) {
            $day = $this->format('l');
        }
        
        switch($day) {
            case "Monday":
                return "Lundi";
            break;
        
            case "Tuesday":
                return "Mardi";
            break;
        
            case "Wednesday":
                return "Mercredi";
            break;
        
            case "Thursday":
                return "Jeudi";
            break;
        
            case "Friday":
                return "Vendredi";
            break;
        
            case "Saturday":
                return "Samedi";
            break;
        
            case "Sunday":
                return "Dimanche";
            break;
        }
    }
    
    public function _translate_month($month = null) {
        if(is_null($month)) {
            $month = $this->format('n');
        }
        
        switch ($month) {
            case 1:
                return "Janvier";
            break;
        
            case 2:
                return "F&eacute;vrier";
            break;
        
            case 3:
                return "Mars";
            break;
        
            case 4:
                return "Avril";
            break;
        
            case 5:
                return "Mai";
            break;
        
            case 6:
                return "Juin";
            break;
        
            case 7:
                return "Juillet";
            break;
        
            case 8:
                return "Ao&ucirc;t";
            break;
        
            case 9:
                return "Septembre";
            break;
        
            case 10:
                return "Octobre";
            break;
        
            case 11:
                return "Novembre";
            break;
        
            case 12:
                return "D&eacute;cembre";
            break;
        }
    }
}
