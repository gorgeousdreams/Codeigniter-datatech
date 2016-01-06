 <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Category Listing</h5>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>admin/dashboard">Dashboard</a></li>
                    <li><a href="#">Category </a></li>
                    <!-- <li class="active">Basic Tables</li> -->
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">

            <!--Striped Table-->
            <div class="divider"></div>
            <div id="striped-table">
              <h4 class="header">Category Table</h4>
              <div class="row">
                
                <div class="col s12 m8 l9">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th data-field="id">Category Id</th>
                        <th data-field="name">Category Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
						if(!empty($categories))
						{
							foreach ($categories as $category)
							{?>
								
								<tr>
									<td><a href="<?php echo base_url()?>admin/topic/listing_by_category_id/<?php echo$category['id']?>"><?php echo $category['id']?></a></td>
									<td><a href="<?php echo base_url()?>admin/topic/listing_by_category_id/<?php echo$category['id']?>"><?php echo $category['title']?></a></td>
								</tr>
								
							<?php } }else{?>
                          <tr>
                            <td colspan="3" style="text-align:center;"><?php echo"No Categories added yet.";?></td>
                          </tr>
                     <?php } ?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>



        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



