<section id="datasets-contents" class="first-section">
	<div class="container">
		<div class="section-header-wrapper">
			<h1 class="section-header">Datasets</h1>
		</div>
		<?php if($loggedin != 0){?>
		<div class="button-container">
			<button onclick="showPopupDiv(true)">New DataSet</button>
		</div>
		<?php }?>
		
		<div class="table-responsive">
		  <table class="table table-condensed table-striped table-bordered table-hover no-margin">
		    <thead>
		      <tr>
		        <th style="width:15%">Category</th>
		        <th style="width:15%" class="hidden-phone">Name</th>
		        <th style="width:35%" class="hidden-phone">Description</th>
		        <th style="width:15%" class="hidden-phone">Link</th>
		        <th style="width:10%" class="hidden-phone">Last Update</th>
		        <th style="width:10%" class="hidden-phone">Size</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php
		    	$this->load->helper('number');
		    	$this->load->helper('date');
		    	
				if(!empty($datasets['data']))
				{
					foreach ($datasets['data'] as $key => $dts): ?>
		      <tr>
		      	<td>
		      		<span class="name"><?=$dts["dts_category"] ?></span>
		      	</td>  
		      	<td><?=$dts["dts_name"] ?></td>
		      	<td class="hidden-phone"><p><?=$dts["dts_description"] ?></p></td>
		      	<td class="hidden-phone"><?=$dts["dts_link"] ?></td>
		      	<td class="hidden-phone"><?php echo mdate('%M %d, %Y', strtotime($dts["dts_lmd"])) ?></td>
		      	<td class="hidden-phone numeric"><?php echo byte_format($dts["dts_size"]) ?></td>
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
				<h3>Add DataSet Resource</h3>
				<div id="dataset-form" class="dataset-form">
					<div class="key-value">
						<div class="field-name inline">Category</div><input type="text" name="category" class="required"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Name</div><input type="text" name="name" class="required"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Description</div><textarea name="description"></textarea>
					</div>
					<div class="key-value">
						<div class="field-name inline">Link</div><input type="text" name="link"/>
					</div>
					<div class="key-value">
						<div class="field-name inline">Size</div><input type="text" name="size"/>
					</div>
					<button onclick="do_add_record('dataset-form','datasets/add_record','datasets')">Add</button>
				</div>
				
			</div>
		</div>
	</div>
</section>
