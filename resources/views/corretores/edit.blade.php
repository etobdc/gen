@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('corretores.update', $item->id) }}"
				cancel-url="{{ route('corretores.index') }}"
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
					<input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" maxlength="255" required>

					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-sm-2 control-label">E-mail*</label>

					<div class="col-sm-10">
					<input type="email" name="email" class="form-control" id="email" value="{{ $item->email }}" maxlength="255" required>

					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
					<label for="telefone" class="col-sm-2 control-label">Telefone*</label>

					<div class="col-sm-10">
					<ui-phone
					name="telefone"
					value="{{ $item->telefone }}"
					required="true"
					class_name="form-control col-xs-12"
					/>
					@if ($errors->has('telefone'))
						<span class="help-block">
							<strong>{{ $errors->first('telefone') }}</strong>
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
								<img src="{{ asset('storage/corretores/'.$item->image) }}" style="width:100%">
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
