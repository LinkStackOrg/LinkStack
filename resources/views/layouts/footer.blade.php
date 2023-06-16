<div class="container">
	<div class="footer fadein" style="margin:5% 0px 35px 0px;">
	@if(env('DISPLAY_FOOTER') === true)
		@if(env('DISPLAY_FOOTER_HOME') === true)<a class="footer-hover spacing" href="@if(str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK')) === "" ){{ url('') }}@else{{ str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK')) }}@endif">{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_HOME'))}}</a>@endif
		@if(env('DISPLAY_FOOTER_TERMS') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/{{ strtolower(env('TITLE_FOOTER_TERMS')) }}">{{env('TITLE_FOOTER_TERMS')}}</a>@endif
		@if(env('DISPLAY_FOOTER_PRIVACY') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/{{ strtolower(env('TITLE_FOOTER_PRIVACY')) }}">{{env('TITLE_FOOTER_PRIVACY')}}</a>@endif
		@if(env('DISPLAY_FOOTER_CONTACT') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/{{ strtolower(env('TITLE_FOOTER_CONTACT')) }}">{{env('TITLE_FOOTER_CONTACT')}}</a>@endif
	@endif
	</div>

	@if(env('DISPLAY_CREDIT') === true)
	{{-- Removed class spacing --}}
	<div class="credit-footer"><a style="text-decoration: none;" class="" href="https://linkstack.org" target="_blank" title="{{__('messages.Learn more about LinkStack')}}">
		<div style="vertical-align: middle;display: inline-block;padding-bottom:50px;" class="credit-hover hvr-grow fadein">
			<img style="top:9px;" class="credit-icon image-footer1 generic" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="LinkStack">
			<a href="https://linkstack.org" target="_blank" title="{{__('messages.Learn more')}}" class="credit-txt credit-txt-clr credit-text">Powered by LinkStack</a>
		</div>
	</a></div>
	@endif
	</div>