<div class="modal-body px-4">
    <div class="mb-3"><strong>Assignment Name :</strong>
        <?php echo (!empty($get_assignmentdetails->title) ? $get_assignmentdetails->title : ''); ?> 
    </div>
    <div class="mb-3">
        <strong>Project Type :</strong>
        <?php 
        if($get_assignmentdetails->category == 1){
            echo 'Chapter Project'; 
            }else{ 
                echo 'Final Project'; 
            } 
        ?>
    </div>
    <?php if($get_assignmentdetails->category == 1){ ?>
        <div class="mb-3"><strong>Chapter :</strong> 
            <?php echo (!empty($get_assignmentdetails->section_name) ? $get_assignmentdetails->section_name : ''); ?>
    </div>
    <?php } ?>
    <!-- <div class="mb-3"><strong>Project 2:</strong> Create a slider UI</div> -->
    <div class="mb-4"><strong>Description / Instruction :</strong> 
        <?php echo (!empty($get_assignmentdetails->description) ? $get_assignmentdetails->description : ''); ?>
    </div>
    <div class="mb-4"><strong>Tips : </strong> 
        <?php echo (!empty($get_assignmentdetails->tips) ? $get_assignmentdetails->tips : ''); ?>
    </div>
    <div class="mb-4"><strong>Reference :</strong> 
        <?php echo (!empty($get_assignmentdetails->project_reference) ? $get_assignmentdetails->project_reference : ''); ?>
    </div>
    <table class="table table-bordered border-primary">
        <thead>
            <tr>
                <th colspan="2">Marking Base</th>
                <th scope="col" class="text-center">Mark</th>
            </tr>
        </thead>
        <tbody>
            <?php if($get_projectmarks){ 
                $sl = $totalmark = 0; 
                foreach($get_projectmarks as $marks){
                    $sl++;
                ?>
            <tr>
                <th width='15%' scope="row" class="text-center"><?php echo $sl; ?></th>
                <td width='50%'><?php echo (!empty($marks->markes_title) ? $marks->markes_title : ''); ?> </td>
                <td width='20%' class="text-center">
                    <?php 
                        echo $marks->marks; 
                        $totalmark += $marks->marks
                    ?>
                </td>
            </tr>
            <?php 
        }
        } ?>
            <!-- <tr>
                <th scope="row" class="text-center">02</th>
                <td>It has roots in a piece of classical Latin literature from 45 BC</td>
                <td class="text-center">10</td>
            </tr>
            <tr>
                <th scope="row" class="text-center">03</th>
                <td>Contrary to popular belief</td>
                <td class="text-center">10</td>
            </tr>
            <tr> -->
                <th class="text-center">Pass score - 
                    <?php echo (!empty($get_assignmentdetails->pass_score) ? $get_assignmentdetails->pass_score : ''); ?>%
                </th>
                <td class="text-end">Total mark : </td>
                <td class="text-center"><?php echo $totalmark; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer px-4">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <!-- <button type="button" class="btn btn-primary">Done</button> -->
</div>