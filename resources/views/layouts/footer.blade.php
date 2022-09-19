<div class="container">
<div class="footer fadein" style="margin:5% 0px 35px 0px;">
@if(env('DISPLAY_FOOTER') === true)
    @if(config('advanced-config.display_link_home') != 'false')<a class="footer-hover spacing" @if(config('advanced-config.custom_link_home') != '')href="{{ config('advanced-config.custom_link_home') }}"@else href="{{ url('') }}/"@endif> @if(config('advanced-config.custom_text_home') != ''){{config('advanced-config.custom_text_home')}}@else Home @endif</a>@endif
    @if(config('advanced-config.display_link_terms') != 'false')<a class="footer-hover spacing" href="{{ url('') }}/pages/terms">Terms</a>@endif
    @if(config('advanced-config.display_link_privacy') != 'false')<a class="footer-hover spacing" href="{{ url('') }}/pages/privacy">Privacy</a>@endif
    @if(config('advanced-config.display_link_contact') != 'false')<a class="footer-hover spacing" href="{{ url('') }}/pages/contact">Contact</a>@endif
@endif
</div>

@if(env('DISPLAY_CREDIT') === true && !request()->routeIs('home')) 
<div class="credit-footer">
	<a style="text-decoration: none;" class="spacing" href="https://arcanel.ink" target="_blank" title="Powered By">
		<section class="credit-hover hvr-grow fadein">
			<div class="parent-footer credit-icon" >
				<img id="footer_spin" class=" image-footer1 generic" src="{{ asset('content/images/arcanelink-logo.png') }}" alt="Arcane Link"></img>
				<a href="https://arcanel.ink" target="_blank" title="Learn more" class="credit-txt credit-txt-clr credit-text">Arcane Link - Free Personal Link Page</a>
			</div>

		</section>
	</a>
</div>
<br><br><br>
@endif
</div>