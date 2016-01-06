<section id="education-contents" class="first-section">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Education Resources</h1>
		</div>
		
		<div class="button-container">
		<?php if($loggedin != 0){?>
			<button onclick="showPopupDiv(true)">New Education Resource</button>
		<?php }?>
		</div>
		
		<div class="table-responsive">
		  <table class="table table-condensed table-striped table-bordered table-hover no-margin">
		    <thead>
		      <tr>
		        <th style="width:20%">Name</th>
		        <th style="width:15%" class="hidden-phone">Institution</th>
		        <th style="width:8%" class="hidden-phone">Country</th>
		        <th style="width:7%" class="hidden-phone">City</th>
		        <th style="width:10%" class="hidden-phone">Duration</th>
		        <th style="width:10%" class="hidden-phone">Degree / Non Degree</th>
		        <th style="width:10%" class="hidden-phone">URL</th>
		        <th style="width:10%" class="hidden-phone">Qualification</th>
		        <th style="width:10%" class="hidden-phone">Estimated Cost</th>
		      </tr>
		    </thead>
		    <tbody>
		      <?php 
				if(!empty($education['data']))
				{
					foreach ($education['data'] as $key => $edu): ?>
		      <tr>
		      	<td>
		      		<span class="name"><?=$edu["edu_name"] ?></span>
		      	</td>  
		      	<td><?=$edu["edu_institution"] ?></td>
		      	<td class="hidden-phone"><?=$edu["edu_country"] ?></td>
		      	<td class="hidden-phone"><?=$edu["edu_city"] ?></td>
		      	<td class="hidden-phone"><?=$edu["edu_duration"] ?></td>
		      	<td class="hidden-phone"><?=$edu["edu_degree"] ?></td>
		      	<td class="hidden-phone"><?=$edu["edu_url"] ?></td>
		      	<td class="hidden-phone"><?=$edu["edu_qualification"] ?></td>
		      	<td class="hidden-phone numeric"><?=number_format($edu["edu_est_cost"], 0) ?></td>
		      </tr>
		     <?php endforeach;
		}?>
		    </tbody>
		  </table>
		</div>
	</div>
	
	<div id="popupBox">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
				<a href="javascript:showPopupDiv(false)"><i class="fa fa-close"></i></a>
				<h3>Add Education Resource</h3>
				<div id="education-form" class="dataset-form">
					<div class="key-value">
						<div class="field-name inline">Name</div><input type="text" name="name" class="required"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Institution</div><input type="text" name="institution" class="required"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Country</div><input type="text" name="country" class="required"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">City</div><input type="text" name="city"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Duration</div><input type="text" name="duration"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Degree / Non Degree</div><input type="text" name="degree"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">URL</div><input type="text" name="url"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Qualification</div><input type="text" name="qualification"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Estimated Cost</div><input type="text" name="estcost"/>
					</div>
					<button onclick="do_add_record('education-form','education/add_record','education')">Add</button>
				</div>
			</div>
		</div>
	</div>
</section>
