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

                    <h1 class="h4 text-gray-900 mb-4">Lupa Password</h1>

                  </div>

									<?= $this->session->flashdata('message');		?>

									<?= form_open('login/req_lupas','class="user"'); ?>

									<?= form_email('email',set_value('email'),'class="form-control-user"','Email','Email yang sudah terdaftar.',form_error('email')); ?>     

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