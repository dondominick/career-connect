 @extends('components.components.layout')
 @section('head')
     <link rel="stylesheet" href="{{ asset('css/style.css') }}">
 @endsection
 @section('content')
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col">
                 <a class="btn bg-white" href="{{ url()->previous() }}">Go Back</a>
             </div>
         </div>

         <div class="row">
             <div class="col-6 mx-auto">
                 <div class="p-5 bgColor">
                     <h1 class="fw-bold h2 text-center mb-5">Update Listing</h1>
                     <!--FORM-->
                     <form method="POST" action="{{ route('update-listing', $listing->id) }}">
                         @csrf
                         @method('patch')
                         <!--Postion-->
                         <div class="col mb-3">
                             <label class="font-bold" for="">Position</label>
                             <input type="text" class="inputDesign" name="position" placeholder="Position"
                                 value="{{ $listing->position }}">
                         </div>
                         <!--Salary-->
                         <div class="mb-3">
                             <label class="font-bold" for="">Salary</label>

                             <input type="text" class="inputDesign" name="salary" placeholder="Salary"
                                 value="{{ $listing->salary }}">
                         </div>
                         <!--Location-->
                         <div class="col mb-3">
                             <label class="font-bold" for="">Location</label>

                             <input type="text" class="inputDesign" name="location" placeholder="Location"
                                 value="{{ $listing->location }}">
                         </div>
                         <div class="col mb-3">
                             <label class="font-bold" for="">Email</label>

                             <input type="text" class="inputDesign" name="email" placeholder="Email"
                                 value="{{ $listing->email }}">
                         </div>

                         <!--Min Educ Attainment Level-->
                         <div class="mb-3">
                             <label class="font-bold" for="">Mininum Education Level</label>

                             <input type="text" class="inputDesign" name="education" value="{{ $listing->education }}"
                                 placeholder="Minimum Educational Attainment Level">
                         </div>

                         <div class="row">
                             <!--Create BTN-->
                             <div class="col-2"></div>
                             <button type="submit"
                                 class="col btn border bg-primary py-2 px-4 mt-3 text-dark">Update</button>
                             <div class="col-2"></div>
                         </div>
                     </form>

                 </div>
             </div>
         </div>
     </div>
 @endsection
