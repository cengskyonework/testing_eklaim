@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
		  <ul class="nav nav-tabs setting-tab">
			  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">{{ _lang('Home') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about">{{ _lang('About') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#blog">{{ _lang('Blog') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">{{ _lang('Contact') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#terms">{{ _lang('Terms') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#privacy">{{ _lang('Privacy Policy') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#footer">{{ _lang('Footer') }}</a></li>
		  </ul>
		  <div class="tab-content">
				
			  <div id="home" class="tab-pane active">
				  <div class="card">
				  <div class="card-body">
				      <h4 class="card-title panel-title d-none">{{ _lang('Theme Option') }}</h4>
				      <h4 class="card-title panel-title">{{ _lang('Home Page Settings') }}</h4>
						  <form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/theme_option/update') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-12">
								  <div class="form-group">
									<label class="control-label">{{ _lang('RECENT BLOG') }}</label>						
									<textarea class="form-control" name="recent_blog">{{ get_option('recent_blog') }}</textarea>
								  </div>
								</div>

								<div class="col-md-12">
								  <div class="form-group">
									<label class="control-label">{{ _lang('OUR AGENTS') }}</label>						
									<textarea class="form-control" name="our_agent">{{ get_option('our_agent') }}</textarea>
								  </div>
								</div>

									
								<div class="col-md-12">
								  <div class="form-group">
									<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
								  </div>
								</div>
							</div>
						</form>
					</div>
				  </div>
			  </div>
			 
			
			  <div id="about" class="tab-pane fade">
				<div class="card"> 
				  <div class="card-body">
				    <h4 class="card-title panel-title">{{ _lang('About Page Settings') }}</h4>
					<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/theme_option/update') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
						    <div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('About Us Banner Image') }}</label>						
								<input type="file" class="dropify" name="about_banner_image" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{ get_option('about_banner_image') !='' ? asset('public/uploads/media/'.get_option('about_banner_image')) : '' }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('About Us Image') }}</label>						
								<input type="file" class="dropify" name="about_us_image" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{ get_option('about_us_image') !='' ? asset('public/uploads/media/'.get_option('about_us_image')) : '' }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('About Us Heading') }}</label>						
								<input type="text" class="form-control" name="about_us_heading" value="{{ get_option('about_us_heading') }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('About Us Content') }}</label>						
								<textarea class="form-control" rows="8" name="about_us_content">{{ get_option('about_us_content') }}</textarea>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('FAQ Heading') }}</label>						
								<textarea class="form-control" name="faq_heading_content">{{ get_option('faq_heading_content') }}</textarea>
							  </div>
							</div>
						
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
							  </div>
							</div>
						</div>	
					  </form>
				   </div>
				 </div>
			  </div>
			  
			 <div id="blog" class="tab-pane fade">
				<div class="card"> 
				  <div class="card-body">
				    <h4 class="card-title panel-title">{{ _lang('Blog Page Settings') }}</h4>
					<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/theme_option/update') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Blog Banner Image') }}</label>						
								<input type="file" class="dropify" name="blog_banner_image" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{ get_option('blog_banner_image') !='' ? asset('public/uploads/media/'.get_option('blog_banner_image')) : '' }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
							  </div>
							</div>
						</div>	
					  </form>
				   </div>
				 </div>
			  </div>  

			 <div id="contact" class="tab-pane fade">
				<div class="card"> 
				  <div class="card-body">
				    <h4 class="card-title panel-title">{{ _lang('Contact Page Settings') }}</h4>
					<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/theme_option/update') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Contact Banner Image') }}</label>						
								<input type="file" class="dropify" name="contact_banner_image" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{ get_option('contact_banner_image') !='' ? asset('public/uploads/media/'.get_option('contact_banner_image')) : '' }}">
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Phone') }}</label>						
								<input type="text" class="form-control" name="phone" value="{{ get_option('phone') }}">
							  </div>
							</div>
								
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Email') }}</label>						
								<input type="text" class="form-control" name="email" value="{{ get_option('email') }}" required>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Address') }}</label>						
								<textarea class="form-control" rows="8" name="address">{{ get_option('address') }}</textarea>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
							  </div>
							</div>
						</div>	
					  </form>
				   </div>
				 </div>
			  </div>
			  
			<div id="terms" class="tab-pane fade">
				<div class="card"> 
				  <div class="card-body">
				    <h4 class="card-title panel-title">{{ _lang('Terms Of Use') }}</h4>
					<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/theme_option/update') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
				
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Terms Page Heading') }}</label>						
								<input type="text" class="form-control" name="terms_heading" value="{{ get_option('terms_heading') }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Terms Page Content') }}</label>						
								<textarea class="form-control summernote" name="terms_content">{{ get_option('terms_content') }}</textarea>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Terms Banner Image') }}</label>						
								<input type="file" class="dropify" name="terms_banner_image" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{ get_option('terms_banner_image') !='' ? asset('public/uploads/media/'.get_option('terms_banner_image')) : '' }}">
							  </div>
							</div>
							
							
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
							  </div>
							</div>
						</div>	
					  </form>
				   </div>
				 </div>
			</div> 

            <div id="privacy" class="tab-pane fade">
				<div class="card"> 
				  <div class="card-body">
				    <h4 class="card-title panel-title">{{ _lang('Privacy Policy') }}</h4>
					<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/theme_option/update') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
				
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Privacy Page Heading') }}</label>						
								<input type="text" class="form-control" name="privacy_heading" value="{{ get_option('privacy_heading') }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Privacy Page Content') }}</label>						
								<textarea class="form-control summernote" name="privacy_content">{{ get_option('privacy_content') }}</textarea>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Privacy Banner Image') }}</label>						
								<input type="file" class="dropify" name="privacy_banner_image" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{ get_option('privacy_banner_image') !='' ? asset('public/uploads/media/'.get_option('privacy_banner_image')) : '' }}">
							  </div>
							</div>
							
							
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
							  </div>
							</div>
						</div>	
					  </form>
				   </div>
				 </div>
			  </div> 			


			<div id="footer" class="tab-pane fade">
				<div class="card"> 
				  <div class="card-body">
				    <h4 class="card-title panel-title">{{ _lang('Footer Settings') }}</h4>
					<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/theme_option/update') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('About Us') }}</label>						
								<textarea class="form-control" name="footer_about_us">{{ get_option('footer_about_us') }}</textarea>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Facebook') }}</label>						
								<input type="text" class="form-control" name="facebook_link" value="{{ get_option('facebook_link') }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Twitter') }}</label>						
								<input type="text" class="form-control" name="twitter_link" value="{{ get_option('twitter_link') }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Instagram') }}</label>						
								<input type="text" class="form-control" name="instagram_link" value="{{ get_option('instagram_link') }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Linkedin') }}</label>						
								<input type="text" class="form-control" name="linkedin_link" value="{{ get_option('linkedin_link') }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Copyright Text') }}</label>						
								<input type="text" class="form-control" name="copyright" value="{{ get_option('copyright') }}">
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
							  </div>
							</div>
						</div>	
					  </form>
				   </div>
				 </div>
			  </div>			  
			  
		   </div>  
		</div>
	  </div>
     </div>
    </div>
@endsection

@section('js-script')
<script type="text/javascript">
if($("#mail_type").val() != "smtp"){
	$(".smtp").prop("disabled",true);
}
$(document).on("change","#mail_type",function(){
	if( $(this).val() != "smtp" ){
		$(".smtp").prop("disabled",true);
	}else{
		$(".smtp").prop("disabled",false);
	}
});

</script>
@stop

