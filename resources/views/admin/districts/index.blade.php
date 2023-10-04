@extends('layouts.admin')
@section('content')
@can('district_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.districts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.district.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'District', 'route' => 'admin.districts.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.district.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-District">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.district.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.district.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.district.fields.name_mal') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($districts as $key => $district)
                        <tr data-entry-id="{{ $district->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $district->id ?? '' }}
                            </td>
                            <td>
                                {{ $district->name ?? '' }}
                            </td>
                            <td>
                                {{ $district->name_mal ?? '' }}
                            </td>
                            <td>
                                @can('district_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.districts.show', $district->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('district_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.districts.edit', $district->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan


                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-District:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection