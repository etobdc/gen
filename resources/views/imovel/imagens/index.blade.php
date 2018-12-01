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
					url="{{ route('imovel.imagens.store', $imovelId) }}"
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

						<div class="form-group">
							<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
								<label class="col-sm-2 control-label">Imagem*</label>

								<div class="col-sm-10">
									<input type="file" name="image[]" multiple required>

									@if ($errors->has('image'))
										<span class="help-block">
											<strong>{{ $errors->first('image') }}</strong>
										</span>
									@endif
								</div>
							</div>
						</div>

					</ui-form>
				</div>
			</tabs>
		</div>
	</div>

@endsection
