@extends('layouts.page')

@section('content')
		<div class="row">
			<div class="col-md-12">
				<ui-form
	            	form-class="form-horizontal"
	            	title="Atualizar Registro"
	            	token="{{ csrf_token() }}"
	            	url="{{ route('configurations.update', $item->id) }}"
	            	cancel-url="{{ route('configurations.index') }}"
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
	                  <label for="name" class="col-sm-2 control-label">Configuração</label>

	                  <div class="col-sm-10">
	                    <input type="text" class="form-control" id="name" value="{{ $item->name }}" maxlength="255" disabled>
	                  </div>
	                </div>
	                <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
	                  <label for="value" class="col-sm-2 control-label"></label>

	                  <div class="col-sm-10">
	                    @switch($item->type)
	                    	@case('text')
	                    		<input type="text" name="value" class="form-control" id="value" value="{{ $item->value }}" maxlength="255">
	                    		@break
	                    	
	                    	@case('number')
	                    		<input type="number" name="value" class="form-control" id="value" value="{{ $item->value }}">
	                    		@break

                    		@case('decimal')
	                    		<input type="number" name="value" class="form-control" id="value" value="{{ $item->value }}" step="0.01">
	                    		@break

	                    @endswitch

	                    <span class="help-block">
							<strong>{{ $item->description }}</strong>
						</span>

	                    @if ($errors->has('value'))
							<span class="help-block">
								<strong>{{ $errors->first('value') }}</strong>
							</span>
						@endif
	                  </div>
	                </div>
	            </ui-form>
			</div>
		</div>

@endsection