</div>

<!-- /.container-fluid -->



</div>

<!-- End of Main Content -->



<!-- Footer -->

<footer class="sticky-footer bg-white">

	<div class="container my-auto">

		<div class="copyright text-center my-auto">

			<span>Copyright &copy; LO KREATIF 2020</span>

		</div>

	</div>

</footer>

<!-- End of Footer -->



</div>

<!-- End of Content Wrapper -->



</div>

<!-- End of Page Wrapper -->



<!-- Scroll to Top Button-->

<a class="scroll-to-top rounded" href="#page-top">

	<i class="fas fa-angle-up"></i>

</a>



<!-- Logout Modal-->

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>

				<button class="close" type="button" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">×</span>

				</button>

			</div>

			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>

			<div class="modal-footer">

				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

				<a class="btn btn-primary" href="<?=base_url();?>logout">Logout</a>

			</div>

		</div>

	</div>

</div>


<!-- Core plugin JavaScript-->

<script src="<?=base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>



<!-- Page level plugins -->

<script src="<?=base_url();?>assets/vendor/datatables/jquery.dataTables.min.js"></script>

<script src="<?=base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>



<!-- Page level custom scripts -->

<script src="<?=base_url();?>assets/js/demo/datatables-demo.js"></script>		



<script src="<?=base_url();?>assets/js/sweetalert2.all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>



<!-- Custom scripts for all pages-->

<script src="<?=base_url();?>assets/js/sb-admin-2.min.js"></script>

<script>
		$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	</script>

</body>

<script type="text/javascript">
	$(document).ready(function(){ 
	    $('.tab-a').click(function(){  
	      $(".tab").removeClass('tab-active');
	      $(".tab[data-id='"+$(this).attr('data-id')+"']").addClass("tab-active");
	      $(".tab-a").removeClass('text-success');
	      $(".tab-a[data-id='"+$(this).attr('data-id')+"']").addClass("text-success");
	     });
	});
</script>




</html>

