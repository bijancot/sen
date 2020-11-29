  <div class="container">



    <!-- Outer Row -->

    <div class="row justify-content-center">



     
          
     <div class="col-12 col-lg-5">




        <div class="card o-hidden border-0 shadow-lg my-5">

          <div class="card-body p-0">

            <!-- Nested Row within Card Body -->

            <div class="row">

              

              <div class="col-12">

                <div class="p-5">

                  <div class="text-center">

                    <h1 class="h4 text-gray-900 mb-4">Ganti Password</h1>

                  </div>

									<?= $this->session->flashdata('message');		?>

									<?= form_open('login/update_pass','class="user"'); ?>

									<?= form_password('password',set_value('password'),'class="form-control-user"','Password',form_error('password')); ?>   

                  <?= form_password('password2',set_value('password2'),'class="form-control-user"','Ulangi Password',form_error('password2')); ?>  
                  <input type="hidden" name="email" value="<?php echo $mail; ?>">

									<?= form_submit('','Submit','class="btn btn-primary btn-user btn-block"'); ?>
                                        

                  </form>

                  <hr>

                  <div class="text-center">

                    <a class="small" href="<?php echo base_url() ?>/login">Login disini!</a>

                  </div>

                  

                </div>

              </div>

            </div>

          </div>

        </div>



      </div>



    </div>



  </div>