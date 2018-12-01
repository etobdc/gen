@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('imovel.update', $item->id) }}"
				cancel-url="{{ route('imovel.index') }}"
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
				<div class="form-group{{ $errors->has('destaque') ? ' has-error' : '' }}">
					<label for="destaque" class="col-sm-2 control-label">Destaque</label>

					<div class="col-sm-1">
						<input type="checkbox" name="destaque" class="" id="destaque" value="1" {{ $item->destaque == 1 ? 'checked':'' }}>

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
						<input type="text" name="codigo" class="form-control" id="codigo" value="{{ $item->codigo }}" maxlength="25" required>

						@if ($errors->has('codigo'))
							<span class="help-block">
								<strong>{{ $errors->first('codigo') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
					<label class="col-sm-2 control-label">Imagem miniatura</label>

					<div class="col-sm-10">
						<div class="row">
						@if(strlen($item->image) > 0)
							<div class="col-md-2 col-xs-4">
								<img src="{{ asset('storage/imovel/'.$item->image) }}" style="width:100%">
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
				<div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
					<label class="col-sm-2 control-label">Imagem Interna (Banner)</label>

					<div class="col-sm-10">
						<div class="row">
						@if(strlen($item->banner) > 0)
							<div class="col-md-2 col-xs-4">
								<img src="{{ asset('storage/imovel/'.$item->banner) }}" style="width:100%">
							</div>
						@endif
						<div class="col-xs-11">
							<input type="file" name="banner">
							<input type="hidden" name="old-banner" value="{{ $item->banner }}">
							<span class="help-block">
								Para manter o banner atual, não preencha esse campo
							</span>

							@if ($errors->has('banner'))
							<span class="help-block">
								<strong>{{ $errors->first('banner') }}</strong>
							</span>
							@endif
							</div>
						</div>

					</div>
				</div>
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
				<div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
					<label for="endereco" class="col-sm-2 control-label">Endereço*</label>
					<div class="col-sm-10">
						<textarea
							class="col-sm-12"
							style="resize:none;" rows="4"
							name="endereco"
							required
							>{{ $item->endereco }}</textarea>

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
						<input type="text" name="latitude" class="form-control" id="latitude" value="{{ $item->latitude }}">

						@if ($errors->has('latitude'))
							<span class="help-block">
								<strong>{{ $errors->first('latitude') }}</strong>
							</span>
						@endif
					</div>
					<div class="{{ $errors->has('longitude') ? ' has-error' : '' }}">
						<label for="longitude" class="col-sm-2 control-label">Longitude</label>

						<div class="col-sm-4">
							<input type="text" name="longitude" class="form-control" id="longitude" value="{{ $item->longitude }}">

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
						selected="{{ $item->tipo_id }}"
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
							<option {{ $item->status == 1 ? 'selected': '' }} value="1">Á venda</option>
							<option {{ $item->status == 2 ? 'selected': '' }} value="2">Para alugar</option>
							<option {{ $item->status == 3 ? 'selected': '' }} value="3">Lançamento</option>
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
						<input type="text" name="video" class="form-control" id="video" value="{{ $item->video }}">

						@if ($errors->has('video'))
							<span class="help-block">
								<strong>{{ $errors->first('video') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('quarto') ? ' has-error' : '' }}">
					<cidade-bairro :cidades="{{ $cidades }}" :bairros="{{ $bairros }}" nome_cidade='cidade_id' nome_bairro="bairro_id" :selected_cidade="{{ $item->cidade_id }}" :selected_bairro="{{ $item->bairro_id }}" required>
				</div>
				<div class="form-group{{ $errors->has('quarto') ? ' has-error' : '' }}">

					<div class="col-sm-2 col-sm-offset-2">
						<label for="quarto" class="control-label">Quartos</label>
						<input type="number" name="quarto" class="form-control" id="quarto" value="{{ $item->quarto }}">

						@if ($errors->has('quarto'))
							<span class="help-block">
								<strong>{{ $errors->first('quarto') }}</strong>
							</span>
						@endif
					</div>
					<!-- <div class="{{ $errors->has('sala') ? ' has-error' : '' }}">

						<div class="col-sm-2">
							<label for="sala" class="control-label">Salas</label>
							<input type="number" name="sala" class="form-control" id="sala" value="{{ $item->sala }}">

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
							<input type="number" name="garagem" class="form-control" id="garagem" value="{{ $item->garagem }}">

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
							<input type="number" name="banheiro" class="form-control" id="banheiro" value="{{ $item->banheiro }}">

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
							<input type="number" name="area" class="form-control" id="area" value="{{ $item->area }}">

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
						<ui-money name="preco" value="{{ $item->preco }}" required/>

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
						<input type="text" name="preco_adicionais" class="form-control" id="preco_adicionais" value="{{ $item->preco_adicionais }}">
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
						value="{{ $item->description }}"
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
						<input type="url" name="link_360" class="form-control" id="link_360" value="{{ $item->link_360 }}">

						@if ($errors->has('link_360'))
							<span class="help-block">
								<strong>{{ $errors->first('link_360') }}</strong>
							</span>
						@endif
					</div>
				</div> -->
			</ui-form>
		</div>
	</div>
@endsection
