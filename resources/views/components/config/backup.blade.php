
<style>

html,
body {
  height: 100%;
  width: 100%;
}

.container {
  align-items: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 100%;
  width: 100%;
}

@media (min-width:700px) {
.row {
  display: flex;
  flex-direction: row;
  }
}

.logo-centered {
  /* top: 44vh; */
  font-size: 130px;
}

.logo-img{
    /* position: relative; */
    width: 250px;
    height: auto;
}

.loading {
  animation: loading 3s linear infinite;
}

@keyframes loading {
  from {
  	transform: rotate(0deg);
  }
  
  to {
  	transform: rotate(359deg);
  }
}

.generic {
  margin: auto;
  width: 2.5em;
  height: 2.5em;
  border: 0.4em solid transparent;
  border-color: #eee;
  border-top-color: #333;
  border-radius: 50%;
  animation: loadingspin 1s linear infinite;
}

@keyframes loadingspin {
	100% {
			transform: rotate(360deg)
	}
}

.loadingtxt:after {
  content: '.';
  animation: dots 1.5s steps(5, end) infinite;}

@keyframes dots {
  0%, 20% {
    color: rgba(0,0,0,0);
    text-shadow:
      .25em 0 0 rgba(0,0,0,0),
      .5em 0 0 rgba(0,0,0,0);}
  40% {
    color: white;
    text-shadow:
      .25em 0 0 rgba(0,0,0,0),
      .5em 0 0 rgba(0,0,0,0);}
  60% {
    text-shadow:
      .25em 0 0 white,
      .5em 0 0 rgba(0,0,0,0);}
  80%, 100% {
    text-shadow:
      .25em 0 0 white,
      .5em 0 0 white;}}

button {
    border-style: none;
    background-color: #0085ff;
}
button:hover {
    background-color: #0065c1;
    color: #FFF;
    box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);
}

.btn {
    color: #FFF !important;
}

</style>
@push('sidebar-stylesheets')
<link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">
<style>@font-face{font-family:'ll';src:url({{ asset('littlelink/fonts/littlelink-custom.otf') }}) format("opentype")}</style>
@endpush

<div class="container">


<?php //landing page ?>
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1>Backup</h1>
        <h4 class="">You can back up your entire instance:</h4>
        <h5 class="">The backup system won't save more than two backups at a time.</h5>
        <br><div class="row">
        &ensp;<a class="btn" href="{{url('backup/?backup')}}"><button style="padding:10px" class="mt-3 ml-3 btn btn-info"><i class="fa-solid fa-floppy-disk"></i> Backup Instance</button></a>&ensp;
        &ensp;<a class="btn" data-toggle="tab" href="#4"><button style="padding:10px" class="mt-3 ml-3 btn btn-info"><i class="fa-solid fa-box-archive"></i> All Backups</button></a>&ensp;
        </div>

</div>
