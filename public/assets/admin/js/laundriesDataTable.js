 $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('laundries.index') }}",
    columns: [
{data: 'id', name: 'id'},
{data: 'name_en', name: 'name_en'},
{data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

