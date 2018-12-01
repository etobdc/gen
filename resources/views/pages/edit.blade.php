@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('pages.update', $item->id) }}"
				cancel-url="{{ route('pages.index') }}"
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
				  <label for="name" class="col-sm-2 control-label">Nome*</label>

				  <div class="col-sm-10">
					<input type="text" name="name" class="form-control" disabled id="name" value="{{ $item->name }}" maxlength="255" readonly>

					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				@if (in_array($item->id, [2, 3, 4, 5, 6, 7, 9, 10]))
					<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					  <label for="title" class="col-sm-2 control-label">Título</label>

					  <div class="col-sm-10">
						<input type="text" name="title" class="form-control" id="title" value="{{ $item->title }}" maxlength="255">

						@if ($errors->has('title'))
							<span class="help-block">
								<strong>{{ $errors->first('title') }}</strong>
							</span>
						@endif
					  </div>
					</div>
				@endif
				@if (in_array($item->id, [1,2,8,10]))
					<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
						<label for="description" class="col-sm-2 control-label">Descrição*</label>
						<div class="col-sm-10">
							<ui-textarea
								name="description"
								value="{{ $item->description }}"
								required="true"
								></ui-textarea>

							@if ($errors->has('description'))
								<span class="help-block">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
							@endif
						</div>
					</div>
				@endif
				@if (in_array($item->id, [2, 4, 5, 6, 7]))
					<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Imagem</label>

						<div class="col-sm-10">
							<div class="row">
							@if(strlen($item->image) > 0)
								<div class="col-md-2 col-xs-4">
									<img src="{{ asset('storage/pages/'.$item->image) }}" style="width:100%">
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
				@endif
			</ui-form>
		</div>
	</div>
@endsection
