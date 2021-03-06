<?php
namespace App\lib;
/**
*@author  Long YU
*@email   lyu@axialys.com
*@description copy de site www.startutorial.com/articles/view/how-to-build-a-web-calendar-in-php
**/
class Calendar {  
     
    /* draws a calendar */
    public static function draw_calendar($month, $year, $color=array()){

        /* draw table */
        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

        /* table headings */
        $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

        /* days and weeks vars now ... */
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();

        /* row for week one */
        $calendar.= '<tr class="calendar-row">';

        /* print "blank" days until the first of the current week */
        for($x = 0; $x < $running_day; $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        endfor;
        /* keep going with days.... */
        for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $day_text = strlen($list_day) == 1 ? '0' . $list_day : $list_day;
            $month_text = strlen($month) == 1 ? '0' . $month : $month;
            $color_text = !empty($color[$year . '-' . $month_text . '-' . $day_text]) ? $color[$year . '-' . $month_text . '-' . $day_text]['color'] : " ";
            $color_id = !empty($color[$year . '-' . $month_text . '-' . $day_text]) ? $color[$year . '-' . $month_text . '-' . $day_text]['id'] : " ";
            $calendar.= '<td class="calendar-day"  style="background-color:' . $color_text . '" data-colorid = "' . $color_id . '" id="' . $color_id . '" data-date="' . $year . '-' . $month_text . '-' . $day_text . '">';
            /* add in the day number */
            $calendar.= '<div class="day-number">'.$list_day.'</div>';

            /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
            $calendar.= str_repeat('<p> </p>',2);
                
            $calendar.= '</td>';
            if($running_day == 6):
                $calendar.= '</tr>';
                if(($day_counter+1) != $days_in_month):
                    $calendar.= '<tr class="calendar-row">';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;

        /* finish the rest of the days in the week */
        if($days_in_this_week < 8):
            for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar.= '<td class="calendar-day-np"> </td>';
            endfor;
        endif;

        /* final row */
        $calendar.= '</tr>';

        /* end the table */
        $calendar.= '</table>';
        
        /* all done, return result */
        return $calendar;
    }
}