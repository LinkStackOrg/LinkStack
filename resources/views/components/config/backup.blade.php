
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
  </style>
  
  <div class="container">
  
  
  <?php //landing page ?>
          
  <div class="logo-container fadein">
    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
  </div>
  <h1 class="text-center">{{__('messages.Backup')}}</h1>
  <h4 class="text-center">{{__('messages.You can back up your entire instance:')}}</h4>
  <h5 class="text-center">{{__('messages.The backup system won’t save more than two backups at a time')}}</h5>
  <div class="d-flex justify-content-center">
    <div class="row">
      <div class="col-12 col-md-auto">
        <a href="{{url('backup/?backup')}}">
          <button class="btn btn-primary mt-3">
            <i class="fa-solid fa-floppy-disk me-2"></i> {{__('messages.Backup Instance')}}
          </button>
        </a>
      </div>
      <div class="col-12 col-md-auto">
        <a href="#4" data-toggle="tab">
          <button class="btn btn-primary mt-3">
            <i class="fa-solid fa-box-archive me-2"></i> {{__('messages.All Backups')}}
          </button>
        </a>
      </div>
    </div>
  </div>
  
  
  </div>
  