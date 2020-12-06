@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.comment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comments.update", [$comment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="page_id">{{ trans('cruds.comment.fields.page') }}</label>
                <select class="form-control select2 {{ $errors->has('page') ? 'is-invalid' : '' }}" name="page_id" id="page_id">
                    @foreach($pages as $id => $page)
                        <option value="{{ $id }}" {{ (old('page_id') ? old('page_id') : $comment->page->id ?? '') == $id ? 'selected' : '' }}>{{ $page }}</option>
                    @endforeach
                </select>
                @if($errors->has('page'))
                    <div class="invalid-feedback">
                        {{ $errors->first('page') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.page_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="author_id">{{ trans('cruds.comment.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id">
                    @foreach($authors as $id => $author)
                        <option value="{{ $id }}" {{ (old('author_id') ? old('author_id') : $comment->author->id ?? '') == $id ? 'selected' : '' }}>{{ $author }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="author_email">{{ trans('cruds.comment.fields.author_email') }}</label>
                <input class="form-control {{ $errors->has('author_email') ? 'is-invalid' : '' }}" type="email" name="author_email" id="author_email" value="{{ old('author_email', $comment->author_email) }}">
                @if($errors->has('author_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.author_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="author_url">{{ trans('cruds.comment.fields.author_url') }}</label>
                <input class="form-control {{ $errors->has('author_url') ? 'is-invalid' : '' }}" type="text" name="author_url" id="author_url" value="{{ old('author_url', $comment->author_url) }}">
                @if($errors->has('author_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.author_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="author_ip">{{ trans('cruds.comment.fields.author_ip') }}</label>
                <input class="form-control {{ $errors->has('author_ip') ? 'is-invalid' : '' }}" type="text" name="author_ip" id="author_ip" value="{{ old('author_ip', $comment->author_ip) }}">
                @if($errors->has('author_ip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author_ip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.author_ip_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.comment.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $comment->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_gmt">{{ trans('cruds.comment.fields.date_gmt') }}</label>
                <input class="form-control datetime {{ $errors->has('date_gmt') ? 'is-invalid' : '' }}" type="text" name="date_gmt" id="date_gmt" value="{{ old('date_gmt', $comment->date_gmt) }}" required>
                @if($errors->has('date_gmt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_gmt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.date_gmt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content">{{ trans('cruds.comment.fields.content') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content">{!! old('content', $comment->content) !!}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="karma">{{ trans('cruds.comment.fields.karma') }}</label>
                <input class="form-control {{ $errors->has('karma') ? 'is-invalid' : '' }}" type="number" name="karma" id="karma" value="{{ old('karma', $comment->karma) }}" step="1">
                @if($errors->has('karma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('karma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.karma_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approved" value="0">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $comment->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approved">{{ trans('cruds.comment.fields.approved') }}</label>
                </div>
                @if($errors->has('approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.approved_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agent">{{ trans('cruds.comment.fields.agent') }}</label>
                <input class="form-control {{ $errors->has('agent') ? 'is-invalid' : '' }}" type="text" name="agent" id="agent" value="{{ old('agent', $comment->agent) }}">
                @if($errors->has('agent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.agent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.comment.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $comment->type) }}">
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approved_date">{{ trans('cruds.comment.fields.approved_date') }}</label>
                <input class="form-control datetime {{ $errors->has('approved_date') ? 'is-invalid' : '' }}" type="text" name="approved_date" id="approved_date" value="{{ old('approved_date', $comment->approved_date) }}">
                @if($errors->has('approved_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.approved_date_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/comments/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $comment->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection