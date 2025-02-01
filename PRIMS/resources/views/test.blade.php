<x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
function build_calendar($month, $year){

	$mysqli = new mysqli("localhost", "root", "", "laravel");
	$stmt = $mysqli->prepare("SELECT * FROM appointments WHERE MONTH(appointment_date) = ? AND YEAR(appointment_date) = ?");
	$stmt->bind_param("ii", $month, $year);
	$bookings = array();
	if($stmt->execute()){
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$bookings[] = $row['date'];
			}
			$stmt->close();
			return $bookings;
		}
	}
	
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
	$calendar .= "<select name='month' class='form-select form-select-md mx-2 mt-1 mb-3' onchange='document.getElementById(\"calendarForm\").submit();'>";
	for ($m = 1; $m <= 12; $m++) {
		$selected = ($m == $month) ? "selected" : "";
		$calendar .= "<option value='$m' $selected>" . date('F', mktime(0, 0, 0, $m, 1, $year)) . "</option>";
	}
	$calendar .= "</select>";
	
	// **Year Dropdown**
	$calendar .= "<select name='year' class='form-select form-select-md mx-2 mt-1 mb-3' onchange='document.getElementById(\"calendarForm\").submit();'>";
	for ($y = date('Y'); $y <= date('Y') + 5; $y++) { // Range: 5 years back & forward
		$selected = ($y == $year) ? "selected" : "";
		$calendar .= "<option value='$y' $selected>$y</option>";
	}
	$calendar .= "</select>";
	
	$calendar .= "</form></center>";
	
	$calendar .= "<table class='table table-bordered rounded-md'>";
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
	while ($currentDay <= $numberDays) {
		if ($dayOfWeek == 7) {
			$dayOfWeek = 0;
			$calendar .= "</tr><tr>";
		}
		$currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
		$date = "$year-$month-$currentDayRel";
		$today = $date == date('Y-m-d') ? "today" : "";
		$bookedClass = in_array($date, $bookings) ? "booked" : "";

    	// Add data-date attribute to track clicked date
    	$calendar .= "<td class='$today $bookedClass date-cell' data-date='$date'><a href='#' class='full-box'>$currentDay</a></td>";

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

		.full-box {
			justify-content: center;
			text-decoration: none;
			color: inherit;
		}

		td {
			width: 50px; 
			height: 50px; 
			text-align: center;
			position: relative;
		}

		td a {
			position: absolute;
			top: 0.75rem;
			left: 0;
			width: 100%;
			height: 100%;
		}

		td.selected {
			background-color: #4CAF50; /* Green for selected date */
			color: white;
		}

		td.booked {
			background-color: #f44336; /* Red for booked date */
			color: white;
		}

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

	<script>
	document.addEventListener("DOMContentLoaded", function() {
		const dateCells = document.querySelectorAll(".date-cell");

		dateCells.forEach(cell => {
			cell.addEventListener("click", function() {
				// Remove 'selected' class from all other cells
				document.querySelectorAll(".selected").forEach(el => el.classList.remove("selected"));

				// Add 'selected' class to the clicked cell
				this.classList.add("selected");
			});
		});
	});
	</script>

	<div class="grid grid-cols-7 grid-rows-4 gap-4 justify-center m-4">
		<div class="col-span-4 row-span-7 bg-white rounded-md shadow-md justify-center text-center">
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