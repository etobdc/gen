@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('publicidades.update', $item->id) }}"
				cancel-url="{{ route('publicidades.index') }}"
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
				<div class="form-group{{ $errors->has('local') ? ' has-error' : '' }}">
				  <label for="local" class="col-sm-2 control-label">Local</label>

				  <div class="col-sm-10">
					<select name="local" class="form-control" id="local" value="" required>
						<option value="0"  {{ $item->local == 0 ? ' selected' : '' }} >Nada selecionado</option>
						<option value="1"  {{ $item->local == 1 ? ' selected' : '' }} >Home - Abaixo de 'Encontramos um imóvel para você'</option>
						<option value="2"  {{ $item->local == 2 ? ' selected' : '' }} >Avaliação - Abaixo do formulário</option>
						<option value="3"  {{ $item->local == 3 ? ' selected' : '' }} >Sobre - Abaixo dos depoimentos</option>
					</select>
					@if ($errors->has('local'))
						<span class="help-block">
							<strong>{{ $errors->first('local') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				  <label for="name" class="col-sm-2 control-label">Frase*</label>

				  <div class="col-sm-10">
					<input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" maxlength="200" required>

					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
				  <label for="titulo" class="col-sm-2 control-label">Título botão*</label>

				  <div class="col-sm-10">
					<input type="text" name="titulo" class="form-control" id="titulo" value="{{ $item->titulo }}" maxlength="50" required>

					@if ($errors->has('titulo'))
						<span class="help-block">
							<strong>{{ $errors->first('titulo') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
					<label for="link" class="col-sm-2 control-label">Link*</label>
					<div class="col-sm-10">
						<input type="url" name="link" class="form-control" id="link" value="{{ $item->link }}" maxlength="255" required>

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
								<img src="{{ asset('storage/publicidades/'.$item->image) }}" style="width:100%">
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
