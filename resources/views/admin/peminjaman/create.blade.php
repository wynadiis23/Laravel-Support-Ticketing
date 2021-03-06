@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.comment.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.peminjaman.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group barang {{ $errors->has('barang_pinjam') ? 'has-error' : '' }}">
                <label for="barang_pinjam">{{ trans('Barang Yang Dipinjam') }}*</label>
                <button class="add_form_field">Add &nbsp;
                    <span style="font-size:16px; font-weight:bold;">+ </span>
                </button>
                <input type="text" id="barang_pinjam" name="barang_pinjam[]" class="form-control" value="{{ old('barang_pinjam', isset($peminjaman) ? $peminjaman->barang_pinjam : '') }}" required>
                @if($errors->has('barang_pinjam'))
                    <em class="invalid-feedback">
                        {{ $errors->first('barang_pinjam') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.author_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('Title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($peminjaman) ? $peminjaman->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.author_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('author_name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('Name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($peminjaman) ? $peminjaman->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.author_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('Email Peminjam') }}*</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', isset($peminjaman) ? $peminjaman->email : '') }}" required>
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.author_email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('tanggal_pinjam') ? 'has-error' : '' }}">
                <label for="tanggal_pinjam">{{ trans('Tanggal Pinjam') }}*</label>
                <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam', isset($peminjaman) ? $peminjaman->tanggal_pinjam : '') }}" required>
                @if($errors->has('tanggal_pinjam'))
                    <em class="invalid-feedback">
                        {{ $errors->first('tanggal_pinjam') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.author_email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('tanggal_kembali') ? 'has-error' : '' }}">
                <label for="tanggal_kembali">{{ trans('Tanggal Kembali') }}*</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali', isset($peminjaman) ? $peminjaman->tanggal_kembali : '') }}" required>
                @if($errors->has('tanggal_kembali'))
                    <em class="invalid-feedback">
                        {{ $errors->first('tanggal_kembali') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.author_email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('comment_text') ? 'has-error' : '' }}">
                <label for="comment_text">{{ trans('cruds.comment.fields.comment_text') }}*</label>
                <textarea id="comment_text" name="comment_text" class="form-control " required>{{ old('comment_text', isset($comment) ? $comment->comment_text : '') }}</textarea>
                @if($errors->has('comment_text'))
                    <em class="invalid-feedback">
                        {{ $errors->first('comment_text') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.comment_text_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".barang");
        var add_button = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div><input type="text" id="barang_pinjam" name="barang_pinjam[]" class="form-control"><a href="#" class="delete">Delete</a></div>'); //add input box
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

    document.getElementById('tanggal_pinjam').value = new Date().toDateInputValue();
</script>
@endsection