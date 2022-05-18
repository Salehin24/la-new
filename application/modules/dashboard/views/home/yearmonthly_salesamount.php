<div class="barchart" id="salesAmountResults">
    <canvas id="singelBarChart" height="120"></canvas>
</div>
<input type="hidden" value="<?php echo html_escape($all_quickview['lastYearMonths']); ?>" id="lastYearMonths">
<input type="hidden" value="<?php echo html_escape($all_quickview['monthly_sales_amount']); ?>" id="monthly_sales_amount">
<input type="hidden" value="<?php echo html_escape($all_quickview['monthly_subscription_amount']); ?>" id="monthly_subscription_amount">

<script type="text/javascript" src="<?php echo base_url('assets/dist/js/pages/dashboard.js'); ?>">
