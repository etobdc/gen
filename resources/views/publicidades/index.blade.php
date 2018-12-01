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
					url="{{ route('publicidades.store') }}"
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
						<div class="form-group{{ $errors->has('local') ? ' has-error' : '' }}">
							<label for="local" class="col-sm-2 control-label">Local*</label>

							<div class="col-sm-10">
								<select name="local" class="form-control" id="local" value="" required>
									<option value="">Nada selecionado</option>
									<option value="1">Home - Abaixo de 'Encontramos um imóvel para você'</option>
									<option value="2">Avaliação - Abaixo do formulário</option>
									<option value="3">Sobre - Abaixo dos depoimentos</option>
								</select>
								@if ($errors->has('local'))
									<span class="help-block">
										<strong>{{ $errors->first('local') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-sm-2 control-label">Nome*</label>

							<div class="col-sm-10">
								<input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" maxlength="200" required>

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
							<label for="titulo" class="col-sm-2 control-label">Título botão*</label>

							<div class="col-sm-10">
								<input type="text" name="titulo" class="form-control" id="titulo" value="{{ old('titulo') }}" maxlength="50" required>

								@if ($errors->has('titulo'))
									<span class="help-block">
										<strong>{{ $errors->first('titulo') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
							<label for="link" class="col-sm-2 control-label">Link*</label>
							<div class="col-sm-10">
								<input type="url" name="link" class="form-control" id="link" value="{{ old('link') }}" maxlength="255" required>

								@if ($errors->has('link'))
									<span class="help-block">
										<strong>{{ $errors->first('link') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
							<label class="col-sm-2 control-label">Imagem*</label>

							<div class="col-sm-10">
								<input type="file" name="image" required>

								@if ($errors->has('image'))
									<span class="help-block">
										<strong>{{ $errors->first('image') }}</strong>
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
