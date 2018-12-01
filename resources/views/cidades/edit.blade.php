@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('cidades.update', $item->id) }}"
				cancel-url="{{ route('cidades.index') }}"
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
				<div class="form-group{{ $errors->has('uf') ? ' has-error' : '' }}">
					<label for="uf" class="col-sm-2 control-label">Estado*</label>

					<div class="col-sm-10">
						<select name="uf" class="form-control" required>
							<option value="">Selecione</option>
							<option value="AC" {{ $item->uf == 'AC' ? 'selected' : '' }}>Acre</option>
							<option value="AL" {{ $item->uf == 'AL' ? 'selected' : '' }}>Alagoas</option>
							<option value="AP" {{ $item->uf == 'AP' ? 'selected' : '' }}>Amapá</option>
							<option value="AM" {{ $item->uf == 'AM' ? 'selected' : '' }}>Amazonas</option>
							<option value="BA" {{ $item->uf == 'BA' ? 'selected' : '' }}>Bahia</option>
							<option value="CE" {{ $item->uf == 'CE' ? 'selected' : '' }}>Ceará</option>
							<option value="DF" {{ $item->uf == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
							<option value="ES" {{ $item->uf == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
							<option value="GO" {{ $item->uf == 'GO' ? 'selected' : '' }}>Goiás</option>
							<option value="MA" {{ $item->uf == 'MA' ? 'selected' : '' }}>Maranhão</option>
							<option value="MT" {{ $item->uf == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
							<option value="MS" {{ $item->uf == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
							<option value="MG" {{ $item->uf == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
							<option value="PA" {{ $item->uf == 'PA' ? 'selected' : '' }}>Pará</option>
							<option value="PB" {{ $item->uf == 'PB' ? 'selected' : '' }}>Paraíba</option>
							<option value="PR" {{ $item->uf == 'PR' ? 'selected' : '' }}>Paraná</option>
							<option value="PE" {{ $item->uf == 'PE' ? 'selected' : '' }}>Pernambuco</option>
							<option value="PI" {{ $item->uf == 'PI' ? 'selected' : '' }}>Piauí</option>
							<option value="RJ" {{ $item->uf == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
							<option value="RN" {{ $item->uf == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
							<option value="RS" {{ $item->uf == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
							<option value="RO" {{ $item->uf == 'RO' ? 'selected' : '' }}>Rondônia</option>
							<option value="RR" {{ $item->uf == 'RR' ? 'selected' : '' }}>Roraima</option>
							<option value="SC" {{ $item->uf == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
							<option value="SP" {{ $item->uf == 'SP' ? 'selected' : '' }}>São Paulo</option>
							<option value="SE" {{ $item->uf == 'SE' ? 'selected' : '' }}>Sergipe</option>
							<option value="TO" {{ $item->uf == 'TO' ? 'selected' : '' }}>Tocantins</option>
						</select>

						@if ($errors->has('uf'))
							<span class="help-block">
								<strong>{{ $errors->first('uf') }}</strong>
							</span>
						@endif
					</div>
			</ui-form>
		</div>
	</div>
@endsection
