@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('competicoes.update', $item->id) }}"
				cancel-url="{{ route('competicoes.index') }}"
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
				<div class="form-group{{ $errors->has('local') ? ' has-error' : '' }}">
					<label for="local" class="col-sm-2 control-label">Local*</label>

					<div class="col-sm-10">
						<input type="text" name="local" class="form-control" id="local" value="{{ $item->local }}" maxlength="255" required>

						@if ($errors->has('local'))
							<span class="help-block">
								<strong>{{ $errors->first('local') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
					<label for="date" class="col-sm-2 control-label">Data*</label>

					<div class="col-sm-3">
						<input type="date" name="date" class="form-control" id="date" value="{{ $item->date }}" maxlength="255" required>

						@if ($errors->has('date'))
							<span class="help-block">
								<strong>{{ $errors->first('date') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</ui-form>
		</div>
	</div>
@endsection
