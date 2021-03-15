@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Role List
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/select2.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables-new/datatables.min.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/drop/mulselect/dist/css/bootstrap-multiselect.css') }}">
<!--end of page level css-->

@stop


{{-- Page content --}}
@section('content')
<style type="text/css">
td {
    text-overflow:'ellipsis';
    overflow:'hidden';
    white-space : nowrap';
}

</style>

<!-- Main content -->
<section class="content">
    <!-- Second Data Table -->
    <div class="tablewrapper-inner showhide">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box default">
                <div class="portlet-title">
                    <div class="caption"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Manage Roles
                    </div>
                </div>
                <div class="portlet-body">  
                    <div id="sample_editable_1_wrapper">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer cell-border row-border compact" width="100%" id="order_table" role="grid" >
                            <thead>
                                <tr class="filters">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Display Name</th>
                                    <th>Description</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            @if (!empty($roles))
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            {{ $role->id }}
                                        </td>

                                        <td>
                                            {{ $role->name }}
                                        </td>

                                        <td>
                                            {{ $role->display_name }}
                                        </td>

                                        <td>
                                            {{ $role->description }}
                                        </td>

                                        <td>
                                            @foreach ($role->perms as $permission )
                                                {!! $permission->display_name.";" !!}
                                            @endforeach
                                        </td>
                                        
                                        @php
                                            $arr = [];
                                            if(\Auth::user()->can('edit_role')){
                                                $edit = route('edit.role', ['edit' => $role->id ]);
                                                $arr[] = "<a class='btn edit edit-role' title='Edit Role' href=$edit><i class='fa fa-pencil text-primary' aria-hidden='true' ></i>
                                                </a>";
                                            }
                                            if(\Auth::user()->can('delete_role')){
                                                $delete = route('remove.role', ['delete' => $role->id]);
                                                $arr[] ="<a class='btn trush delete-role' title='Delete Role' href=$delete ><i class='fa fa-trash text-danger' aria-hidden='true' ></i></i>
                                                </a>";
                                            }
                                            if(!\Auth::user()->can(['edit_role','delete_role'])){ 
                                                $arr[] = "<a class='btn' title='View Only'><i class='fa fa-eye text-primary' aria-hidden='true' ></i></i></a>";
                                            }
                                           
                                        @endphp

                                        @if(\Auth::user()->can(['edit_role', 'delete_role']))
                                            <td>
                                                {!! implode(' ', $arr) !!}
                                            </td>
                                        @else
                                            <td>
                                                {!! implode(' ', $arr) !!}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables-new/datatables.min.js') }}"></script>
<script src="{{ asset('assets/drop/mulselect/dist/js/bootstrap-multiselect.js') }}"></script>
<script>
$(document).ready(function() {
    var table = $('#order_table').DataTable({
        processing: true,
        scrollCollapse: true,
        scrollX: true,
        fixedHeader: true,
        "drawCallback": function (settings) {
            $('td').css('text-overflow', 'ellipsis');
            $('td').css('overflow', 'hidden');
            $('td').css('white-space', 'nowrap');
            $('td').addClass('ellipsisd');
            $('.ellipsisd').click(function () {
                if ($(this).hasClass('ellipsisd')) {
                    $(this).removeAttr('style');
                    $(this).removeClass('ellipsisd');
                }
                else {
                    $(this).css('text-overflow', 'ellipsis');
                    $(this).css('overflow', 'hidden');
                    $(this).css('white-space', 'nowrap');
                    $(this).addClass('ellipsisd');
                }
            });
        }, 
    });
    
    var scroll_handler = function(){
        var offset = $('#mCSB_1').offset();
        var pos = $('#mCSB_1_container').position().left + offset.left;
        //console.log($('#mCSB_1_container').position().left+ " - " +$('.fixedHeader-floating').scrollLeft())
        $('.fixedHeader-floating').css('left', pos + 'px');
        $('.fixedHeader-floating').css('z-index', 1);
    };
    if($('.dataTables_scrollHead').get(0).scrollWidth > $('.dataTables_scrollHead').innerWidth()){
        $(".dataTables_scroll").mCustomScrollbar({
            scrollButtons: { enable: true },
            mouseWheel: { enable: false },
            scrollbarPosition: "outside",
            axis: "x",
            theme: "dark-thin",
            autoExpandScrollbar: true,
            advanced: { autoExpandHorizontalScroll: true, updateOnImageLoad: false },
            callbacks:{
                onScrollStart:scroll_handler,
                onScroll:scroll_handler,
                whileScrolling:scroll_handler,
                onTotalScroll:scroll_handler
            }
        });
        $(window).on('scroll', function(){
            var pos = $('#mCSB_1_scrollbar_horizontal').position();
            var offset = $('#mCSB_1').offset();
            var scroll = $(window).scrollTop();
            if(typeof offset !== "undefined" && offset.hasOwnProperty('top') && offset.top < scroll){
                $("#mCSB_1_scrollbar_horizontal").css({top: (scroll - offset.top)+72, left: pos.left, position:'absolute'});
            }
            else if(typeof pos !== "undefined" && pos.hasOwnProperty('left')){
                $("#mCSB_1_scrollbar_horizontal").css({top: 0, left: pos.left, position:'absolute'});
            }
        });
    }
    $('#permission').multiselect();
});
</script>

<script>
$(".delete-role").click(function(){
    if(confirm("Are you sure ?, if deleted, users assign to this role are unauthorize to access page !")){
        return true;
    }
    else{
        return false;
    }
});
</script>
@stop

