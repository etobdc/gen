@extends('layouts.page')

@section('content')
		<div class="row">
			<div class="col-md-12">

				<tabs 
					:tabs="[
					{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false}, 
					{'icon' : 'fa fa-plus', 'title' : 'Adicionar Registro', 'active' : false}
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
			            	url="{{ route('categories.store') }}"
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
			                  <label class="col-sm-2 control-label"></label>

			                  	<div class="col-sm-10">
			                  		<div class="checkbox{{ $errors->has('is_main') ? ' has-error' : '' }}">
	                  					<label for="is_main">
			                  				<input type="checkbox" name="is_main" id="is_main" {{ old('is_main') ? 'checked' : '' }}> Principal?
			                  			</label>
			                  		</div>

			                  		@if ($errors->has('is_main'))
										<span class="help-block">
											<strong>{{ $errors->first('is_main') }}</strong>
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
			              	<div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
			                  <label for="order" class="col-sm-2 control-label">Ordem*</label>

			                  <div class="col-sm-10">
			                    <input type="number" name="order" class="form-control" id="order" value="{{ old('order') !== null ? old('order') : 0 }}" maxlength="255" required>

			                    @if ($errors->has('order'))
									<span class="help-block">
										<strong>{{ $errors->first('order') }}</strong>
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
			                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
			                	<label for="description" class="col-sm-2 control-label">Descrição</label>
								<div class="col-sm-10">
			                    	<ui-textarea
				                  		name="description"
				                  		value="{{ old('description') }}"
				                  		></ui-textarea>

				                    @if ($errors->has('description'))
										<span class="help-block">
											<strong>{{ $errors->first('description') }}</strong>
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
