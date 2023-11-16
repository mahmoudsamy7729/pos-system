@extends('layouts.master')
@section('title','Items Categories List')
@section('js-files')
@if (session('status'))
        <script>
            $('.eg-swal-av2').on("click", function (e) {
            Swal.fire({
            icon: 'success',
            title: {!! json_encode(session('status')) !!},
            showConfirmButton: false,
            timer: 1500
            });
            e.preventDefault();
        });
            document.getElementById('saved-status').click();
        </script>
    @endif
<script>
function Active(ID)
    {
        var element = document.getElementById("active_"+ID);
        var url = "{{route('item.category.active',999999)}}";
        $(document).ready(function()
        {
            $.ajax(
                {
                    type: "GET",
                    url: url.replace('999999',ID),
                    datatype: "json", 
                    success: function(response)
                    {
                        if(element.classList.contains("bg-danger"))
                        {
                            element.className = "badge bg-success";
                            element.innerHTML = "Active";
                        }else
                        {
                            element.className = "badge bg-danger";
                            element.innerHTML = "Not Active";
                        }
                        

                    }
                }
            )
        });
        
    }
    </script>

@endsection

@section('content')
    @include('partials.sidebar')
    <div class="nk-wrap">
        @include('partials.header')

                        <!-- content @s -->
                        {{-- comment 
                        @if (session('status'))
                        <div   aria-live="polite" aria-atomic="true" style="position: relative; min-height: 85px;">
                            <div class="toast-container  position-absolute top-0 end-0 p-3">
                                <div class="toast show "  id="myToast" >
                                    <div class="toast-header">
                                        <strong class="me-auto">POS </strong>
                                        <small>seconds ago</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body text-white bg-success">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            </div> 
                        </div>
                        @endif
                        --}}
                        <div class="nk-content ">
                            <div class="container-fluid">
                                <li><a href="#" id="saved-status" style="display:none;" class="btn btn-primary eg-swal-av2">Advanced 02</a></li>

                                <div class="nk-content-inner">
                                    <div class="nk-content-body">
                                        <div class="nk-block-head nk-block-head-sm">
                                            <div class="nk-block-between">
                                                <div class="nk-block-head-content">
                                                    <h3 class="nk-block-title page-title">{{__('categories list')}}</h3>
                                                </div><!-- .nk-block-head-content -->
                                                <div class="nk-block-head-content">
                                                    <div class="toggle-wrap nk-block-tools-toggle">
                                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                        <div class="toggle-expand-content" data-content="pageMenu">
                                                            <ul class="nk-block-tools g-3">
                                                                <li class="nk-block-tools-opt">
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li><a  href="{{route('roles.add.form.show')}}"><span>Add Category</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .toggle-wrap -->
                                                </div><!-- .nk-block-head-content -->
                                            </div><!-- .nk-block-between -->
                                        </div><!-- .nk-block-head -->
                                        <div class="nk-block">
                                            <div class="card card-bordered card-stretch" style="padding-right: 0">
                                                <div class="card-inner-group" style="white-space: nowrap;overflow-x: auto;">
                                                    <div class="card-inner position-relative card-tools-toggle">
                                                    <div class="card-inner p-0">
                                                        <table class="table table-bordered text-center mb-3">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('category name')}}</th>
                                                                    <th>{{__('description')}}</th>
                                                                    <th>{{__('status')}}</th>
                                                                    <th>Created By</th>
                                                                    <th>Created On</th>
                                                                    <th>Edit</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($categories as $category)
                                                                <tr>
                                                                    <td>{{$category->name}}</td>
                                                                    <td>{{$category->description}}</td>
                                                                    <td>
                                                                        @if ($category->active == 1)
                                                                            <span style="cursor: pointer;" id="active_{{$category->id}}" class="badge bg-success" onclick="Active({{$category->id}})">{{__('active')}}</span></td>
                                                                        @elseif($category->active == 0)
                                                                            <span style="cursor: pointer;" id="active_{{$category->id}}" class="badge bg-danger" onclick="Active({{$category->id}})">{{__('not active')}}</span></td>
                                                                        @endif
                                                                    <td>{{$category->user->name}}</td>
                                                                    <td>{{$category->created_at}}</td>
                                                                    <td><a href="#"><span class="badge bg-primary">Edit </span></a></td>
                                                                    <td><a href="#"><span class="badge bg-danger">Delete </span></a></td>
                                                                </tr>      
                                                                @endforeach
                                                            </tbody>
                                                          </table>
                                                          {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!}

                                                    </div><!-- .card-inner -->
                                                </div><!-- .card-inner-group -->
                                            </div><!-- .card -->
                                        </div><!-- .nk-block -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- content @e -->
    </div>
@endsection