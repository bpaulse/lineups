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
		// Given the Radio Station and Date, 
		// var_dump($station);
		// var_dump($date);

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
			SELECT `show`.`show_id`, `station`.`station_name`,`lineup`.`lineup_desc`,`show`.`show_name`, `timeslot`.`timeslot_date`, `timeslot`.`start_time`, `timeslot`.`end_time`, `users`.`firstname`, `users`.`lastname` FROM `show`
			JOIN `timeslot` ON `timeslot`.`timeslot_id` = `show`.`timeslot_id`
			JOIN `lineup` ON `lineup`.`lineup_id` = `timeslot`.`lineup_id`
			JOIN `station` ON `station`.`station_id` = `lineup`.`station_id`
			JOIN `show_presenter` on `show_presenter`.`show_id` = `show`.`show_id`
			JOIN `presenter` on `show_presenter`.`presenter_id` = `presenter`.`presenter_id`
			JOIN `users` on `users`.`user_id` = `presenter`.`user_id`
			WHERE `station`.`station_name` LIKE '%".$station."%' AND `timeslot`.`timeslot_date` = '".$calcData."'";

			var_dump($sql);exit();

			$lineups = DB::select($sql);

		} else  {
			$lineups = NULL;
		}

		// var_dump($lineups);

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
