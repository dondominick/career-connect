@extends('components.components.layout')
@section('head')
    <style>
        #content {
            min-height: 100vh;
        }
    </style>
@endsection
@section('content')
    <div class="row my-5 mx-3">
        <div class="col">
            <a class="btn bg-white rounded" href="{{ route('company-dashboard') }}">Go Back</a>
        </div>
    </div>
    <div class="bg-white container p-3 my-5 rounded-5" id="content">
        <h1>Company Info</h1>

        <div class="fluid-container">
            <table class="table">
                <tbody>

                    <tr>
                        <td class=""></td>
                        <td>Company Image</td>
                    </tr>
                    <tr>
                        <td>
                            Company ID
                        </td>
                        <td>
                            {{ session('company')->id }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Company Name
                        </td>
                        <td>
                            {{ session('company')->companyName }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Company Location
                        </td>
                        <td>
                            {{ session('company')->companyLocation }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Company Size
                        </td>
                        <td>
                            {{ session('company')->companySize }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Company Industry
                        </td>
                        <td>
                            {{ session('company')->companyIndustry }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Company Number
                        </td>
                        <td>
                            {{ session('company')->companyNum }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Company Contact Person
                        </td>
                        <td>
                            {{ session('company')->contactPerson }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Company Email
                        </td>
                        <td>
                            {{ session('company')->companyEmail }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Date of Registration
                        </td>
                        <td>
                            {{ session('company')->created_at }}
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
@endsection
