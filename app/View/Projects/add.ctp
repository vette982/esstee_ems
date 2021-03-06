<!-- File: /app/View/Projects/add.ctp -->
<script type="text/javascript">
$(function() {
	var uow_count = 1;
	
	//$('#ProjectDocketNumber').attr("disabled", true); 

	$("#add_uow").click(function () {
		var html = '<tr><td width="20%"><div class="input number"><label for="Unit' + uow_count + 'Quantity">Quantity</label><input name="data[Unit][' + uow_count + '][quantity]" type="text" id="Unit' + uow_count + 'Quantity"/></div></td><td width="80%"><div class="input textarea"><label for="Unit' + uow_count + 'Description">Description</label><textarea rows="3" name="data[Unit][' + uow_count + '][description]" cols="30" rows="6" id="Unit' + uow_count + 'Description"></textarea></div></td></tr>';
		$("#uow_data").append(html);
		uow_count++;
	});
	
	var e,a;
	
	//validation
	$('.submit input').click(function () {
		
		var retVal = true;
		
		//reset colors
		$('.addEdit input[type!=submit]').css('background-color','#FFF');
		
		//required fields
		if($('#ProjectCustomer').val() == '') {
			$('#ProjectCustomer').css('background-color','#F6CECE');
			retVal = false;
		}
		
		if($('#ProjectTitle').val() == '') {
			$('#ProjectTitle').css('background-color','#F6CECE');
			retVal = false;
		}
		
		if(	$('#Unit0Quantity').val() == '' || $('#Unit0Description').val() == '') {
			$('#Unit0Quantity').css('background-color','#F6CECE');	
			$('#Unit0Description').css('background-color','#F6CECE');
			retVal = false;
		}
		
		if($('#ProjectDocketNumber').val() == '') {
			$('#ProjectDocketNumber').css('background-color','#F6CECE');
			retVal = false;
		}
		
		if(retVal) {
			$('#overlay').fadeIn(300); //disable the form
		}
		
		return retVal;
	});
	
	$.fn.selectRange = function(start, end) {
	    return this.each(function() {
	        if (this.setSelectionRange) {
	            this.focus();
	            this.setSelectionRange(start, end);
	        } else if (this.createTextRange) {
	            var range = this.createTextRange();
	            range.collapse(true);
	            range.moveEnd('character', end);
	            range.moveStart('character', start);
	            range.select();
	        }
	    });
	};
	
	$('#ProjectCustomer').keyup(function (event) {
		var currentInput = $('#ProjectCustomer').val();
		var autoCompleteURL = 'http://ems.essteegraphics.com/projects/autocomplete/?customer=';
		
		if(currentInput.length > 0) {
		
			$.ajax({
				url: autoCompleteURL + currentInput,
				success: function(data) {
					var json_data_object = eval("(" + data + ")");
					latestAC = json_data_object;
					var i=0;
					$('#customerAC').html('');
					for(i=0; i<json_data_object.length; i++) {
						var old_html = $('#customerAC').html();
						$('#customerAC').html(old_html + ' <a href="#">' + json_data_object[i].Project.customer + '</a>');
					}
				}
			});
		} else {
			$('#customerAC').html('<br/>');
		}
	});
	
	$('#customerAC a').live('click', function() {
		$('#ProjectCustomer').val($(this).html());
		$('#customerAC').html('<br/>');
	});
	
	//disable autocomplete from browsers
	$('input[type=text]').attr("autocomplete","off");
});
</script>
<div id="overlay" style="display:none; position: fixed; top: 0; right: 0; bottom: 0; left: 0; background-color:#000; opacity: .50; z-index: 9999999; color:#FFF">&nbsp;<b>saving...</b></div>
<div class="grid_12 addEdit">
	<h1>New Project</h1>
</div>
<div class="clear"></div>
<?php echo $this->Form->create('Project'); ?>
<div class="grid_6 addEdit">
	<?php
	echo $this->Form->input('customer');
	echo '<div id="customerAC"><br/></div>';
	echo $this->Form->input('customer_po');
	?>
	<table>
		<tr>
			<?php
			echo '<td width="50%">' . $this->Form->input('address', array('rows'=>'3')) . '</td>';
			echo '<td width="50%">' . $this->Form->input('shipping_address', array('rows'=>'3')) . '</td>';
			?>
		</tr>
	</table>
	<?php echo $this->Form->input('title');	?>
