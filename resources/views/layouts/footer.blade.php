<div class="container">
<div class="footer fadein" style="margin:5% 0px 35px 0px;">
@if(env('DISPLAY_FOOTER') === true)
    @if(env('DISPLAY_FOOTER_HOME') === true)<a class="footer-hover spacing" href="@if(str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK')) === "" ){{ url('') }}@else{{ str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK')) }}@endif">{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_HOME'))}}</a>@endif
    @if(env('DISPLAY_FOOTER_TERMS') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/terms">{{env('TITLE_FOOTER_TERMS')}}</a>@endif
    @if(env('DISPLAY_FOOTER_PRIVACY') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/privacy">{{env('TITLE_FOOTER_PRIVACY')}}</a>@endif
    @if(env('DISPLAY_FOOTER_CONTACT') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/contact">{{env('TITLE_FOOTER_CONTACT')}}</a>@endif
@endif
</div>

@if(env('DISPLAY_CREDIT') === true)
<div class="credit-footer"><a style="text-decoration: none;" class="spacing" href="https://littlelink-custom.com" target="_blank" title="Learn more">
	<section class="credit-hover hvr-grow fadein">
		<div class="parent-footer credit-icon" >
			<img id="footer_spin" class="footer_spin image-footer1 generic" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="LittleLink Custom"></img>
			<img class="image-footer2" src="{{ asset('littlelink/images/just-ll.svg') }}" alt="LittleLink Custom"></img>
		</div>

		<a href="https://littlelink-custom.com" target="_blank" title="Learn more" class="credit-txt credit-txt-clr credit-text">Powered by LittleLink Custom</a>
	</section>
</a></div><br><br><br>
@endif
</div>