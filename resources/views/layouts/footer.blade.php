<div class="footer fadein" style="margin:5% 0px 35px 0px;">
@if(env('DISPLAY_FOOTER') === true)
    <a class="hvr-float" href="{{ url('') }}/">Home</a>
    <a class="hvr-float" href="{{ url('') }}/pages/terms">Terms</a>
    <a class="hvr-float" href="{{ url('') }}/pages/privacy">Privacy</a>
    <a class="hvr-float" href="{{ url('') }}/pages/contact">Contact</a>
@endif
</div>

@if(env('DISPLAY_CREDIT') === true)
<a href="https://littlelink-custom.com" target="_blank" title="Learn more">
	<section class="hvr-grow fadein">
		<div class="parent-footer" >
			<img id="footer_spin" class="footer_spin image-footer1 generic" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="LittleLink Custom"></img>
			<img class="image-footer2" src="{{ asset('littlelink/images/just-ll.svg') }}" alt="LittleLink Custom"></img>
		</div>

		<a href="https://littlelink-custom.com" style="color: #FFFFFF; font-weight: 700; font-size: 15px;">Powered by LittleLink Custom</a>
	</section>
</a><br><br><br>
@endif