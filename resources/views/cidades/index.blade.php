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
					url="{{ route('cidades.store') }}"
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
						<div class="form-group{{ $errors->has('uf') ? ' has-error' : '' }}">
							<label for="uf" class="col-sm-2 control-label">Estado*</label>

							<div class="col-sm-10">
								<select name="uf" class="form-control" required>
									<option value="">Selecione</option>
									<option value="AC">Acre</option>
									<option value="AL">Alagoas</option>
									<option value="AP">Amapá</option>
									<option value="AM">Amazonas</option>
									<option value="BA">Bahia</option>
									<option value="CE">Ceará</option>
									<option value="DF">Distrito Federal</option>
									<option value="ES">Espírito Santo</option>
									<option value="GO">Goiás</option>
									<option value="MA">Maranhão</option>
									<option value="MT">Mato Grosso</option>
									<option value="MS">Mato Grosso do Sul</option>
									<option value="MG">Minas Gerais</option>
									<option value="PA">Pará</option>
									<option value="PB">Paraíba</option>
									<option value="PR">Paraná</option>
									<option value="PE">Pernambuco</option>
									<option value="PI">Piauí</option>
									<option value="RJ">Rio de Janeiro</option>
									<option value="RN">Rio Grande do Norte</option>
									<option value="RS">Rio Grande do Sul</option>
									<option value="RO">Rondônia</option>
									<option value="RR">Roraima</option>
									<option value="SC">Santa Catarina</option>
									<option value="SP">São Paulo</option>
									<option value="SE">Sergipe</option>
									<option value="TO">Tocantins</option>
								</select>

								@if ($errors->has('uf'))
									<span class="help-block">
										<strong>{{ $errors->first('uf') }}</strong>
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
