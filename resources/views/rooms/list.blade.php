@extends('layouts.app')

@section('content')
<div class="container">
    @include('components.search')
    <div class="container-fluid"></div>
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="row">
                <div class="col">
                    <h2>{{ __('Rooms List') }}</h2>
                </div>
                <div class="col">
                    <div class="float-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" title="Create room">+</button>
                    </div>
                </div>
            </div>
            @if(!empty($rooms) && count($rooms) > 0)
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                        <tr>
                            <td>{!! form($roomsForm[$room->id]) !!}</td>
                            <td>
                                @if ($room->default)
                                <a href="{{route('rooms_default', $room->id)}}" class="btn btn-primary" title="Remove Default"><i class="fas fa-toggle-on"></i></a>
                                @else
                                <a href="{{route('rooms_default', $room->id)}}" class="btn btn-primary" title="Make Default"><i class="fas fa-toggle-off"></i></a>
                                @endif
                                <a href="{{route('rooms.delete', $room->id)}}" class="btn btn-danger" title="Delete"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-center">{{ __('No Rooms Found') }}</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">Create room</div>

                <div class="card-body">
                    {!! form($roomForm) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
