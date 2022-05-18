<div class="bg-alice-blue py-5">
		<div class="container-lg p-0">
			<div class="row g-1">
				<div class="col-md-4 col-lg-3 order-md-last sticky-content">
					<div class="card border-0 rounded-0 shadow-sm mb-3 page-section">
						<div class="card-body p-3 p-xl-4">
							<h5 class="d-flex justify-content-between align-items-center mb-3">
								<span class="text-dark-cerulean">Cart Totals</span>
							</h5>
							<ul class="list-group list-unstyled">
								<li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2">
									<div>
										<h6 class="my-0"><?php echo display('subtotal'); ?></h6>
									</div>
									<span class="text-muted" id="cart-subtotal"> BDT <?php echo number_format(html_escape($this->cart->total())); ?></span>
								</li>
								
								<li class="d-flex justify-content-between lh-sm mb-2 pb-2">
									<div>
										<h6 class="my-0"><?php echo display('grand_total'); ?></h6>
									</div>
									<span class="text-muted" id="cart-total"> BDT <?php echo number_format(html_escape($this->cart->total())); ?></span>
								</li>
								<li>
									<a href="<?php echo base_url($enterprise_shortname.'/checkout'); ?>" class="btn btn-dark-cerulean w-100 btn-lg mt-3">Proceed to checkout<?php //echo display('proced_to_checkout'); ?></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8 col-lg-9 sticky-content">
					<div class="card border-0 rounded-0 shadow-sm page-section">
						<div class="card-body p-3 p-xl-4">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th><?php echo display('image'); ?></th>
											<th class="min_width_340p"><?php echo display('course'); ?></th>
											<th><?php echo display('price'); ?></th>
											<th class="text-center"><?php echo display('action'); ?></th>
										</tr>
									</thead>
									<tbody>
                                    <form action="#" method="post">
                                 <?php
                                    $carts = $this->cart->contents();
                                //d($carts);
                                    if ($carts) {
                                    $i = 1;
                                    foreach ($carts as $items) {
                                        echo form_hidden($i . '[rowid]', $items['rowid']);
                                        $picture = $items['picture'];
                                        $get_offercourses = $this->db->select('a.*, b.name')
                                                                    ->from('course_offers_tbl a')
                                                                    ->join('course_tbl b', 'b.course_id = a.course_offerid')
                                                                    ->where('a.course_id', $items['id'])
                                                                    ->get()->result();
                                        ?>
										<input type="hidden" value="<?php echo $items['is_course_type'];?>">
                                    <tr>
                                        <td class="align-middle width_120p">
                                            <img src="<?php  if (!empty($picture)) { echo base_url($picture); } else { echo base_url('application/modules/frontend/views/themes/default/assets/defaul-course.png');}
                                        ?>" alt="<?php echo html_escape($items['name']); ?>" class="img-fluid" >
                                        </td>
                                        <td class="align-middle min_width_340p">
                                            <h6 class="fs-6"> <?php echo html_escape($items['name']); ?></h6>
                                            <ul>
                                                <?php foreach($get_offercourses as $offercourse){ ?>
                                                <li><?php echo (!empty($offercourse->name) ? $offercourse->name : ''); ?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td class="align-middle">
                                            BDT <?php  echo number_format($items['price']); //echo $this->cart->format_number(html_escape($items['price'])); ?>
                                            <input type="hidden" name="price" id="price_<?php echo $i; ?>"
                                                value="<?php echo html_escape($items['price']); ?>">
                                                <input type="hidden" id="subtotal_<?php echo $i; ?>" value="<?php echo html_escape($items['subtotal']); ?>">
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:void(0)" class="btn btn-danger"
                                                onclick="cart_delete('<?php echo $i; ?>', '<?php echo html_escape($items['rowid']); ?>')"
                                                data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                       $i++; }
                                        } else {
                                            echo '<tr><td colspan="4"><p class="emptycart_msg">Your cart is empty</p></td></tr>';
                                        }
                                        ?>
                                    </form>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>