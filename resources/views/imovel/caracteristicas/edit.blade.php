@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('imovel.caracteristicas.update', [$imovelId, $item->id]) }}"
				cancel-url="{{ route('imovel.caracteristicas.index', $imovelId) }}"
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
				<div class="form-group">
					<div class="{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="col-sm-2 control-label">Nome*</label>

						<div class="col-sm-4">
							<input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" maxlength="255" required>

							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="{{ $errors->has('quantidade') ? ' has-error' : '' }}">
						<label for="quantidade" class="col-sm-1 control-label">Quantidade*</label>

						<div class="col-sm-2">
							<input type="number" name="quantidade" class="form-control" id="quantidade" value="{{ $item->quantidade }}" maxlength="255" required>

							@if ($errors->has('quantidade'))
								<span class="help-block">
									<strong>{{ $errors->first('quantidade') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
			</ui-form>
		</div>
	</div>
@endsection
