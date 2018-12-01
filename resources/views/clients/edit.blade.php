@extends('layouts.page')

@section('content')
		<div class="row">
			<div class="col-md-12">
				<ui-form
	            	form-class="form-horizontal"
	            	title="Atualizar Registro"
	            	token="{{ csrf_token() }}"
	            	url="{{ route('clients.update', $item->id) }}"
	            	cancel-url="{{ route('clients.index') }}"
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
		                  <label for="name" class="col-sm-2 control-label">Nome Completo*</label>

		                  <div class="col-sm-10">
		                    <input type="text" name="name" class="form-control" id="name" maxlength="255" value="{{ $item->name }}" required>

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
		                    <input type="email" name="email" class="form-control" id="email" maxlength="255" value="{{ $item->email }}" required>

		                    @if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
		                  </div>
		                </div>
		                <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
		                  <label for="cpf" class="col-sm-2 control-label">CPF*</label>

		                  <div class="col-sm-10">
		                  	<ui-mask-input name="cpf" class-name="form-control" value="{{ $item->cpf }}" mask="###.###.###-##" required="true">
		                    
		                    @if ($errors->has('cpf'))
								<span class="help-block">
									<strong>{{ $errors->first('cpf') }}</strong>
								</span>
							@endif
		                  </div>
		                </div>
		                <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
		                  <label for="birthdate" class="col-sm-2 control-label">Data de Nascimento*</label>

		                  <div class="col-sm-10">
		                    <input type="text" name="birthdate" class="form-control" id="birthdate" maxlength="255" value="{{ mask_date($item->birthdate) }}" required>

		                    @if ($errors->has('birthdate'))
								<span class="help-block">
									<strong>{{ $errors->first('birthdate') }}</strong>
								</span>
							@endif
		                  </div>
		                </div>
		                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
		                  <label for="phone" class="col-sm-2 control-label">Telefone*</label>

		                  <div class="col-sm-10">
		                    <ui-phone name="phone" class-name="form-control" value="{{ $item->phone }}" required="true">

		                    @if ($errors->has('phone'))
								<span class="help-block">
									<strong>{{ $errors->first('phone') }}</strong>
								</span>
							@endif
		                  </div>
		                </div>
		                <div class="form-group{{ $errors->has('secondary_phone') ? ' has-error' : '' }}">
		                  <label for="secondary_phone" class="col-sm-2 control-label">Telefone Secundário</label>

		                  <div class="col-sm-10">
		                    <ui-phone name="secondary_phone" class-name="form-control" value="{{ $item->secondary_phone }}" required="true">
		                    
		                    @if ($errors->has('secondary_phone'))
								<span class="help-block">
									<strong>{{ $errors->first('secondary_phone') }}</strong>
								</span>
							@endif
		                  </div>
		                </div>
		                <div class="form-group">
		                  <label for="phone" class="col-sm-2 control-label">Endereço</label>

		                  <div class="col-sm-10">
		                    <div class="row">
		                    	<div class="col-md-3{{ $errors->has('zipcode') ? ' has-error' : '' }}">
		                    		<label>CEP</label>
				                    <input type="text" name="zipcode" class="form-control" id="zipcode" maxlength="255" value="{{ $item->zipcode }}" required>

				                    @if ($errors->has('zipcode'))
										<span class="help-block">
											<strong>{{ $errors->first('zipcode') }}</strong>
										</span>
									@endif
		                    	</div>
		                    	<div class="col-md-9{{ $errors->has('street') ? ' has-error' : '' }}">
		                    		<label>Rua*</label>
				                    <input type="text" name="street" class="form-control" id="street" maxlength="255" value="{{ $item->street }}" required>

				                    @if ($errors->has('street'))
										<span class="help-block">
											<strong>{{ $errors->first('street') }}</strong>
										</span>
									@endif
		                    	</div>
		                    	<br>
		                    	<div class="col-md-3{{ $errors->has('number') ? ' has-error' : '' }}">
		                    		<label>Número</label>
				                    <input type="text" name="number" class="form-control" id="number" maxlength="255" value="{{ $item->number }}" required>

				                    @if ($errors->has('number'))
										<span class="help-block">
											<strong>{{ $errors->first('number') }}</strong>
										</span>
									@endif
		                    	</div>
		                    	<div class="col-md-5{{ $errors->has('complement') ? ' has-error' : '' }}">
		                    		<label>Complemento</label>
				                    <input type="text" name="complement" class="form-control" id="complement" maxlength="255" value="{{ $item->complement }}">

				                    @if ($errors->has('complement'))
										<span class="help-block">
											<strong>{{ $errors->first('complement') }}</strong>
										</span>
									@endif
		                    	</div>
		                    	<div class="col-md-4{{ $errors->has('district') ? ' has-error' : '' }}">
		                    		<label>Bairro</label>
				                    <input type="text" name="district" class="form-control" id="district" maxlength="255" value="{{ $item->district }}" required>

				                    @if ($errors->has('district'))
										<span class="help-block">
											<strong>{{ $errors->first('district') }}</strong>
										</span>
									@endif
		                    	</div>
		                    	<br>
		                    	<div class="col-md-6{{ $errors->has('city') ? ' has-error' : '' }}">
		                    		<label>Cidade*</label>
				                    <input type="text" name="city" class="form-control" id="city" maxlength="255" value="{{ $item->city }}" required>

				                    @if ($errors->has('city'))
										<span class="help-block">
											<strong>{{ $errors->first('city') }}</strong>
										</span>
									@endif
		                    	</div>
		                    	<div class="col-md-6{{ $errors->has('state') ? ' has-error' : '' }}">
		                    		<label>Estado*</label>
				                    <ui-select
				                  		name="state"
				                  		id="state"
				                  		required="true"
				                  		:options="{{ uf_states() }}"
				                  		selected="{{ $item->state }}"
				                  		required="true"
				                  		>
				                  	</ui-select>

				                    @if ($errors->has('state'))
										<span class="help-block">
											<strong>{{ $errors->first('state') }}</strong>
										</span>
									@endif
		                    	</div>
		                    </div>
		                  </div>
		                </div>

			            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		                  <label for="password" class="col-sm-2 control-label">Senha</label>

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
