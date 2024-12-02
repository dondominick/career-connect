@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/compEmployers.css') }}">
    <style>
        #content {
            min-height: 100vh;
        }

        main {
            margin-top: 0;

        }
    </style>
@endsection


@section('content')
    <div class=" pt-5 bg-white px-3" id="content">
        <a class="button hover:bg-slate-100 text-black w-50 mx-auto" href="{{ route('company-dashboard') }}"><i
                class="fa-solid fa-arrow-left mx-auto"></i>
            Go
            Back</a>
        <div class="">
            <div class="col g-0">
                <div class="d-flex flex-row justify-content-center justify-content-sm-start w-100">
                    <div class="d-flex">
                        <img class="companyLogo" src="https://via.placeholder.com/80" alt="Company Logo">
                        <h3 class="ms-3 my-auto">{{ session('company')->companyName }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm g-0 mt-5 mt-sm-0">
                <div class="d-flex justify-content-center justify-content-sm-end align-items-center h-100">
                    <button onclick="window.location.href='{{ route('create-employer') }}'"
                        class="addEmployerbtn btn btn-success border border-success rounded-pill py-2 px-3 ">Add
                        Employer</button>
                </div>
            </div>
        </div>

        <div class="my-5">
            <div class="w-100 border-bottom border-2 border-secondary py-2 mb-4 g-0 text-center">
                <strong>List of Employers</strong>
            </div>


            <form class="d-flex flex-row justify-content-center justify-content-sm-start g-0" method="get">
                @csrf
                <div class="me-3">
                    <input type="text" class="searchbar border border-2 rounded-pill py-2 px-3"
                        placeholder="Search Employer">
                </div>
                <select class="form-select w-25" aria-labelledby="dropdownMenuButton">
                    <option selected=""> By Default</option>

                    <option value=""> By Default</option>
                    <option value=""> ID</option>
                    <option value="">By Name</option>
                    <option value="">By Salary</option>
                </select>

                <input type="submit" value="" hidden>
            </form>

            <div class="mt-5 g-0 table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="tRowHead mb-3 rounded-3">
                            <th class="col-1" scope="col">Employer ID</th>
                            <th class="col-3 col-sm-3" scope="col">Name</th>
                            <th class="col-2" scope="col">Salary</th>
                            <th class="col-2" scope="col">Position</th>
                            <th class="col-2" scope="col">Date Added</th>
                            <th class="col-2" scope="col">Action</th>
                            <div class="col-1 d-sm-none"></div>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employers as $employer)
                            <tr class="tRow rounded-4 border-bottom-1">
                                <td class="col-1" scope="row">{{ $employer->id }}</td>
                                <td class="col-3">{{ $employer->fname }} {{ $employer->lname }}</td>
                                <td class="col-2">$12</td>
                                <td class="col-2">{{ $employer->position }}</td>
                                <td class="col-2">{{ date_format($employer->created_at, 'd/m/Y') }}</td>
                                <td class="col-2">
                                    <button type="button" class="btn btn-success mb-1 mb-sm-0" data-bs-toggle="modal"
                                        data-bs-target="#viewModal">
                                        View
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        Edit
                                    </button>

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <!-- Modal -->

    <!--View Modal-->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Employer Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul style="list-style-type:none;" class="me-5 mt-3">
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">ID:</section>
                            1
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">First Name:</section>
                            Aaron Jason
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Last Name:</section>
                            Lanos
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Age:</section>
                            19
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Gender:</section>
                            Male
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Email:</section>
                            aaronlanos@gmail.com
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Password:</section>
                            aaron123
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Contact Number:</section>
                            09321654876
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Position:</section>
                            Worker
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Salary:</section>
                            $20000
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Date Added:</section>
                            10/28/24
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!--Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Employer Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul style="list-style-type:none;" class="me-5 mt-3">
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">ID:</section>
                            <input type="text" class="editTbox form-control" id="id" value="1">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">First Name:</section>
                            <input type="text" class="editTbox form-control" id="id" value="Aaron Jason">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Last Name:</section>
                            <input type="text" class="editTbox form-control" id="id" value="Lanos">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Age:</section>
                            <input type="text" class="editTbox form-control" id="id" value="19">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Gender:</section>
                            <input type="text" class="editTbox form-control" id="id" value="Male">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Email:</section>
                            <input type="text" class="editTbox form-control" id="id"
                                value="aaronlanos@gmail.com">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Password:</section>
                            <input type="text" class="editTbox form-control" id="id" value="aaron123">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Contact Number:</section>
                            <input type="text" class="editTbox form-control" id="id" value="09321654876">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Position:</section>
                            <input type="text" class="editTbox form-control" id="id" value="Worker">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Salary:</section>
                            <input type="text" class="editTbox form-control" id="id" value="$20000">
                        </li>
                        <li class="border-bottom border-2 border-secondary py-2">
                            <section class="viewList mb-1">Date Added:</section>
                            <input type="text" class="editTbox form-control" id="id" value="10/28/24">
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal End -->
@endsection


@section('scripts')
    <script>
        function updateModal(obj) {

        }

        function viewModal(obj) {}
    </script>
@endsection
