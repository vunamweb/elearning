<?php
global $dir, $navID, $cid;

$schedule = isset($_GET["nid"]) ? $_GET["nid"] : '';

if($schedule) {
	$sql = "SELECT weekdays
			FROM schedules
			WHERE schedule_id='$schedule'
			AND is_online='Y'
			AND valid_to >= '$dat'
			ORDER BY valid_from ";
	$res = safe_query($sql);

	if(mysqli_num_rows($res)>0) {
		$row = mysqli_fetch_object($res);
		$weekdays = $row->weekdays;
		$weekdays = explode(",", $weekdays);
		$w = count($weekdays);
		
		$sql = "SELECT *
			FROM schedule_events
			WHERE schedule_id='$schedule'
			ORDER BY time_start, weekday";
		$res = safe_query($sql);
		
		$output .= '<table class="small table-bordered">
	<thead>
		<tr>
			<th>Uhrzeit</th>
';
		
		for($i=0; $i<$w; $i++) {
			$output .= '			<th class="sp'.($i+1).'">'.tag($weekdays[$i]).'</th>
';
		}
		
		$output .= '		</tr>
	</thead>
';

		$ts = '';
		while ($row = mysqli_fetch_object($res)) {
			// print_r($row);
			
			$tmp = $row->time_start;
			if($tmp != $ts) {
				if($ts) {
					if($x < $w) {
						for($i=$x; $i<$w; $i++) {
							$output .= '			<td class="sp'.($i+1).'"></td>';
						}
					}
					$output .= '		</tr>';
				}

				$x = 0;
				$ts = $tmp;
				$output .= '		<tr>
				<td class="sp0">'.substr($row->time_start,0,5).' - '.substr($row->time_end,0,5).'</td>
';
			}
			
			$x++;
			if($x < $row->weekday) {
				for($i=$x; $i<$row->weekday; $i++) {
					$output .= '			<td class="sp'.$x.'"></td>';
					$x++;
				}
			}
			if($x <= $w && $x == $row->weekday) {
				$upl = "SELECT * FROM uploads WHERE schedule_event_id='".$row->schedule_event_id."' ";
				$rss = safe_query($upl);
				$pdf = '';
				
				if(mysqli_num_rows($rss)>0) {
					$rww = mysqli_fetch_object($rss);
					$pdf = $rww->file_name;
					$pdf = '<a href="/uploads/'.$pdf.'" target="_blank"><i class="fa fa-file-o"></i></a>';				
				}

				$output .= '			<td class="sp'.$x.'">
				<b>'.$row->heading.'</b><br/>
				'.($row->heading == "Pause" ? '' : 'Raum: '.$row->room.'<br/>
				'.$row->description).($pdf ? '<br/>'.$pdf : '').'
			</td>
';			}
/*
			if($OBJ_2->schedule_event_id!='')
				{
				if (mysqli_num_rows($RESULT_3)>0)
					{
					echo "<a href=\"".$show_upload_path.$OBJ_3->file_name."\" target=\"_blank\">";
					echo "<br><img src=\"images/pdf_icon_2.gif\" alt=\"$OBJ_3->file_name\" style=\"margin-top:4px\">";
					echo "</a>";
					}
				}
*/
			elseif($x > $row->weekday) $x=$x-1;
		
		// [heading] => Kirsten Hien [room] => B1 [description] => Kommunikation   [time_start] => 09:00:00 [time_end] => 10:00:00
		}
		
		$output .= '</tr></table>';
	}
}

else {
	$dat = date("y-m-d");
	$sql = "SELECT *
			FROM schedules
			WHERE schedule_id!=''
			AND is_online='Y'
			AND valid_to >= '$dat'
			ORDER BY valid_from ";
// OHNE DATUMS ABFRAGE !!!!!!
	$sql = "SELECT *
			FROM schedules
			WHERE schedule_id!=''
			AND is_online='Y'
			ORDER BY valid_from ";
	$res = safe_query($sql);
	$per = '';
	
	$output .= '
	<table class="table-simple">
';
	
	while ($row = mysqli_fetch_object($res)) {
		$tmp = $row->time_period;
		$per = $tmp != $per ? $tmp : '';
		$lnk = substr( $navID[$cid], 0, strlen($navID[$cid])-1 );
		
		$output .= '
		<tr>
			<td class="width-10"><b>'.$per.'</b></td>
			<td class="width-30">'.euro_dat($row->valid_from).' - '.euro_dat($row->valid_to).' in '.$row->name.'</td>
			<td class="width-20"><a href="'.$dir.$lnk.'-'.$row->schedule_id.'/"><span class="fa fa-user"></span> &nbsp; Stundenplan</a></td>
			<td class="width-30"> &nbsp; </td>
		</tr>
';
	}

	$output .= '	</table>
';
}


?>