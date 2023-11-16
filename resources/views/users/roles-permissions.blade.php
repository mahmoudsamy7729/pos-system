@extends('layouts.master')
@section('title',$role->name .' Group Permissions - POS')
@section('js-files')
<script src="{{asset('assets/js/libs/datatable-btns.js')}}"></script>
<script>
    function toggle(oInput) {
    var aInputs = document.getElementsByTagName('input');
    for (var i=0;i<aInputs.length;i++) {
        if (aInputs[i] != oInput) {
            aInputs[i].checked = oInput.checked;
        }
    }
}
</script>
@endsection
@section('content')
    @include('partials.sidebar')
    <div class="nk-wrap">
        @include('partials.header')
                        <!-- content @s -->
                        <div class="nk-content ">
                            <div class="container-fluid">
                                <div class="nk-content-inner">
                                    <div class="nk-content-body">
                                        <div class="nk-block-head nk-block-head-sm">
                                            <div class="nk-block-between">
                                                <div class="nk-block-head-content">
                                                    <h3 class="nk-block-title page-title"> Group Permissions</h3>
                                                </div><!-- .nk-block-head-content -->
                                            </div><!-- .nk-block-between -->
                                        </div><!-- .nk-block-head -->
                                        <form action="{{route('role.permissions.save',$role->id)}}" method="POST">
                                        @csrf
                                            <div class="nk-block">
                                            <div class="card card-bordered card-stretch" style="padding-right: 0">
                                                <div class="card-inner-group" style="overflow-x: auto;">
                                                    <div class="card-inner position-relative card-tools-toggle">
                                                    <div class="card-inner p-0">
                                                        <table class="table table-bordered text-center mb-3" style="vertical-align: middle;">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="5" class="text-center p-2" style="background-color: #f8f8f9;border-radius:unset;">{{$role->name}} Group Permissions</th>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="1" class="text-center p-2" style="background-color: #dde7ef;border-radius:unset;">
                                                                        Module
                                                                    </th>
                                                                    <th colspan="4" class="text-center p-2" style="vertical-align: middle;background-color: #dde7ef;border-radius:unset;">
                                                                        <input type='checkbox' class='checkall' onClick='toggle(this)' />
                                                                        All Permissions
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($modules as $module)
                                                                <tr>
                                                                    
                                                                    <td>{{$module->name}}</td>
                                                                    <td class="p-2 text-start">
                                                                        @foreach ($module->permissions as $permission)
                                                                        <div style="display: inline-block;
                                                                        min-width: 200px;">
                                                                            <input type="checkbox" id="{{$permission->slug}}" name="permission[]" value="{{$permission->slug}}" @if(in_array($permission->id, $IDS))
                                                                            checked
                                                                            @endif>
                                                                            <label for="{{$permission->slug}}"> {{$permission->name}}</label>
                                                                        </div>
                                                                            
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                                
                                                            </tbody>
                                                          </table>                                                       
                                                    </div><!-- .card-inner -->
                                                </div><!-- .card-inner-group -->
                                                
                                            </div><!-- .card -->
                                        </div><!-- .nk-block -->
                                        <div class="row g-3 text-center">
                                            <div class="col-12 ">
                                                <div class="form-group mt-2">
                                                    <button type="submit" class="btn btn-small btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- content @e -->
    </div>
@endsection