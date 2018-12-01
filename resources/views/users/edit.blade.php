@extends('layouts.page')

@section('content')
		<div class="row">
			<div class="col-md-12">
				<ui-form
	            	form-class="form-horizontal"
	            	title="Atualizar Registro"
	            	token="{{ csrf_token() }}"
	            	url="{{ route('users.update', $item->id) }}"
	            	cancel-url="{{ route('users.index') }}"
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

		              	<div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
			                <label for="group_id" class="col-sm-2 control-label">Imagem</label>

			                <div class="col-sm-10">
			                	<div class="row">
	                  				@if(strlen($item->image) > 0)
		                  			<div class="col-md-1">
		                  				<img src="{{ asset('storage/users/'.$item->image) }}" style="width:100%">
		                  			</div>
	                  				@endif

		                  			<div class="col-md-11">
				                  		<input type="file" name="image">

				                  		<div class="checkbox">
				                  			<label for="remove-image">
				                  				<input type="checkbox" name="remove-image" id="remove-image"> Remover ícone?
				                  				<input type="hidden" name="old-image" value="{{ $item->image }}">
				                  			</label>
				                  		</div>
		                  			</div>
		                  		</div>
			                </div>
			            </div>

			            <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
			                <label for="group_id" class="col-sm-2 control-label">Grupo*</label>

			                <div class="col-sm-10">
			                	<ui-select
			                  		name="group_id"
			                  		id="group_id"
			                  		required="true"
			                  		:options="{{ $groups }}"
			                  		selected="{{ $item->group_id }}"
			                  		>
			                  	</ui-select>

			                    @if ($errors->has('group_id'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
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
		                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		                  <label for="email" class="col-sm-2 control-label">E-mail*</label>

		                  <div class="col-sm-10">
		                    <input type="text" name="email" class="form-control" id="email" value="{{ $item->email }}" maxlength="255" required>

		                    @if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
		                  </div>
		                </div>
		                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
		                  <label for="username" class="col-sm-2 control-label">Usuário*</label>

		                  <div class="col-sm-10">
		                    <input type="text" name="username" class="form-control" id="username" value="{{ $item->username }}" maxlength="255" required>

		                    @if ($errors->has('username'))
								<span class="help-block">
									<strong>{{ $errors->first('username') }}</strong>
								</span>
							@endif
		                  </div>
		                </div>
		                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		                  <label for="password" class="col-sm-2 control-label">Senha*</label>

		                  <div class="col-sm-10">
		                    <input type="text" name="password" class="form-control" id="password" maxlength="255">

		                    <span class="help-block">
								Para manter a senha atual, não preencha este campo
							</span>

		                    @if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
		                  </div>
		                </div>

		              </ui-form>
			</div>
		</div>

@endsection
