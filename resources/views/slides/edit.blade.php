@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('slides.update', $item->id) }}"
				cancel-url="{{ route('slides.index') }}"
				method="PUT">

				@if($errors->any())
				<div class="col-sm-12">
					<alert
						class="alert-danger"
						icon="fa-ban"
						title="Ops!"
						text="Não foi possível atualizar o registro, verifique os campos em destaque!">
					</alert>
				</div>
				@endif

				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				  <label for="name" class="col-sm-2 control-label">Nome</label>

				  <div class="col-sm-10">
					<input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" maxlength="255">

					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
					<label for="lead" class="col-sm-2 control-label">Lead</label>
					<div class="col-sm-10">
						<textarea
							class="col-sm-12"
							style="resize:none;" rows="4"
							name="lead"
							>{{ $item->lead }}</textarea>

						@if ($errors->has('lead'))
							<span class="help-block">
								<strong>{{ $errors->first('lead') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('link_title') ? ' has-error' : '' }}">
					<label for="link_title" class="col-sm-2 control-label">Título do Link</label>

					<div class="col-sm-10">
						<input type="text" name="link_title" class="form-control" id="link_title" value="{{ $item->link_title }}" maxlength="255">

						@if ($errors->has('link_title'))
							<span class="help-block">
								<strong>{{ $errors->first('link_title') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
					<label for="link" class="col-sm-2 control-label">Link</label>
					<div class="col-sm-10">
						<input type="url" name="link" class="form-control" id="link" value="{{ $item->link }}" maxlength="255">

						@if ($errors->has('link'))
							<span class="help-block">
								<strong>{{ $errors->first('link') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
					<label class="col-sm-2 control-label">Imagem</label>

					<div class="col-sm-10">
						<div class="row">
						@if(strlen($item->image) > 0)
							<div class="col-md-2 col-xs-4">
								<img src="{{ asset('storage/slides/'.$item->image) }}" style="width:100%">
							</div>
						@endif
						<div class="col-xs-11">
							<input type="file" name="image">
							<input type="hidden" name="old-image" value="{{ $item->image }}">
							<span class="help-block">
								Para manter a imagem atual, não preencha esse campo
							</span>

							@if ($errors->has('image'))
							<span class="help-block">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
							@endif
							</div>
						</div>

					</div>
				</div>
			</ui-form>
		</div>
	</div>
@endsection
