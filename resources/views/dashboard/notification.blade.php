@extends('components.components.layout')
@section('head')
    <style>
        .card {
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            margin-right: 15px;
            flex-shrink: 0;
            /* Prevents the icon from shrinking */
            font-size: 1.5rem;
        }

        .icon-circle.check {
            background-color: #28a745;
        }

        .icon-circle.hourglass {
            background-color: #ffc107;
            border: 1.5px solid #fff;
        }

        .notification {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification .alert {
            flex-grow: 1;
        }

        @media (max-width: 576px) {
            .icon-circle {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }

            .icon-circle i {
                font-size: 1.5rem;
            }

            .alert {
                font-size: 0.9rem;
            }
        }

        .min-100vh {
            min-height: 100vh;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid my-5 min-100vh">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header border-0 text-center">
                        <h2>Notifications</h2>
                    </div>
                    <div class="card-body h-100 px-4">

                        @if (isset($notifications))
                            @foreach ($notifications as $notification)
                                <div class="row mb-3 border-top border-bottom border-white">
                                    <div class="notification">
                                        @if ($notification->status == 'accepted' || $notification->status == 'successful')
                                            <div class="icon-circle check">
                                                <i class="fa fa-check fs-3" aria-hidden="true"></i>
                                            </div>
                                        @endif
                                        @if ($notification->status == 'rejected')
                                            <div class="icon-circle alert bg-danger">
                                                <i class="fa fa-check fs-3" aria-hidden="true"></i>
                                            </div>
                                        @endif
                                        @if ($notification->status == 'new-application')
                                            <div class="icon-circle bg-primary">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                        @endif
                                        @if ($notification->status == 'warning' || $notification->status == 'delete-listing')
                                            <div class="icon-circle bg-warning">
                                                <i class="fa-solid fa-exclamation"></i>
                                            </div>
                                        @endif
                                        <div class="alert border-bottom w-100">
                                            <strong>{{ $notification->title }}</strong>
                                            <br>

                                            {{ $notification->summary }}
                                            <br>
                                            <small class="text-secondary">{{ $notification->created_at }}</small>
                                        </div>
                                    </div>
                                    <div class="h-100">
                                        <button class="btn fw-bold" onclick="">View Details</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @empty($notifications)
                            <div class="row mb-3">
                                You have no notifications
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
