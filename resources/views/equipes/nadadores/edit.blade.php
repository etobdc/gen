@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('equipes.nadadores.update', [$equipeId, $item->id]) }}"
				cancel-url="{{ route('equipes.nadadores.index', $equipeId) }}"
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
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="cpf" class="col-sm-2 control-label">CPF*</label>

					<div class="col-sm-4">
						<input type="number" name="cpf" class="form-control" id="cpf" value="{{ $item->cpf }}" maxlength="255" required>

						@if ($errors->has('cpf'))
							<span class="help-block">
								<strong>{{ $errors->first('cpf') }}</strong>
							</span>
						@endif
					</div>

					<label for="ano_nasc" class="col-sm-2 control-label">Ano de Nascimento*</label>

					<div class="col-sm-4">
						<input type="number" name="ano_nasc" class="form-control" id="ano_nasc" value="{{ $item->ano_nasc }}" maxlength="255" required>

						@if ($errors->has('ano_nasc'))
							<span class="help-block">
								<strong>{{ $errors->first('ano_nasc') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</ui-form>
		</div>
	</div>
@endsection
