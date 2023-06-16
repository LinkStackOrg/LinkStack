@extends('layouts.sidebar')

@section('content')

<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">   


      <div class="col-lg-12">
          <div class="card   rounded">
             <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">  
  
                      <section class="text-gray-400">
                        <h2 class="mb-4 card-header"><i class="bi bi-link-45deg"> {{__('messages.Links')}}</i></h2>
                        <div class="card-body p-0 p-md-3">
                
                        <div class="table-responsive">
                        <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">{{__('messages.Link')}}</th>
                            <th scope="col">{{__('messages.Title')}}</th>
                            <th scope="col">{{__('messages.Clicks')}}</th>
                            <th scope="col">{{__('messages.Delete')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($links as $link)
                          <tr>
                            <td title="{{ $link->link }}"><a style="color:#3985ff;text-decoration:underline;" href="{{ $link->link }}" target="_blank">{{ Str::limit($link->link, 50) }}</a></td>
                            <td title="{{ $link->title }}">{{ Str::limit($link->title, 30) }}</td>
                            <td class="text-right">{{ $link->click_number }}</td>
                            <td><a href="{{ route('deleteLinkUser', $link->id ) }}" class="text-danger">{{__('messages.Delete')}}</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                        </table>
                </div>
                
                            <ul class="pagination justify-content-center">
                                  {!! $links ?? ''->links() !!}
                            </ul>
                
                <a class="btn btn-primary" href="{{ url('/admin/users/all') }}"><i class="bi bi-arrow-left-short"></i> {{__('messages.Back')}}</a>
                
                          </div>
                </section>
  
                    </div>
                </div>
             </div>
          </div>
       </div>


    </div>
  </div>

@endsection
