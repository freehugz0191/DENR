@extends('layouts.app')
<style>
    .card-profile-image img {
  position: absolute;
  left: 50%;
  max-width: 180px;
  transition: all .15s ease;
  transform: translate(-50%, -30%);
  border-radius: .375rem;
}

.card-profile-image img:hover {
  transform: translate(-50%, -33%);
}


</style>
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card" style="border-radius: 20px">
                    <div class="card-body">
                        <div class="" style="align-items: baseline">
                            <div class="card-profile-image" style="margin-top: 10px">
                                <a href="#">
                                    @if( Auth::user()->file != null)
                                        <img src="{{ url('storage/'. Auth::user()->file ) }}" class="rounded-circle">
                                    @else
                                        <img src="{{ url('/images/profile.png') }}" class="rounded-circle">
                                    @endif
                                </a>
                            </div>
                            <div class="row" style="margin-bottom: 100px">
                                <div class="col">
                                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                      <span class="heading"></span>
                                      <span class="description"></span>
                                    </div>
                                    <div>
                                      <span class="heading"></span>
                                      <span class="description"></span>
                                    </div>
                                    <div>
                                      <span class="heading"></span>
                                      <span class="description"></span>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                              <div class="text-center">
                                <div class="h5 mt-4">
                                    <form action="">
                                     <a type="button"  data-file="{!! Auth::user()->file !!}" data-profileid={!! Auth::user()->id !!} data-toggle="modal" data-target="#edit" href="" title="edit picture" rel="tooltip"><span><i class="fa fa-camera"></i></span></a>
                                    </form>
                                </div>
                                <h3>
                                    {!! Auth::user()->name !!}<span class="font-weight-light"></span>
                                </h3>
                                <div class="h5 font-weight-300">
                                  <i class="ni location_pin mr-2"></i>Name
                                </div>
                                <div class="h5 mt-4">
                                  <i class="ni business_briefcase-24 mr-2"></i>
                                    @if ( Auth::user()->dept_id ==1)
                                        PLANNING AND SUPPORT UNIT (PSU)
                                    @elseif ( Auth::user()->dept_id ==2)
                                        Conservation Unit (CU)
                                    @elseif ( Auth::user()->dept_id ==3)
                                        Development Unit (DU)
                                    @elseif ( Auth::user()->dept_id ==4)
                                        Patents and Deeds Unit (PDU)
                                    @elseif ( Auth::user()->dept_id ==5)
                                        Licenses and Permits Unit (LPU)
                                    @elseif ( Auth::user()->dept_id ==6)
                                        Survey Unit (SU)
                                    @elseif ( Auth::user()->is_admin ==1)
                                        Office Admin
                                    @else
                                        Not Assigned yet
                                    @endif
                                                    </div>
                                <div>
                                  <i class="ni education_hat mr-2"></i>Assigned Department
                                </div>
                                <hr class="my-4">
                              </div>
                        
                    </div>
                    </div>
                </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              
              <h4 class="modal-title pull-left" id="myModalLabel">Change Profile Picture</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ url('/edit_profile')}}" method="post" enctype="multipart/form-data">
                {{method_field('patch')}}
                {{csrf_field()}}
              <div class="modal-body">
                  <input type="hidden" name="profile_id" id="profile_id" value="">
              @include('profile.profile_form')
             
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script>
        $('#edit').on('show.bs.modal', function (event) {
    
          var button = $(event.relatedTarget) 
          var profileid = button.data('profileid') 
          var file = button.data('file') 
          var modal = $(this)
          modal.find('.modal-body #file').val(file);
          modal.find('.modal-body #profile_id').val(profileid);
    })
    </script>
@endsection