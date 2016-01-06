 <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
 <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Topics in <?php echo $category['title']?> </h5>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>admin/dashboard">Dashboard</a></li>
                    <li><a href="#">Topic </a></li>
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
             <?php if($this->session->flashdata('success_msg')): ?>
                <?php echo $this->session->flashdata('success_msg'); ?>
                
            <?php endif; ?>
            <?php if($this->session->flashdata('error_msg')): ?>
                <?php echo $this->session->flashdata('error_msg'); ?>
            <?php endif; ?>
            <div class="divider"></div>
            <div id="striped-table">
              <h4 class="header">Topic Table</h4>
              <div class="row">
                
                <div class="col s12 m8 l9">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th data-field="id">Topic Id</th>
                        <th data-field="name">Topic Name</th>
                        <th data-field="price">Category Name</th>
                        <th data-field="price">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
          						if(!empty($topics['data']))
          						{
                        $i = 1;
          							foreach ($topics['data'] as $topic)
          							{?>
          								
          								<tr>
          									<td><?php echo $i;?></td>
          									<td><?php echo $topic['topic']?></td>
          									<td><?php echo $topic['category_name']?></td>
                            <td><a href="<?php echo base_url()?>admin/topic/edit/<?php echo $topic['id']?>/<?php echo $category['id'];?>">Edit</a></td>
                            <td class="delete"><a href="<?php echo base_url()?>admin/topic/delete/<?php echo $topic['id']?>/<?php echo $category['id'];?>">Delete</a></td>
          								</tr>
          								
          							<?php $i++; } }
                          else{?>
                              <tr>
                                <td colspan="4" style="text-align:center;"><?php echo"No topics for this category.";?></td>
                              </tr>
                         <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>

          <script>
            $(document).ready(function(){

              $(".delete").on('click',function(){
                if(confirm('are you sure you want to delete?'))
                {
                  return true;
                }
                else
                {
                  return false;
                }
              });

            });
          </script>

        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



