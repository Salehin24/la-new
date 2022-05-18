
<?php 
  $year = date('Y');
  $numbery = date('y');
  $prevyear = $numbery - 1;
  $prevyearformat = $year - 1;
  
?>
<input type="hidden" id="charttype" value="<?php  echo $student_time_filter['type'];?>">
<script>
// $('document').ready(function(){
//     var charttype=$("charttype").val();
//     alert(charttype);
// });

    var charttype=$("#charttype").val();
    if(charttype==1){
		// Bar CHart

		var ctx = document.getElementById("myChart4").getContext('2d');
        if (myChart) myChart.destroy();
		var myChart = new Chart(ctx, {
			type: 'bar',
            label: 'Demo',
			data: {
                <?php 
                $list='';
                $qdat = array();
                for($i = 6; $i >= 0; $i--)
                {
                        $dateValue = date("Y-m-d", strtotime("-$i days"));
                        $time=strtotime($dateValue);
                        $date_m=date("m",$time);
                        $date_y=date("Y",$time);
                        $day=date("d",$time);
                        
                        $date = $day."-".$date_m."-".$date_y;
                        $qdat[] = $date_y."-".$date_m."-".$day;

                        // $list.= "'"."" . $date ."'". ",";
                        $list.= "'"."" . date('d '.'M' ,$time) ."'". ",";
                    
                }
                $color=[
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#caf270','#45c490',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#45c490',

                ];
                $query=$this->db->select('daily_watch_time_tbl.*,course_tbl.name')
                                    ->from('daily_watch_time_tbl')
                                    ->join('course_tbl ', 'course_tbl.course_id = daily_watch_time_tbl.course_id', 'left')
                                    ->where_in('daily_watch_time_tbl.date',$qdat)
                                    ->where('daily_watch_time_tbl.student_id',$student_time_filter['user_id'])
                                    ->where('daily_watch_time_tbl.enterprise_id',$student_time_filter['enterprise_id'])
                                    ->group_by('daily_watch_time_tbl.course_id')
                                    ->get()
                                    ->result();
                
                ?>
                labels: [<?php echo $list?>],

                    datasets: [
                        <?php foreach($query as $key=>$cname){ 
                            $count='';
                            for($i=0; 6>=$i; $i++) {
                                $date = $qdat[$i];
                                $rw=$this->db->select('sum(studentwatchTime) as todaywatchtime')
                                ->from('daily_watch_time_tbl')
                                ->where('date',$date)
                                ->where('course_id',$cname->course_id)
                                ->get()->row();


                                // $count.=($rw->todaywatchtime?$rw->todaywatchtime:'0').',';
                                //  $init = $rw->todaywatchtime;
                                // $hours = floor($init / 3600);
                                // $minutes = floor(($init / 60) % 60);
                                // $seconds = $init % 60;
                                 /*** number of days ***/
                                 
                                 $minutes = floor ($rw->todaywatchtime / 60);
                                //$count.= "$hours:$minutes:$seconds".',';
                                $count.= "$minutes".',';
                                
                            }
                        ?>
                            {
                                label: '<?php echo $cname->name;?>',
                                backgroundColor: "<?php echo $color[$key]?>",
                                data: [<?php echo rtrim($count,',')?>],
                            },
                        <?php } ?>
			        ],
			},

			options: {
				tooltips: {
					displayColors: true,
					// callbacks: {
					// 	mode: 'x',
					// },
                    callbacks: {
                        mode: 'x',
                        afterBody: function(t, d) {
                            return 'Minutes';  // return a string that you wish to append
                        },
                        // use label callback to return the desired label
                        //  label: function(tooltipItem, data) {
                        //     // alert(tooltipItem.xLabel);
                        // //    return tooltipItem.xLabel + " :" + tooltipItem.yLabel;
                        //     return ;
                        // },
                    // remove title
                    title: function(tooltipItem, data) {
                     return ;
                    }
                }
                
                    
				},
				scales: {
					xAxes: [{
						stacked: true,
						gridLines: {
							display: false,
						},

					}],
					yAxes: [{
						stacked: true,
						ticks: {
							beginAtZero: true,
                            userCallback: function(value, index, values) {
                                // Convert the number to a string and splite the string every 3 charaters from the end
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);
                                // Convert the array to a string and format the output
                                value = value.join('.');
                                return  value +" "+'Min';
                            }
						},
                        
						type: 'linear',
                        scaleLabel: {
                            display: true,
                            labelString: 'Watch minutes'
                        },
                        
                        displayValueAxis: true,
					}]
				},
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					// position: 'bottom'
					position: false
				},
			}
		});
    }else if(charttype==2){

        if (myChart) myChart.destroy();

	// Bar CHart
    var ctx = document.getElementById("myChart4").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
            label: 'Demo',
			data: {
                <?php 
                  $months ="";
                  $year = date('Y');
                  $numbery = date('y');
                  $prevyear = $numbery - 1;
                  $prevyearformat = $year - 1;
                  $syear = '';
                  $month =[];
                  $ymonth=[];
                  $syearformat = array();
                  for ($k = 1; $k < 13; $k++) {
                    $mm=$k-1;
                    $month[] = date('m', strtotime("+$mm month"));
                    $ymonth[] = date('m', strtotime("+$k month"));
                      $gety = date('y', strtotime("+$mm month"));
                      if ($gety == $numbery) {
                          $syear = $prevyear;
                         $syearformat = $prevyearformat;
                      } else {
                          $syear = $numbery;
                          $syearformat = $year;
                      }
                      $months.= "'" . date('M-' . $syear, strtotime("+$mm month")) . "',";
                    //   print_r($month);
                  }

                 
                $color=[
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#caf270','#45c490',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#45c490',

                ];
                // $query=$this->db->select('daily_watch_time_tbl.*,course_tbl.name,sum(studentwatchTime) as todaywatchtime')
                $query=$this->db->select('daily_watch_time_tbl.*,course_tbl.name')
                ->from('daily_watch_time_tbl')
                ->join('course_tbl ', 'course_tbl.course_id = daily_watch_time_tbl.course_id', 'left')
                ->where_in('MONTH(date)', $month)
                ->where('YEAR(date)',$syearformat)
                ->where('daily_watch_time_tbl.student_id',$student_time_filter['user_id'])
                ->where('daily_watch_time_tbl.enterprise_id',$student_time_filter['enterprise_id'])
                // ->group_by('MONTH(date)')
                ->group_by('daily_watch_time_tbl.course_id')
                ->get()
                ->result();
                ?>
                labels: [<?php echo $months?>],

                    datasets: [
                        <?php 
                        //$count='';
                        foreach($query as $key=>$cname){

                            $count='';
                            
                             for ($k = 1; $k < 13; $k++) {
                                 $mm= $k - 1;
                                $yrmonth = date('m', strtotime("+$mm month"));
                                $rw=$this->db->select('IFNULL(SUM(a.studentwatchTime), 0) as todaywatchtimes,a.course_id as m,a.date,b.*')
                                ->from('daily_watch_time_tbl a')
                                ->join('course_tbl b', 'b.course_id = a.course_id', 'left')
                                ->where('YEAR(a.date)',$syearformat)
                                ->where('MONTH(a.date)',$yrmonth)
                                ->where('a.course_id',$cname->course_id)
                                ->group_by('a.course_id')
                                ->get()->row();
                                 $minutes = (@$rw->todaywatchtimes?@$rw->todaywatchtimes:0) / 60;
                                 $output = number_format($minutes,2);
                                 $count.= "$output".',';
                     
                                ?>
                                
                        <?php    
                         }
                          
                        ?>
                            {
                                label: '<?php echo $cname->name;?>',
                                backgroundColor: "<?php echo $color[$key]?>",
                                data: [<?php echo rtrim($count,',')?>],
                            },
                        <?php } ?>
			        ],
			},

			options: {
				tooltips: {
					displayColors: true,
					// callbacks: {
					// 	mode: 'x',
					// },
                    callbacks: {
                        mode: 'x',
                        afterBody: function(t, d) {
                            return 'Minutes';  // return a string that you wish to append
                        },
                        // use label callback to return the desired label
                        //  label: function(tooltipItem, data) {
                        //     // alert(tooltipItem.xLabel);
                        // //    return tooltipItem.xLabel + " :" + tooltipItem.yLabel;
                        //     return ;
                        // },
                    // remove title
                    title: function(tooltipItem, data) {
                     return ;
                    }
                }
                
                    
				},
				scales: {
					xAxes: [{
						stacked: true,
						gridLines: {
							display: false,
						},

					}],
					yAxes: [{
						stacked: true,
						ticks: {
							beginAtZero: true,
                            userCallback: function(value, index, values) {
                                // Convert the number to a string and splite the string every 3 charaters from the end
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);
                                // Convert the array to a string and format the output
                                value = value.join('.');
                                return  value +" "+'Min';
                            }
						},
                        
						type: 'linear',
                        scaleLabel: {
                            display: true,
                            labelString: 'Watch minutes'
                        },
                        
                        displayValueAxis: true,
					}]
				},
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					// position: 'bottom'
					position: false
				},
			}
		});


       
    }else if(charttype==3){
        // Bar CHart
    if (myChart) myChart.destroy();
    var ctx = document.getElementById("myChart4").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
            label: 'Demo',
			data: {
                <?php 
                    $lastday=date("t", strtotime("last day of previous month"));
                    $previousmonth= date("Y-m", strtotime("-1 month"));
                    $listday='';
                    $pdate=[];
                  for ($k = 1; $k <=$lastday; $k++) {
                      $pdate[] = date($previousmonth.'-'.$k, strtotime("$k days"));
                      $datem = date($previousmonth.'-'.$k, strtotime("$k days"));
                      $time=strtotime($datem);
                      $listday.= "'"."" . date('d '.'M' ,$time) ."'". ",";
                  }
 

                $color=[
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#caf270','#45c490',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#2e5468',
                    '#caf270','#45c490',
                    '#008d93','#45c490',

                ];
                // $query=$this->db->select('daily_watch_time_tbl.*,course_tbl.name')
                // ->from('daily_watch_time_tbl')
                // ->join('course_tbl ', 'course_tbl.course_id = daily_watch_time_tbl.course_id', 'left')
                // ->where_in('MONTH(date)', $month)
                // ->where('YEAR(date)',$syearformat)
                // ->where('daily_watch_time_tbl.student_id',$student_time_filter['user_id'])
                // ->where('daily_watch_time_tbl.enterprise_id',$student_time_filter['enterprise_id'])
                // ->group_by('daily_watch_time_tbl.course_id')
                // ->get()
                // ->result();

                $query=$this->db->select('daily_watch_time_tbl.*,course_tbl.name')
                ->from('daily_watch_time_tbl')
                ->join('course_tbl ', 'course_tbl.course_id = daily_watch_time_tbl.course_id', 'left')
                ->where_in('daily_watch_time_tbl.date',$pdate)
                ->where('daily_watch_time_tbl.student_id',$student_time_filter['user_id'])
                ->where('daily_watch_time_tbl.enterprise_id',$student_time_filter['enterprise_id'])
                ->group_by('daily_watch_time_tbl.course_id')
                ->get()
                ->result();
                
                ?>
                labels: [<?php echo $listday?>],

                    datasets: [
                        <?php 
                        //$count='';
                        foreach($query as $key=>$cname){
                            $count='';
                            for ($sl = 0; $sl <=$lastday; $sl++) {
                                $date = @$pdate[$sl];
                                $rw=$this->db->select('sum(studentwatchTime) as todaywatchtime')
                                ->from('daily_watch_time_tbl')
                                ->where('date',$date)
                                ->where('course_id',$cname->course_id)
                                ->get()->row();
                                $minutes = (@$rw->todaywatchtime?@$rw->todaywatchtime:0) / 60;
                                $output = number_format($minutes,1);
                                $count.= "$output".',';

                                // print_r( $count);
                                // print_r($rw->todaywatchtime);
                                ?>
                                <?php    
                                }
                                
                                ?>
                            {
                                label: '<?php echo $cname->name;?>',
                                backgroundColor: "<?php echo $color[$key]?>",
                                data: [<?php echo rtrim($count,',')?>],
                            },
                        <?php } ?>
			        ],
			},

			options: {
				tooltips: {
					displayColors: true,
					// callbacks: {
					// 	mode: 'x',
					// },
                    callbacks: {
                        mode: 'x',
                        afterBody: function(t, d) {
                            return 'Minutes';  // return a string that you wish to append
                        },
                        // use label callback to return the desired label
                        //  label: function(tooltipItem, data) {
                        //     // alert(tooltipItem.xLabel);
                        // //    return tooltipItem.xLabel + " :" + tooltipItem.yLabel;
                        //     return ;
                        // },
                    // remove title
                    title: function(tooltipItem, data) {
                     return ;
                    }
                }
                
                    
				},
				scales: {
					xAxes: [{
						stacked: true,
						gridLines: {
							display: false,
						},

					}],
					yAxes: [{
						stacked: true,
						ticks: {
							beginAtZero: true,
                            userCallback: function(value, index, values) {
                                // Convert the number to a string and splite the string every 3 charaters from the end
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);
                                // Convert the array to a string and format the output
                                value = value.join('.');
                                return  value +" "+'Min';
                            }
						},
                        
						type: 'linear',
                        scaleLabel: {
                            display: true,
                            labelString: 'Watch minutes'
                        },
                        
                        displayValueAxis: true,
					}]
				},
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					// position: 'bottom'
					position: false
				},
			}
		});

    }
</script>

<!-- select course_id, year(date),month(date),sum(studentwatchTime) from daily_watch_time_tbl WHERE student_id = 'ST17JEPM5W' AND month(date) = '03' AND year(date) ='2021' group by year(date),month(date),course_id order by year(date),month(date);-->