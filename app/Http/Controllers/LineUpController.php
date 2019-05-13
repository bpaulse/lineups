<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDO;

class LineUpController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// public function lineup($station, $inputDate)
	public function lineup($station, $inputDate)
	{

		// var_dump($inputDate);
		// exit();

		// Please see Readme file

		$stations = DB::select("select * from `station` where `station_name` like '%".$station."%'");

		if ( !isset($stations[0]) ) {
			return "Station desc given does not exist...";
		}

		$station_id = $stations[0]->station_id;

		$timeslotString = "";

		if ( !$this->checkmydate($inputDate) ) {

			if ( $inputDate == 'today' ) {
				$calcData = date('Y-m-d', time());
				$timeslotString = "AND `timeslot`.`timeslot_date` = '" . $calcData . "'";
			} elseif ( $inputDate == 'tomorrow' ) {
				$calcData = date("Y-m-d", strtotime("+1 day"));
				$timeslotString = "AND `timeslot`.`timeslot_date` = '" . $calcData . "'";
			} elseif ( $inputDate == 'yesterday' ) {
				$calcData = date("Y-m-d", strtotime("-1 day"));
				$timeslotString = "AND `timeslot`.`timeslot_date` = '" . $calcData . "'";
			} elseif ( $inputDate == 'all' ) {
				$timeslotString = "";
			} else {
				return "Invalid Date specified...";
			}

		} else {
			$timeslotString = "AND `timeslot`.`timeslot_date` = " . $inputDate;
		}

		$lineups = NULL;


		$sql = "SELECT 
				`station`.`station_name`, 
				`lineup`.`lineup_desc`, 
				`show`.`show_name`, 
				`timeslot`.`timeslot_date`, 
				`users`.`firstname`, 
				`users`.`lastname`, 
				`timespanslot`.`start_time`, 
				`timespanslot`.`end_time`
			FROM `station`
			INNER join `lineup` on `lineup`.`station_id` = `station`.`station_id` 
			INNER JOIN `timeslot` on `timeslot`.`lineup_id` = `lineup`.`lineup_id`
			INNER JOIN `timespanslot` on `timespanslot`.`timespanslot_id` = `timeslot`.`timespanslot_id`
			INNER JOIN `show` on `show`.`show_id` = `timeslot`.`show_id`
			INNER JOIN `show_presenter` ON `show_presenter`.`show_id` = `show`.`show_id`
			INNER JOIN `presenter` ON `presenter`.`presenter_id` = `show_presenter`.`presenter_id`
			INNER JOIN `users` ON `users`.`user_id` = `presenter`.`user_id`
			WHERE `station`.`station_id`= ".$station_id." " . $timeslotString . " ORDER BY `timespanslot`.`start_time` ASC";

		$lineups = DB::select($sql);

		// var_dump($lineups);
		return $lineups;
	}

	public function getDJSlots($period, $name_surnane_str) {

		if ( $period == 'nextweek' ) {

			$startOfWeek = date("Y-m-d", strtotime("next Sunday"));
			$endOfWeek = date("Y-m-d", strtotime("next week Saturday"));

		} elseif ( $period == 'lastweek' ) {

			$subtractDays = 7 + (int)date('w');
			$startOfWeek = date('Y-m-d', strtotime('-'.$subtractDays.' days'));
			$endOfWeek = date("Y-m-d", strtotime("last week Saturday"));


		} elseif ( $period == 'thisweek' ) {

			$today = date("Y-m-d");
			$info = $this->week_range($today);

			$startOfWeek = $info['start'];
			$endOfWeek = $info['end'];

		} else {

			return "Invalid Date specified...";

		} 

		// var_dump($startOfWeek);
		// var_dump($endOfWeek);


		$sql = "SELECT * FROM `show`
		INNER JOIN `timeslot` ON `timeslot`.`show_id` = `show`.`show_id`
		INNER JOIN `timespanslot`ON `timespanslot`.`timespanslot_id` = `timeslot`.`timespanslot_id`
		INNER JOIN `lineup` ON `lineup`.`lineup_id` = `timeslot`.`lineup_id`
		INNER JOIN `station` ON `station`.`station_id` = `lineup`.`station_id`
		INNER JOIN `show_presenter` ON `show_presenter`.`show_id` = `show`.`show_id`
		INNER JOIN `presenter` ON `presenter`.`presenter_id` = `show_presenter`.`presenter_id`
		INNER JOIN `users` ON `users`.`user_id` = `presenter`.`user_id`
		WHERE (`users`.`firstname` LIKE '%".$name_surnane_str."%' OR `users`.`lastname` LIKE '%".$name_surnane_str."%') AND (`timeslot`.`timeslot_date` >= '".$startOfWeek."' AND `timeslot`.`timeslot_date` < '".$endOfWeek."')";

		// var_dump($sql);

		$djlisting = DB::select($sql);

		return $djlisting;

	}

	private function week_range($date) {

		$ts = strtotime($date);
		// $ts = strtotime('2019-05-12');

		$dayOfWeek = date("l", $ts);
		if ( $dayOfWeek == 'Sunday' ) {
			$start = $ts;
		} else {
			$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
		}

		if ( $dayOfWeek == 'Saturday' ) {
			$end = $ts;
		} else {
			$end = strtotime('next saturday', $start);
		}

		$start_date = date('Y-m-d', $start);
		$end_date = date('Y-m-d', $end);

		return array('start' => $start_date, 'end' => $end_date);

	}

	private function checkmydate($dateStr) {
		$hasADash = stripos($dateStr, '-') !== false;

		if ( $hasADash ) {
			if ( substr_count($dateStr, '-') == 2 ) {
				$tempDate = explode('-', $dateStr);
				// checkdate(month, day, year)
				return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
