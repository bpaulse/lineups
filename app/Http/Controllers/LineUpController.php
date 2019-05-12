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


702
12 May 2019

'Weekend Breakfast with Phemelo Motene', '06:00','10:00'
'Soulful Sundays with Kenny Maistry', '10:00','13:00'
'Soulful Sundays with Paul Mtirara', '13:00','16:00'
'Soulful Sundays with Nonn Botha', '16:00','19:00'
'SportsTalk with Buhle Madulini', '19:00','21:00'
'NightTalk with Gushwell Brooks', '21:00','00:00'



INSERT INTO `show`(`timeslot_id`, `show_name`) VALUES (14,'Weekend Breakfast with Phemelo Motene');
INSERT INTO `show`(`timeslot_id`, `show_name`) VALUES (14,'Soulful Sundays with Kenny Maistry');
INSERT INTO `show`(`timeslot_id`, `show_name`) VALUES (14,'Soulful Sundays with Paul Mtirara');
INSERT INTO `show`(`timeslot_id`, `show_name`) VALUES (14,'Soulful Sundays with Nonn Botha');
INSERT INTO `show`(`timeslot_id`, `show_name`) VALUES (14,'SportsTalk with Buhle Madulini');
INSERT INTO `show`(`timeslot_id`, `show_name`) VALUES (14,'NightTalk with Gushwell Brooks');





INSERT INTO `users` (`username`, `firstname`, `lastname`) VALUES ('pmotene','Phemelo','Motene');
INSERT INTO `users` (`username`, `firstname`, `lastname`) VALUES ('kmaistry','Kenny','Maistry');
INSERT INTO `users` (`username`, `firstname`, `lastname`) VALUES ('pmtirara','Paul','Mtirara');
INSERT INTO `users` (`username`, `firstname`, `lastname`) VALUES ('nbotha','Nonn','Botha');
INSERT INTO `users` (`username`, `firstname`, `lastname`) VALUES ('bmadulini','Buhle','Madulini');
INSERT INTO `users` (`username`, `firstname`, `lastname`) VALUES ('gbrooks','Gushwell','Brooks');


WEEKDAYS
2019-05-13
'05:00','06:00' 'Alex Caige'
'06:00','09:00' '947 Breakfast Club with Anele'
'09:00','10:00' '947 Beats @ Work'
'10:00','15:00' 'Ayanda MVP'
'15:00','16:00' '947 Beats @ Work'
'16:00','19:00' 'Afternoon Drive with Greg & Lucky', 'galdridge''Greg Aldridge' 'luckydup', 'Lucky Du Plessis'
'19:00','22:00' 'The Night Show with Zweli & Mantsoe' 'zmbhele','Zweli Mbhele','mpout','Mantsoe Pout'
'22:00','01:00' 'MAC G'
'19:00','22:00' '(Friday) 947 Bloc Party'
SATURDAY
'06:00','10:00' 'Weekend Breakfast with Rob Vember'
'10:00','14:00' 'Coca Cola Top 40 SA with Zweli and Mantsoe'
'14:00','18:00' 'Ayanda MVP'
'18:00','21:00' '947 Bloc Party'
'21:00','01:00' '947 Bloc Party with MAC G'
SUNDAY
'06:00','10:00' 'Weekend Breakfast with Rob Vember'
'10:00','18:00' '947 Love Sundays'
'18:00','20:00' 'eUnite with Euphonik'
'20:00','22:00' 'Karabo Ntshweng'




Weekend Breakfast with Africa
06:00 — 10:00
This is the go-to place to know about the latest fashion, food, trends and everything that is happening in Cape Town.

Solid Gold Sunday
10:00 — 14:00
Saturdays are Solid Gold with a great selection of your favourite golden oldies.

Solid Gold Sunday
14:00 — 17:00
Saturdays are Solid Gold with a great selection of your favourite golden oldies.

Jazz Sessions
17:00 — 19:00
Two hours of local and international Jazz every Sunday with Gary van Dyk.

SportsTalk with Buhle Madulini
19:00 — 21:00
The best bits from the world of sport with comment and conversation that is on point and off the cuff, presented by Buhle Madulini.

Tonight with Lester Kiewit
21:00 — 23:00
Get the best of both worlds with Lester Kiewit, a writer for the Mail & Guardian by day and presenter by night. Rather than looking back at the news of the day, explore new subjects and new perspectives.