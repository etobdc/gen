@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('levels.update', $item->id) }}"
				cancel-url="{{ route('levels.index') }}"
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

				<div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
				  <label for="order" class="col-sm-2 control-label">Ordem*</label>

				  <div class="col-sm-10">
					<input type="number" name="order" class="form-control" id="order" value="{{ $item->order !== null ? $item->order : 0 }}" maxlength="255" required>

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
					<input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" maxlength="255" required>

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
							value="{{ $item->description }}"
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
	</div>
@endsection
