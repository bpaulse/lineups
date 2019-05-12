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
	public function lineup($station, $inputDate)
	{

		// Given the Radio Station and Date

		$stations = DB::select("select * from `station` where `station_name` like '%".$station."%'");

		if ( !isset($stations[0]) ) {
			return "Station desc given does not exist";
		}

		$station_id = $stations[0]->station_id;

		if ( !$this->checkmydate($inputDate) ) {

			if ( $inputDate == 'today' ) {
				$calcData = date('Y-m-d', time());
				var_dump($calcData);
			} elseif ( $inputDate == 'tomorrow' ) {
				$calcData = date("Y-m-d", strtotime("+1 day"));
				var_dump($calcData);
			} elseif ( $inputDate == 'yesterday' ) {
				$calcData = date("Y-m-d", strtotime("-1 day"));
				var_dump($calcData);
			} elseif ( $inputDate == 'nextweek' ) {
				$nextMonday = date("Y-m-d", strtotime("next Monday"));
				$nextFriday = date("Y-m-d", strtotime("next Friday"));
				var_dump($nextMonday);
				var_dump($nextFriday);
			} elseif ( $inputDate == 'lastweek' ) {
				echo date("Y-m-d", strtotime("last week Monday"));
			} else {
				return "";
			}

		}

		var_dump($calcData);
		// DB::setFetchMode(PDO::FETCH_CLASS);

		if ( $this->checkmydate($calcData) ) {

			$sql = "
				SELECT `station`.`station_name`, `lineup`.`lineup_desc`, `show`.`show_name`, `timeslot`.`timeslot_date`, `users`.`firstname`, `users`.`lastname` FROM `station`
				INNER join `lineup` on `lineup`.`station_id` = `station`.`station_id` 
				INNER JOIN `timeslot` on `timeslot`.`lineup_id` = `lineup`.`lineup_id`
				INNER JOIN `timespanslot` on `timespanslot`.`timespanslot_id` = `timeslot`.`timespanslot_id`
				INNER JOIN `show` on `show`.`timeslot_id` = `timeslot`.`timeslot_id`
				INNER JOIN `show_presenter` ON `show_presenter`.`show_id` = `show`.`show_id`
				INNER JOIN `presenter` ON `presenter`.`presenter_id` = `show_presenter`.`presenter_id`
				INNER JOIN `users` ON `users`.`user_id` = `presenter`.`user_id`
				WHERE `station`.`station_id`= ".$station_id." AND `timeslot`.`timeslot_date` = '$calcData'
				ORDER BY `timespanslot`.`start_time` ASC
			";

			var_dump($sql);exit();

			$lineups = DB::select($sql);

		} else  {
			$lineups = NULL;
		}

		var_dump($lineups);

		return $lineups;
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

		// var_dump("hasADash");
		// var_dump($hasADash);
		// return false;

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
