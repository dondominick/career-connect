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
            margin-bottom: 1rem;
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
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header border-0 text-center">
                        <h2>Notifications</h2>
                    </div>
                    <div class="card-body">

                        @if (isset($notifications))
                            @foreach ($notifications as $notification)
                                <div class="row mb-3">
                                    <div class="notification">
                                        @if ($notification->status == 'accepted' || $notification->status == 'success')
                                            <div class="icon-circle check">
                                                <i class="fa fa-check fs-3" aria-hidden="true"></i>
                                            </div>
                                        @endif
                                        @if ($notification->status == 'rejected')
                                            <div class="icon-circle alert bg-danger">
                                                <i class="fa fa-check fs-3" aria-hidden="true"></i>
                                            </div>
                                        @endif
                                        @if ($notification->status == 'warning-good')
                                            <div class="icon-circle check">
                                                <i class="fa-solid fa-exclamation"></i>
                                            </div>
                                        @endif
                                        @if ($notification->status == 'warning')
                                            <div class="icon-circle bg-warning">
                                                <i class="fa-solid fa-exclamation"></i>
                                            </div>
                                        @endif
                                        <div class="alert border-bottom w-100">
                                            <strong>{{ $notification->title }}</strong>
                                            <br>

                                            {{ $notification->body }}
                                            <br>
                                            <small class="text-secondary">{{ $notification->created_at }}</small>
                                        </div>
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
