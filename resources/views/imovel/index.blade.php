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
					url="{{ route('imovel.store') }}"
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

						<div class="form-group{{ $errors->has('destaque') ? ' has-error' : '' }}">
							<label for="destaque" class="col-sm-2 control-label">Destaque</label>

							<div class="col-sm-1">
								<input type="checkbox" name="destaque" class="" id="destaque" value="1">

								@if ($errors->has('destaque'))
									<span class="help-block">
										<strong>{{ $errors->first('destaque') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
							<label for="codigo" class="col-sm-2 control-label">Código*</label>

							<div class="col-sm-10">
								<input type="text" name="codigo" class="form-control" id="codigo" value="{{ old('codigo') }}" maxlength="25" required>

								@if ($errors->has('codigo'))
									<span class="help-block">
										<strong>{{ $errors->first('codigo') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
							<label class="col-sm-2 control-label">Imagem miniatura*</label>

							<div class="col-sm-10">
								<input type="file" name="image" required>

								@if ($errors->has('image'))
									<span class="help-block">
										<strong>{{ $errors->first('image') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
							<label class="col-sm-2 control-label">Imagem Interna (Banner)*</label>

							<div class="col-sm-10">
								<input type="file" name="banner" required>

								@if ($errors->has('banner'))
									<span class="help-block">
										<strong>{{ $errors->first('banner') }}</strong>
									</span>
								@endif
							</div>
						</div>
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
						<div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
							<label for="endereco" class="col-sm-2 control-label">Endereço*</label>
							<div class="col-sm-10">
								<textarea
									class="col-sm-12"
									style="resize:none;" rows="4"
									name="endereco"
									required
									>{{ old('endereco') }}</textarea>

								@if ($errors->has('endereco'))
									<span class="help-block">
										<strong>{{ $errors->first('endereco') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
							<label for="latitude" class="col-sm-2 control-label">Latitude</label>

							<div class="col-sm-4">
								<input type="text" name="latitude" class="form-control" id="latitude" value="{{ old('latitude') }}">

								@if ($errors->has('latitude'))
									<span class="help-block">
										<strong>{{ $errors->first('latitude') }}</strong>
									</span>
								@endif
							</div>
							<div class="{{ $errors->has('longitude') ? ' has-error' : '' }}">
								<label for="longitude" class="col-sm-2 control-label">Longitude</label>

								<div class="col-sm-4">
									<input type="text" name="longitude" class="form-control" id="longitude" value="{{ old('longitude') }}">

									@if ($errors->has('longitude'))
										<span class="help-block">
											<strong>{{ $errors->first('longitude') }}</strong>
										</span>
									@endif
								</div>
							</div>
						</div>
						<div class="form-group{{ $errors->has('tipo_id') ? ' has-error' : '' }}">
							<label for="tipo_id" class="col-sm-2 control-label">Tipo do imóvel*</label>

							<div class="col-sm-10">
								<ui-select
								name="tipo_id"
								id="tipo_id"
								required="true"
								:options="{{ $tipos }}"
								selected="0"
								>
							</ui-select>
							@if ($errors->has('tipo_id'))
							<span class="help-block">
								<strong>{{ $errors->first('tipo_id') }}</strong>
							</span>
							@endif
						</div>
					</div>
						<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
							<label for="status" class="col-sm-2 control-label">Status*</label>
							<div class="col-sm-10">
								<select name="status" class="form-control" id="status" value="" required>
									<option value="">Nada selecionado</option>
									<option value="1">Á venda</option>
									<option value="2">Para alugar</option>
									<option value="3">Lançamento</option>
								</select>
								@if ($errors->has('status'))
									<span class="help-block">
										<strong>{{ $errors->first('status') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
							<label for="video" class="col-sm-2 control-label">Video</label>

							<div class="col-sm-10">
								<input type="text" name="video" class="form-control" id="video" value="{{ old('video') }}">

								@if ($errors->has('video'))
									<span class="help-block">
										<strong>{{ $errors->first('video') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('quarto') ? ' has-error' : '' }}">
							<cidade-bairro :cidades="{{ $cidades }}" :bairros="{{ $bairros }}" nome_cidade='cidade_id' nome_bairro="bairro_id" required>
						</div>
						<div class="form-group{{ $errors->has('quarto') ? ' has-error' : '' }}">

							<div class="col-sm-2 col-sm-offset-2">
								<label for="quarto" class="control-label">Quartos</label>
								<input type="number" name="quarto" class="form-control" id="quarto" value="{{ old('quarto') ? old('quarto') : '0' }}">

								@if ($errors->has('quarto'))
									<span class="help-block">
										<strong>{{ $errors->first('quarto') }}</strong>
									</span>
								@endif
							</div>
							<!-- <div class="{{ $errors->has('sala') ? ' has-error' : '' }}">

								<div class="col-sm-2">
									<label for="sala" class="control-label">Salas</label>
									<input type="number" name="sala" class="form-control" id="sala" value="{{ old('quarto') ? old('sala') : '0' }}">

									@if ($errors->has('sala'))
										<span class="help-block">
											<strong>{{ $errors->first('sala') }}</strong>
										</span>
									@endif
								</div>
							</div> -->
							<div class="{{ $errors->has('garagem') ? ' has-error' : '' }}">

								<div class="col-sm-2">
									<label for="garagem" class="control-label">Garagens</label>
									<input type="number" name="garagem" class="form-control" id="garagem" value="{{ old('quarto') ? old('garagem') : '0' }}">

									@if ($errors->has('garagem'))
										<span class="help-block">
											<strong>{{ $errors->first('garagem') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="{{ $errors->has('banheiro') ? ' has-error' : '' }}">

								<div class="col-sm-2">
									<label for="banheiro" class="control-label">Banheiros</label>
									<input type="number" name="banheiro" class="form-control" id="banheiro" value="{{ old('quarto') ? old('banheiro') : '0' }}">

									@if ($errors->has('banheiro'))
										<span class="help-block">
											<strong>{{ $errors->first('banheiro') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="{{ $errors->has('area') ? ' has-error' : '' }}">

								<div class="col-sm-2">
									<label for="area" class="control-label">Área (m²)</label>
									<input type="number" name="area" class="form-control" id="area" value="{{ old('area') ? old('area') : '0' }}">

									@if ($errors->has('area'))
										<span class="help-block">
											<strong>{{ $errors->first('area') }}</strong>
										</span>
									@endif
								</div>
							</div>
						</div>
						<div class="form-group{{ $errors->has('preco') ? ' has-error' : '' }}">
							<label for="preco" class="col-sm-2 control-label">Valor*</label>

							<div class="col-sm-10">
								<ui-money name="preco"  value="{{ old('preco') }}" required/>

								@if ($errors->has('preco'))
									<span class="help-block">
										<strong>{{ $errors->first('preco') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('preco_adicionais') ? ' has-error' : '' }}">
							<label for="preco_adicionais" class="col-sm-2 control-label">Valor - Adicionais</label>

							<div class="col-sm-10">
								<input type="text" name="preco_adicionais" class="form-control" id="preco_adicionais" value="{{ old('preco_adicionais') }}">
								<span class="help-block">
									Ex: IPTU e Condomínio
								</span>

								@if ($errors->has('preco_adicionais'))
									<span class="help-block">
										<strong>{{ $errors->first('preco_adicionais') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							<label for="description" class="col-sm-2 control-label">Descrição*</label>
							<div class="col-sm-10">
								<ui-textarea
								name="description"
								value="{{ old('description') }}"
								required="true"
								></ui-textarea>

								@if ($errors->has('description'))
									<span class="help-block">
										<strong>{{ $errors->first('description') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<!-- <div class="form-group{{ $errors->has('link_360') ? ' has-error' : '' }}">
							<label for="link_360" class="col-sm-2 control-label">Link 360</label>

							<div class="col-sm-10">
								<input type="url" name="link_360" class="form-control" id="link_360" value="{{ old('link_360') }}">

								@if ($errors->has('link_360'))
									<span class="help-block">
										<strong>{{ $errors->first('link_360') }}</strong>
									</span>
								@endif
							</div>
						</div> -->
					</ui-form>
				</div>
			</tabs>
		</div>
	</div>

@endsection
