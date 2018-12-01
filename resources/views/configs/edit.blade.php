@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('configs.update', $item->id) }}"
				cancel-url="{{ route('configs.index') }}"
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
				  <label for="name" class="col-sm-2 control-label">Nome*</label>

				  <div class="col-sm-10">
					<input type="text" name="name" class="form-control" disabled id="name" value="{{ $item->name }}" maxlength="250" readonly>

					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
				  <label for="keywords" class="col-sm-2 control-label">Keywords*</label>

				  <div class="col-sm-10">
					<input type="text" name="keywords" class="form-control" id="keywords" value="{{ $item->keywords }}" maxlength="250" required>

					@if ($errors->has('keywords'))
						<span class="help-block">
							<strong>{{ $errors->first('keywords') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
					<label for="description" class="col-sm-2 control-label">Description*</label>
					<div class="col-sm-10">
						<textarea
							class="col-sm-12"
							style="resize:none;" rows="4"
							name="description"
							required
							>{{ $item->description }}</textarea>

						@if ($errors->has('description'))
							<span class="help-block">
								<strong>{{ $errors->first('description') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
				  <label for="facebook" class="col-sm-2 control-label">Facebook</label>

				  <div class="col-sm-10">
					<input type="url" name="facebook" class="form-control" id="facebook" value="{{ $item->facebook }}" maxlength="250">

					@if ($errors->has('facebook'))
						<span class="help-block">
							<strong>{{ $errors->first('facebook') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('linkedin') ? ' has-error' : '' }}">
				  <label for="linkedin" class="col-sm-2 control-label">Linkedin</label>

				  <div class="col-sm-10">
					<input type="url" name="linkedin" class="form-control" id="linkedin" value="{{ $item->linkedin }}" maxlength="250">

					@if ($errors->has('linkedin'))
						<span class="help-block">
							<strong>{{ $errors->first('linkedin') }}</strong>
						</span>
					@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
				  <label for="endereco" class="col-sm-2 control-label">Endereço*</label>

				  <div class="col-sm-10">
					<input type="text" name="endereco" class="form-control" id="endereco" value="{{ $item->endereco }}" maxlength="350" required>

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
				<div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
				  <label for="telefone" class="col-sm-2 control-label">Telefone*</label>

				  <div class="col-sm-10">
						<ui-phone
						name="telefone"
						value="{{ $item->telefone }}"
						required="true"
						class_name="form-control col-xs-12"
						/>

						@if ($errors->has('telefone'))
							<span class="help-block">
								<strong>{{ $errors->first('telefone') }}</strong>
							</span>
						@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('telefone_2') ? ' has-error' : '' }}">
				  <label for="telefone_2" class="col-sm-2 control-label">Outro telefone - WhatsApp</label>

				  <div class="col-sm-10">
						<ui-phone
						name="telefone_2"
						value="{{ $item->telefone_2 }}"
						class_name="form-control col-xs-12"
						/>

						@if ($errors->has('telefone_2'))
							<span class="help-block">
								<strong>{{ $errors->first('telefone_2') }}</strong>
							</span>
						@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('telefone_3') ? ' has-error' : '' }}">
				  <label for="telefone_3" class="col-sm-2 control-label">Outro telefone - WhatsApp</label>

				  <div class="col-sm-10">
						<ui-phone
						name="telefone_3"
						value="{{ $item->telefone_3 }}"
						class_name="form-control col-xs-12"
						/>

						@if ($errors->has('telefone_3'))
							<span class="help-block">
								<strong>{{ $errors->first('telefone_3') }}</strong>
							</span>
						@endif
				  </div>
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				  <label for="email" class="col-sm-2 control-label">E-mail*</label>

				  <div class="col-sm-10">
					<input type="email" name="email" class="form-control" id="email" value="{{ $item->email }}" maxlength="50" required>

					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				  </div>
				</div>
			</ui-form>
		</div>
	</div>
@endsection
