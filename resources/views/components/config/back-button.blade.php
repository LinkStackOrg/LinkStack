<style>
	.label-container{
		position:fixed;
		bottom:48px;
		right:105px;
		display:table;
		visibility: hidden;
		z-index: 2000;
	}
	
	.label-text{
		color:#FFF;
		background:rgba(51,51,51,0.5);
		display:table-cell;
		vertical-align:middle;
		padding:10px;
		border-radius:3px;
		z-index: 2000;
	}
	
	.label-arrow{
		display:table-cell;
		vertical-align:middle;
		color:#333;
		opacity:0.5;
		z-index: 2000;
	}
	
	.float{
		position:fixed;
		width:60px;
		height:60px;
		bottom:40px;
		right:40px;
		background-color:#17a2b8;
		color:#FFF;
		border-radius:50px;
		text-align:center;
		box-shadow: 2px 2px 3px #111;
		z-index: 2000;
	}
	.float:hover{
		color: white;
		-webkit-filter: brightness(90%);
	}
	
	.my-float{
		font-size:35px;
		margin-top:15px;
		z-index: 2000;
	}
	
	a.float + div.label-container {
	  visibility: hidden;
	  opacity: 0;
	  transition: visibility 0s, opacity 0.5s ease;
	  z-index: 2000;
	}
	
	a.float:hover + div.label-container{
	  visibility: visible;
	  opacity: 1;
	}
	</style>
	<a href="{{url('admin/config')}}" class="float">
	<i class="bi bi-arrow-left-short my-float"></i>
	</a>
	<div class="label-container">
	<div class="label-text">{{__('messages.Go back')}}</div>
	</div>