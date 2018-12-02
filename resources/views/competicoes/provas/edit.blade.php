@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('competicoes.provas.update', [$competicaoId, $item->id]) }}"
				cancel-url="{{ route('competicoes.provas.index', $competicaoId) }}"
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
				<div class="form-group{{ $errors->has('prova') ? ' has-error' : '' }}">
					<label for="prova" class="col-sm-2 control-label">Prova*</label>

					<div class="col-sm-10">
						<select type="text" name="prova" class="form-control" id="prova" value="{{ $item->prova }}" maxlength="255" required>
							<option  value="">Seleciona qual o tipo da prova</option>
							<option {{ $item->prova == 1 ? 'selected' : '' }} value="1">50m Rasos</option>
							<option {{ $item->prova == 2 ? 'selected' : '' }} value="2">50m Costas</option>
							<option {{ $item->prova == 3 ? 'selected' : '' }} value="3">50m Livre</option>
							<option {{ $item->prova == 4 ? 'selected' : '' }} value="4">50m peito</option>
							<option {{ $item->prova == 5 ? 'selected' : '' }} value="5">100m Livre</option>
							<option {{ $item->prova == 6 ? 'selected' : '' }} value="6">100m borboleta</option>
						</select>
						@if ($errors->has('prova'))
							<span class="help-block">
								<strong>{{ $errors->first('prova') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('masculino') ? ' has-error' : '' }} {{ $errors->has('feminino') ? ' has-error' : '' }}">
					<label for="masculino" class="col-sm-2 control-label">Masculino*</label>

					<div class="col-sm-4">
						<input {{ $item->masculino ? 'checked' : '' }} type="checkbox" name="masculino" class="" id="masculino" value="1" maxlength="255" >

						@if ($errors->has('masculino'))
							<span class="help-block">
								<strong>{{ $errors->first('masculino') }}</strong>
							</span>
						@endif
					</div>
					<label for="Feminino" class="col-sm-2 control-label">Feminino*</label>

					<div class="col-sm-4">
						<input {{ $item->feminino ? 'checked' : '' }} type="checkbox" name="feminino" class="" id="feminino" value="1" maxlength="255" >

						@if ($errors->has('feminino'))
							<span class="help-block">
								<strong>{{ $errors->first('feminino') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</ui-form>
		</div>
	</div>
@endsection
