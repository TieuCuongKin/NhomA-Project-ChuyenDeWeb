@extends('layout')
@section('main-content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Apply Jobs</h3>
				<ul class="breadcrumb-tree">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li class="active">Jobs</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<main role="main">
	<!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
	<div class="container mt-4">
		<div class="row">
			<div class="col col-md-12">
				<table class="table table-bordered">
					<thead>
						<div id='container'>
							<div class='hidden-xs' data-action='click-&gt;scroll-top#scrollToTop' data-controller='scroll-top' id='scrolltop'>
								<div class='top-arrow'></div>
							</div>
							<div class='job_application main-content'>
								<div class='content clearfix'>
									<div class='header col-12'>
										<h3>Lead/Senior Android Engineer (Kotlin) - Sign on-bonus at NAB Innovation Centre Vietnam</h3>
									</div>
									<div class='apply-form'>
										<div class='form-content'>
											<form class="info col-md-12 px-3" id="apply_form" data-controller="job-applications--new bootstrap-validation" data-bootstrap-validation-highlight-value="false" enctype="multipart/form-data" action="/job/lead-senior-android-engineer-kotlin-sign-on-bonus-nab-innovation-centre-vietnam-0104/job_applications" accept-charset="UTF-8" method="post"><input type="hidden" name="authenticity_token" value="kLH6UxUIPWYfAvtDYYG6XXlke5Dh-J9ex3HYZvLU0mL7j4t2FeRqlntDflIZLlmphtbvqg7xoNRaAwm39r0W-Q" autocomplete="off" /><input autocomplete="off" type="hidden" name="job_application[source]" id="job_application_source" />
												
												<div class='row mb-3'>
													<label class="col-sm-2" for="job_application_fullname">Your name:</label>
													<div class='col-sm-10'>
														<input maxlength="65" placeholder="Enter your full name" value="K Ha" data-rule-presence="true" data-msg-presence="Can&#39;t be blank" data-job-applications--new-target="name" size="65" type="text" name="job_application[fullname]" id="job_application_fullname" />
													</div>
												</div>
												<div class='row mb-3'>
													<label class="col-sm-2" for="job_application_cv_local">Your CV:</label>
													<div class='col-sm-10'>
														<input class="cv_input_field_field" required="required" accept="application/msword,application/pdf,application/x-ole-storage,application/vnd.openxmlformats-officedocument.wordprocessingml.document" data-rule-filesize="3145728" data-msg-filesize="limit 3MB" data-rule-minfilesize="1" data-msg-minfilesize="Your CV is empty. Please try again!" data-rule-accept="application/msword,application/pdf,application/x-ole-storage,application/vnd.openxmlformats-officedocument.wordprocessingml.document" data-msg-accept="Oops! Please attach a .doc .docx .pdf file" data-msg="Can&#39;t be blank" data-job-applications--new-target="fileField" data-action="change-&gt;job-applications--new#uploadNewCv" type="file" name="job_application[cv_local]" id="job_application_cv_local" />
														<div class='small form-text'>We accept .doc .docx, .pdf files, no password protected, up to 3MB</div>
													</div>
												</div>
												<div class='row mb-3 job_application_advantages' data-char-counter-max-length-value='500' data-controller='char-counter'>
													<label class="text" for="job_application_advantages">What skills, work projects or achievements make you a strong candidate?</label>
													<div class='col-sm-12'>
														<textarea placeholder="Details and specific examples will make your application stronger..." data-rule-maxlength="500" data-msg-maxlength="" data-char-counter-target="input" class="form-control" rows="3" name="job_application[advantages]" id="job_application_advantages"></textarea>
													</div>
													<div class='form-text text-end' data-char-counter-target='display'></div>
												</div>
												<div class='actions d-grid mb-4'>
													<button class='btn-block send_now button-red' data-disable-with='Saving...' type='submit'>Send my CV</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class='modal fade swal-popup' id='form-errors-modal' role='dialog' tabindex='-1'>
									<div class='modal-dialog' role='document'>
										<div class='modal-content'>
											<div class='modal-body text-center'>
												<button class='close modal-body__close swal2-close' data-bs-dismiss='modal' type='button'>×</button>
												<div class='swal2-title'>
													Oops! Something&#39;s not right.
												</div>
												<div class='swal2-html-container'>
													Go back and check for <i class='fa red fa-times'></i> fields.
												</div>
												<div class='swal2-actions'>
													<button class='swal2-red-btn' data-bs-dismiss='modal' type='button'>
														Go back
													</button>
													-->
												</div>
											</div>
										</div>
									</div>
									<!-- End block content -->
</main>

@endsection