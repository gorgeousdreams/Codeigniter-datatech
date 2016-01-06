<!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Edit Topic</h5>
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

                <?php if($this->session->flashdata('success_msg')): ?>
                <?php echo $this->session->flashdata('success_msg'); ?>
                
                <?php endif; ?>
                <?php if($this->session->flashdata('error_msg')): ?>
                    <?php echo $this->session->flashdata('error_msg'); ?>
                <?php endif; ?>
  <!-- Form with placeholder -->
     <div class="col s12 m12 l6">
        <div class="card-panel">
            <h4 class="header2">Edit Topic</h4>
            <div class="row">
                <form class="col s12" method="post" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <input name="topic_name" id="name2" type="text" value="<?php echo $topic['topic']; ?>">
                        <label for="first_name">Topic Name: </label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                                <i class="mdi-content-send right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
   
            </div>
        </div>
    </section>
     </div>
</div>
