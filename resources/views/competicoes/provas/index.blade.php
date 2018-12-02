@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">

			<tabs
			:tabs="[
			{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false},
			{'icon' : 'fa fa-plus', 'title' : 'Adicionar Registro', 'active' : false},
			]"
			active-tab="{{$errors->any() ? 1 : 0}}"
			>

				<data-table slot="tabslot_0"
				title="Lista de Registros"
				busca="{{$busca}}"
				url="{{ $data['request']->url() }}"
				token="{{ csrf_token() }}"
				:items="{{ json_encode($items) }}"
				:titles="{{$titles}}"
				:actions="{{ $actions }}"
				:enable-delete="true"
				>

					@if(session()->has('message'))
						<div class="row">
							<div class="col-sm-12">
								<alert
								class="alert-success"
								icon="fa-check"
								text="{{ session()->get('message') }}">
								</alert>
							</div>
						</div>
					@endif

					<span slot="pagination" class="pull-right">
					{{ $items->links() }}
					</span>

				</data-table>

				<div slot="tabslot_1">

					<ui-form
					form-class="form-horizontal"
					title="Adicionar Registro"
					token="{{ csrf_token() }}"
					url="{{ route('competicoes.provas.store', $competicaoId) }}"
					method="POST">

						@if($errors->any())
						<div class="row">
							<div class="col-sm-12">
								<alert
								class="alert-danger"
								icon="fa-ban"
								title="Ops!"
								text="Não foi possível adicionar o registro, verifique os campos em destaque!">
								</alert>
							</div>
						</div>
						@endif
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-sm-2 control-label">Nome*</label>

							<div class="col-sm-10">
								<input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" maxlength="255" required>

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
								<select type="text" name="prova" class="form-control" id="prova" value="{{ old('prova') }}" maxlength="255" required>
									<option value="">Seleciona qual o tipo da prova</option>
									<option value="1">50m Rasos</option>
									<option value="2">50m Costas</option>
									<option value="3">50m Livre</option>
									<option value="4">50m peito</option>
									<option value="5">100m Livre</option>
									<option value="6">100m borboleta</option>
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
								<input type="checkbox" name="masculino" class="" id="masculino" value="1" maxlength="255" >

								@if ($errors->has('masculino'))
									<span class="help-block">
										<strong>{{ $errors->first('masculino') }}</strong>
									</span>
								@endif
							</div>
							<label for="Feminino" class="col-sm-2 control-label">Feminino*</label>

							<div class="col-sm-4">
								<input type="checkbox" name="feminino" class="" id="feminino" value="1" maxlength="255" >

								@if ($errors->has('feminino'))
									<span class="help-block">
										<strong>{{ $errors->first('feminino') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</ui-form>
				</div>
			</tabs>
		</div>
	</div>

@endsection
