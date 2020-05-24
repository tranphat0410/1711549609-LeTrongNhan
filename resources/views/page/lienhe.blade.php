@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Contacts</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="/">Home</a> / <span>Contacts</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="beta-map">
		
		<div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.876650504325!2d106.62223831474869!3d10.743988892343534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752dd6a15da2cb%3A0x66d23d41541a593f!2zMTA1MS8yNCDEkMaw4budbmcgSOG6rXUgR2lhbmcsIFBoxrDhu51uZyAxMSwgUXXhuq1uIDYsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1590158376345!5m2!1svi!2s" ></iframe></div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			
			<div class="space50">&nbsp;</div>
			<div class="row">
				<div class="col-sm-8">
					<h2>Contact Form</h2>
					<div class="space20">&nbsp;</div>
					
					<div class="space20">&nbsp;</div>
					@if (session('status'))
                    <div class="alert alert-success">
                          {{ session('status') }}
                    </div>
                     @else
					<form action="{{route('lienhe')}}" method="post" class="contact-form">
					<input type="hidden" name="_token" value="{{csrf_token()}}">	
						<div class="form-block">
							<input name="name" type="text" required placeholder="Your Name (required)">
						</div>
						<div class="form-block">
							<input name="email" type="email"  required placeholder="Your Email (required)">
						</div>
						<div class="form-block">
							<input name="subject" type="text" placeholder="Subject">
						</div>
						<div class="form-block">
							<textarea name="message" placeholder="Your Message"></textarea>
						</div>
						<div class="form-block">
							<button type="submit" class="beta-btn primary">Send Message <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
					@endif
				</div>
				<div class="col-sm-4">
					<h2>Contact Information</h2>
					<div class="space20">&nbsp;</div>

					<h6 class="contact-title">Address</h6>
					<p>
						1051/24a Hậu Giang, Phường 11, Quận 6
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Business Enquiries</h6>
					<p>
						
						<a href="tranphat0410@gmail.com">tranphat0410@gmail.com</a>
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Employment</h6>
					<p>
						
						<a href="tranphat0410@gmail.com">tranphat0410@gmail.com</a>
					</p>
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection