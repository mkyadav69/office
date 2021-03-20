@extends('theme.layout.base_layout')
@section('title', 'Add Role')
@section('content')
<style>
.required:after {
    content: '*';
    color: red;
    padding-left: 5px;
}
.section__content--p30{
    padding: 0px 0px;
}
.col-md-8{
    max-width: 89.667%;
}

</style>
<div class="col col-md-8">
    @if (session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Add Role</h5>
        </div>
        <div class="modal-body">
        
            <form action="{{route('store_role')}}" method="post">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="file-input" class=" form-control-label required">Name</label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" placeholder="Name" required name="name" value="{{old('name')}}" class="form-control">
                        @if ($errors->has('name'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->first('name') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="file-input" class=" form-control-label required">Display Name</label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" placeholder="Display Name" required name="display_name" value="{{old('display_name')}}" class="form-control">
                        @if ($errors->has('display_name'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->first('display_name') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="file-input" class=" form-control-label required">Description</label>
                    </div>
                    <div class="col-12 col-md-10">
                        <textarea type="text" placeholder="Description . . ." required name="description" value=""class="form-control">{{old('description')}}</textarea>
                        @if ($errors->has('description'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->first('description') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="file-input" class=" form-control-label required">Permissions</label>
                    </div>
                   
                    <div class="col col-md-10">
                        <table id="customer" class="table table-borderless table--no-card m-b-30 table-striped table-earning sticky-header" style="width:100%">
                                <thead>
                                    @if(!empty($module_name['Operations']))
                                        <thead>
                                            <tr class="capitalize persist-header">
                                                <th style="text-align:left; width:100%"><strong>Modules</strong></th> 
                                                @foreach($module_name['Operations'] as $op)
                                                    <th style="text-align:left; width:100%"><strong>{{ $op }}</strong></th> 
                                                @endforeach
                                            </tr>
                                    @endif
                                <thead>
                                <tbody>
                                    @if(!empty($module_name['Modules']))
                                        @foreach($module_name['Modules'] as $modl_name=>$permsn)
                                            <tr>
                                                <td style="text-align:left; background: #333; color: #fff; width:100%"><strong>{{ ucfirst(str_replace('_',' ' , $modl_name))  }}</strong></td>
                                                @foreach($module_name['order'] as $key=>$per)
                                                    <td style="text-align:left; width:100%">
                                                    @if (!empty($permsn[$key]))
                                                        <input type="checkbox" name="permission[{{ $modl_name }}][]" value="{{ $permsn[$key]['name'] }}" {{ (is_array(old('permission')) and in_array($permsn[$key], old('permission.'.$modl_name, []))) ? ' checked' : '' }}/>
                                                    @else
                                                        <input type="checkbox" disabled name="" value=""style="text-align:center; vertical-align: middle;">
                                                    @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                        </table>
                        @if ($errors->has('permission'))
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{ $errors->first('permission') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('show_role')}}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/drop/mulselect/dist/js/bootstrap-multiselect.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#permission').multiselect();
    });
</script>

<script>
 $(window).on('scroll', function(){
  var pos = $('#mCSB_1_scrollbar_horizontal').position();
  var offset = $('#mCSB_1').offset();
  var scroll = $(window).scrollTop();
  
  if(typeof offset !== "undefined" && offset.hasOwnProperty('top') && offset.top < scroll){
      $("#mCSB_1_scrollbar_horizontal").css({top: (scroll - offset.top)+35, left: pos.left, position:'absolute'});
  }
  else if(typeof pos !== "undefined" && pos.hasOwnProperty('left')){
      $("#mCSB_1_scrollbar_horizontal").css({top: 0, left: pos.left, position:'absolute'});
  }
  });
</script>

<script>
function UpdateTableHeaders() {
  $(".persist-area").each(function() {
    var el = $(this),
      offset = el.offset(),
      scrollTop = $(window).scrollTop(),
      floatingHeader = $(".floatingHeader", this);

    if (scrollTop > offset.top && scrollTop < offset.top + el.height()) {
      floatingHeader.css({
        visibility: "visible"
      });
    } else {
      floatingHeader.css({
        visibility: "hidden"
      });
    }
  });
}

$(function() {
  var clonedHeaderRow;
  $(".persist-area").each(function() {
    clonedHeaderRow = $(".persist-header", this);
    console.log(clonedHeaderRow);
    clonedHeaderRow
      .before(clonedHeaderRow.clone())
      .css("width", clonedHeaderRow.width())
      .addClass("floatingHeader");
  });

  $(window)
    .scroll(UpdateTableHeaders)
    .trigger("scroll");
});
</script>
@endsection