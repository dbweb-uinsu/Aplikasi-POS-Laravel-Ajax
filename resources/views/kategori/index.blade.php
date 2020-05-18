@extends('layouts.app')

@section('title')
Kategori
@endsection

@section('breadcumb')
@parent
<li>Kategori</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle">
                    </i> Tambah
                </a>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Nama Kategori</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- isi --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('kategori.form')
@endsection

@section('script')
<script type="text/javascript">
    var table, save_method;

$(function() {

    // function taampil data - plugin DataTable
    table = $('.table').DataTable({
        "processing": true,
        "ajax": {
            "url": "{{ route('kategori.data') }}",
            "type": "GET"
        }
    });
    
    // function menyimpan data dengan validasi pada form tambah/edit
    $('#modal-form form').validator().on('submit', function(e){
        if(!e.isDefaultPrevented()){

            var id = $('#id').val();

            if(save_method == "add")
                url = "{{ route('kategori.store') }}";
            else 
                url = "kategori/"+id;
            
            $.ajax({
                url : url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                success: function(data){
                    $('#modal-form').modal('hide');
                    table.ajax.reload();                
                },
                error: function(){
                    alert("Tidak dapat menyimpan data");
                }
            });
            return false; 
        }
    });
});

// function tampil form tambah
function addForm(){
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Kategori');
};
   



</script>
@endsection