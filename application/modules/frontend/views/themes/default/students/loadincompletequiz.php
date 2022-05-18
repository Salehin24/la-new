<?php 
$q=0;
// dd($get_allcourseexams);
if($get_allcourseexams){
foreach($get_allcourseexams as $courseexam){
    $get_examresults = $this->Frontend_model->get_examresults($courseexam->customer_id, $courseexam->course_id, $courseexam->exam_id);
    $q++;
?>
<?php if(!$get_examresults){  ?>
<div class="border p-3 rounded-20 mb-3">
    <h5 class="mb-3">Course:
        <?php echo (!empty($courseexam->course_name) ? $courseexam->course_name : ''); ?>
    </h5>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5>
                <span class="badge bg-secondary me-1">Quiz :- <?php echo $q; ?></span>
                <?php echo (!empty($courseexam->exam_name) ? $courseexam->exam_name : ''); ?>
            </h5>
        </div>
        <div>
            <a href="<?php echo base_url($enterprise_shortname.'/show-quizform/'.$courseexam->course_id.'/'. $courseexam->exam_id); ?>"
                class="btn btn-sm btn-primary">Start</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-borderless mb-0 border">
            <thead>
                <tr>
                    <th>A&amp;Q</th>
                    <th>Correct</th>
                    <th>Incorrect</th>
                    <th>Unanswered</th>
                    <th>Avg Time</th>
                    <th>Status</th>
                    <th>Score</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>0</th>
                    <td>0 </td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-hash" style="width:<?php echo 100; ?>%">
                                <!-- Danger -->
                            </div>
                        </div>
                    </td>
                    <td class="fw-black">N/A</td>
                    <td> <span class="badge bg-warning fs-15">Incomplete</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>
<?php } 
}else{
    echo '<p class="text-danger">No quiz in your current courses</p>';  
}?>