</div>
<div class="grid_6 addEdit">
	<table><tr>
	<?php
		echo '<td width="50%">' . $this->Form->input('date', array('label'=>'Date Ordered<br/>')) . '</td>';
		echo '<td width="50%">' . $this->Form->input('date_required', array('label'=>'Date Required<br/>')) . '</td>';
	?>
	</tr></table>
	<table>
		<tr><td>Docket Year</td><td>Docket #</td></tr>
		<?php
			echo '<tr><td width="30%">';	
			$years = array('7' => '2007', '8' => '2008', '9' => '2009', '10' => '2010', '11' => '2011', '12' => '2012', '13' => '2013', '14' => '2014', '15' => '2015');
			echo $this->Form->select('docket_year', $years, array('label'=>false, 'default' => date('y')));
			echo '</td><td width="30%">';
			echo $this->Form->input('docket_number', array('label'=>false, 'type' => 'text'));
			echo '</td></tr>';
		?>
		<tr><td>Prev. Docket Year</td><td>Prev. Docket #</td></tr>
		<?php
			echo '<tr><td>';
			echo $this->Form->select('prev_docket_year', $years, array('label'=>false));
			echo '</td><td>';
			echo $this->Form->input('prev_docket_number', array('label'=>false, 'type' => 'text'));
			echo '</td></tr><tr><td colspan="2">Invoice Number';
			echo $this->Form->input('invoice_number', array('label'=>false));
			echo '</td></tr>';
		?>
	</table>
</div>
<div class="clear"></div>
<div class="grid_6 addEdit">
<?php
echo '<div>';
echo '<table id="uow_data">';
echo '<tr><td width="20%">';
echo $this->Form->input('Unit.0.quantity', array('type'=>'text'));
echo '</td><td width="80%">';
echo $this->Form->input('Unit.0.description', array('rows'=>'3'));
echo '</td>';
echo '</tr></table>';
echo '</div>';
echo '<input type="button" value="+" id="add_uow"/>';
?>

<?php
echo $this->Form->input('comments', array('rows'=>'3'));
?>
</div>
<div class="grid_6 addEdit" id="aspects_div">
	<table border="1" cellPadding="2px">
		<th>
			<td>Description</td>
			<td>Estimate</td>
			<td>Actual</td>
			<td></td>
		</th>
	<?php
	$aspects = array('Pre-Press','Stock','Press','Ink','Bindery','Shipping');
	for($i=0; $i<6; $i++) {
		echo '<tr>';
		echo '<td>' . $aspects[$i] . '</td>';
		echo $this->Form->hidden('Aspect.' . $i . '.category', array('default'=>$aspects[$i]));
		echo '<td width="52%">' . $this->Form->input('Aspect.' . $i . '.description', array('rows'=>'2', 'label'=>false)) . '</td>';
		echo '<td width="17%">' . $this->Form->input('Aspect.' . $i . '.estimate_cost', array( 'label'=>false, 'type' => 'text')) . '</td>';
		echo '<td width="17%">' . $this->Form->input('Aspect.' . $i . '.actual_cost', array( 'label'=>false, 'type' => 'text')) . '</td>';	
		echo '</tr>';
	}
	?>
	</table>
	<table><tr>
		<td width="66%"></td>
		<?php
		echo '<td width="17%">' . $this->Form->input('total_cost_estimate', array('label' => 'Total Estimate', 'type' => 'text')) . '</td>';
		echo '<td width="17%">' . $this->Form->input('total_cost_amount', array('label' => 'Total Actual Amt.', 'type' => 'text')) . '</td>';
		?>
	</tr></table>
</div>
<div class="grid_1 prefix_11 addEdit">
	<?php echo $this->Form->end('Save New Project'); ?>
</div>
<div class="clear"></div>
<br/>
