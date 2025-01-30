<x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
function build_calendar($month, $year){
	
	$daysOfWeek = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
	$numberDays = date('t',$firstDayOfMonth);
	$dateComponents = getdate($firstDayOfMonth);
	$monthName = $dateComponents['month'];
	$dayOfWeek = $dateComponents['wday'];
	$dateToday = date('Y-m-d');
	$prev_month = date('m',mktime(0,0,0,$month-1,1,$year));
	$prev_year = date('Y',mktime(0,0,0,$month-1,1,$year));
	$next_month = date('m',mktime(0,0,0,$month+1,1,$year));
	$next_year = date('Y',mktime(0,0,0,$month+1,1,$year));
	$calendar = "<center><h4 class='bg-prims-yellow-5'>Choose a Date</h4></center>";
	$calendar .= "<form method='GET' id='calendarForm' class='d-inline-flex'>";

	// **Month Dropdown**
	$calendar .= "<select name='month' class='form-select form-select-md mx-2 mt-2' onchange='document.getElementById(\"calendarForm\").submit();'>";
	for ($m = 1; $m <= 12; $m++) {
		$selected = ($m == $month) ? "selected" : "";
		$calendar .= "<option value='$m' $selected>" . date('F', mktime(0, 0, 0, $m, 1, $year)) . "</option>";
	}
	$calendar .= "</select>";
	
	// **Year Dropdown**
	$calendar .= "<select name='year' class='form-select form-select-md mx-2 mt-2' onchange='document.getElementById(\"calendarForm\").submit();'>";
	for ($y = date('Y'); $y <= date('Y') + 5; $y++) { // Range: 5 years back & forward
		$selected = ($y == $year) ? "selected" : "";
		$calendar .= "<option value='$y' $selected>$y</option>";
	}
	$calendar .= "</select>";
	
	$calendar .= "</form></center>";
	
	$calendar .= "<table class='table table-bordered'>";
	$calendar .= "<tr>";
	foreach($daysOfWeek as $day){
		$class = ($day == 'Sun') ? "sunday" : "";
		$calendar .= "<th class='header $class'>$day</th>";
	}

	$calendar .= "</tr><tr>";
	$currentDay = 1;
	if($dayOfWeek > 0){
		for($k=0;$k<$dayOfWeek;$k++){
			$calendar .= "<td class='empty'></td>";
		}
	}

	$month = str_pad($month, 2, "0", STR_PAD_LEFT);
	while($currentDay <= $numberDays){
		if($dayOfWeek == 7){
			$dayOfWeek = 0;
			$calendar .= "</tr><tr>";
		}
		$currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
		$date = "$year-$month-$currentDayRel";
		$dayName = strtolower(date('l', strtotime($date)));
		$today = $date==date('Y-m-d')?"today":"";
		$calendar .= "<td class='$today'><h3>$currentDayRel</h3></td>";
		$currentDay++;
		$dayOfWeek++;
	}

	if($dayOfWeek < 7){
		$remainingDays = 7 - $dayOfWeek;
		for($i=0;$i<$remainingDays;$i++){
			$calendar .= "<td class='empty'></td>";
		}
	}

	$calendar .= "</tr></table>";

	return $calendar;
	
}
?>

	<style>
		table,
		thead,
		tbody,
		th,
		td,

		.row {
			margin-top: 20px;
		}

		.today {
			background: #E7B54D !important;
		}

		.sunday {
			color: red !important;
		}

	</style>
	<div class="grid grid-cols-7 grid-rows-4 gap-4 justify-center m-4">
		<div class="col-span-5 row-span-12 bg-white rounded-md shadow-md justify-center text-center">
			<div class="container items-center">
				<div class="row mt-4">
					<div class="col-md-12 text-center">
						<?php
							$dateComponents = getdate();
							if(isset($_GET['month']) && isset($_GET['year'])){
								$month = $_GET['month'];
								$year = $_GET['year']; 
							}else{
								$month = $dateComponents['mon']; 
								$year = $dateComponents['year']; 
							}

							echo build_calendar($month,$year);

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>