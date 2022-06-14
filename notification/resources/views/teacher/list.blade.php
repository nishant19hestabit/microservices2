@extends('layouts.app')
@section('content')
<h1 class="bg-info text-center">Teacher List</h1>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Profile Pic</th>
                        <th scope="col">Approved Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $i)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$i->name}}</td>
                        <td>{{$i->email}}</td>
                        <td><img src="{{asset($i->profile_picture)}}" alt="" width="75" height="75"></td>
                        @if($i->is_approved==0)
                        <td><span class="text-danger">Not Approve</span></td>
                        @endif
                        @if($i->is_approved==1)
                        <td><span class="text-success">Approved</span></td>
                        @endif
                        <td>
                            @if($i->is_approved==0)
                            <a href="{{url('/teacher-approve/'.$i->id)}}" class="btn btn-sm btn-info">Approve</a>
                            @endif
                            @if($i->is_approved==1)
                            <a href="{{url('/teacher-approve/'.$i->id)}}" class="btn btn-sm btn-info">Not Approve</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
    </div>
</div>
@endsection