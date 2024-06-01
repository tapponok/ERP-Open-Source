@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item">User</li>
    </ol>
    @can('createuser')
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>User Index
        </h3>
        <div class="subheader-title">
            <a class="btn btn-primary waves-effect waves-themed float-right" href="{{route('user.create') }}">Create
                New</a>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="datatable-salesorder" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Team</th>
                                    <th>Garage</th>
                                        <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $i => $u)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        @if ($u->profile_photo_path != null)
                                        <img class="profile-image rounded-circle" style="height:35px; width: 35px;"
                                            src="{{asset('storage/profile/'.$u->profile_photo_path)}}"
                                            alt="{{ $u->name }}">
                                        @else
                                        <img src="{{ $u->getUrlfriendlyAvatar() }}"
                                            class="profile-image-md rounded-circle" alt="users profile">
                                        @endif
                                    </td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    @if(empty($u->team->name))
                                    <td></td>
                                    @else
                                    <td>{{ $u->team->name }}</td>
                                    @endif
                                    <td>{{ $u->garageid->garagename }}</td>
                                    <td>
                                        <div class="d-flex demo">
                                            <a href="{{ route('user.show', ['user' => $u->id]) }}"
                                                class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1"
                                                title="info Record"><i class="fal fa-info"></i></a>
                                            @can('updateuser')
                                            <a href="{{ route('user.edit', ['user' => $u->id]) }}"
                                                class="btn btn-sm btn-outline-primary btn-icon btn-inline-block mr-1"
                                                title="Edit"><i class="fal fa-edit"></i></a>
                                            @endcan
                                            @can('deleteuser')
                                            <a href="javascript:void(0);"
                                                class="btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1"
                                                title="Delete Record" data-toggle="modal"
                                                onclick="deleteData({{ $u->id }})" data-target="#DeleteModal"
                                                style="color: red"><i class="fal fa-trash"></i></a>
                                            @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal delete -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirmation!!!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action="" id="deleteForm" method="post">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <h5 class="modal-title">Are you sure to delete this item?</h5>
                        <input type="hidden" name="id" id="id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script type="text/javascript">
    function deleteData(id) {
        var id = id;
        var url = '{{ route("user.delete", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

</script>
<script>
    $(document).ready(function () {
        $('#datatable-salesorder').dataTable({
            responsive: true,
            dom:
                /*	--- Layout Structure
                	--- Options
                	l	-	length changing input control
                	f	-	filtering input
                	t	-	The table!
                	i	-	Table information summary
                	p	-	pagination control
                	r	-	processing display element
                	B	-	buttons
                	R	-	ColReorder
                	S	-	Select

                	--- Markup
                	< and >				- div element
                	<"class" and >		- div with a class
                	<"#id" and >		- div with an ID
                	<"#id.class" and >	- div with an ID and a class

                	--- Further reading
                	https://datatables.net/reference/option/dom
                	--------------------------------------
                 */
                "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                    extend: 'colvis',
                    text: 'Column Visibility',
                    titleAttr: 'Col visibility',
                    className: 'btn-outline-default'
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    titleAttr: 'Generate CSV',
                    className: 'btn-outline-default'
                },
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    titleAttr: 'Copy to clipboard',
                    className: 'btn-outline-default'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    titleAttr: 'Print Table',
                    className: 'btn-outline-default'
                }

            ]
        });
    });

</script>
<script>
    function deleteData(id) {
        var id = id;
        console.log(id);
        var url = '{{ route("user.delete", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

</script>
@endsection
