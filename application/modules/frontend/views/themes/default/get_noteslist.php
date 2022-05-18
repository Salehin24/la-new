<table class="table table-striped table-borderless mb-0">
    <tbody>
        <?php
        if ($get_coursenotes) {
            foreach ($get_coursenotes as $notes) {
                ?>
                <tr id="notedivreload_<?php echo $notes->id;?>">
                    <td>
                        <div class="d-flex">
                            <div class="notes-play-icon me-2">
                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/notes.svg'); ?>"
                                alt="" style="width: 70%;">
                            </div>
                            <div>
                                <h6 class="fs-15 mb-1"><?php echo (!empty($notes->notes) ? $notes->notes : ''); ?></h6>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle" width="80">
                        <a href="javascrip:void(0)" onclick="noteedit('<?php echo $notes->id; ?>')" class="d-flex align-items-center justify-content-end text-primary">
                            <i class="fas fa-edit"> </i>
                            <span class="ms-2"><?php echo display('edit'); ?></span>
                        </a>
                    </td>
                    <td class="align-middle" width="80">
                        <a href="javascrip:void(0)" onclick="notedelete('<?php echo $notes->id; ?>')" class="d-flex align-items-center justify-content-end text-danger">
                            <i class="fas fa-trash"> </i>
                            <span class="ms-2"><?php echo display('delete'); ?></span>
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>  