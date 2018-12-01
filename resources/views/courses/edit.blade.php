@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('courses.update', $item->id) }}"
				cancel-url="{{ route('courses.index') }}"
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

				<div class="form-group">
					<label class="col-sm-2 control-label"></label>

					<div class="col-sm-10">
						<div class="checkbox{{ $errors->has('active') ? ' has-error' : '' }}">
							<br>
							<label for="active">
								<input type="checkbox" name="active" id="active" {{ ($item->active == 1) ? 'checked' : '' }}> Ativo?
							</label>
						</div>

						@if ($errors->has('active'))
						<span class="help-block">
							<strong>{{ $errors->first('active') }}</strong>
						</span>
						@endif	
					</div>
				</div>
				<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
					<label class="col-sm-2 control-label">Imagem</label>

					<div class="col-sm-10">
						<div class="row">
						@if(strlen($item->image) > 0)
							<div class="col-md-1">
								<img src="{{ asset('storage/courses/'.$item->image) }}" style="width:100%">
							</div>
						@endif
						<div class="col-md-11">
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
				 <div class="form-group{{ $errors->has('teacher_id') ? ' has-error' : '' }}">
                  <label class="col-sm-2 control-label">Professor do Curso</label>

                  	<div class="col-sm-10">
                  		<ui-select
                  			name="teacher_id"
                  			id="teacher_id"
                  			:options="{{ $teachers }}"
                  			:selected="{{ $item->teacher_id }}"
                  			required="true"
                  			>				                  			
                  		</ui-select>

                  		@if ($errors->has('teacher_id'))
							<span class="help-block">
								<strong>{{ $errors->first('teacher_id') }}</strong>
							</span>
						@endif
                	</div>
                </div>
				<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
					<label class="col-sm-2 control-label">Categoria</label>
					<div class="col-sm-10">
						<ui-select
							name="category_id"
							id="category_id"
							:options="{{ $categories }}"
							:selected="{{ $item->category_id }}"
							required="true"
							>				                  			
						</ui-select>

						@if ($errors->has('category_id'))
						<span class="help-block">
							<strong>{{ $errors->first('category_id') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('level_id') ? ' has-error' : '' }}">
					<label class="col-sm-2 control-label">Nível</label>

					<div class="col-sm-10">
						<ui-select
							name="level_id"
							id="level_id"
							:options="{{ $levels }}"
							:selected="{{ $item->level_id }}"
							required="true"
							>				                  			
						</ui-select>

						@if ($errors->has('level_id'))
						<span class="help-block">
							<strong>{{ $errors->first('level_id') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
					<label for="lead" class="col-sm-2 control-label">Lead</label>

					<div class="col-sm-10">
						<input type="text" name="lead" class="form-control" id="lead" value="{{ $item->lead }}" maxlength="255">

						@if ($errors->has('lead'))
						<span class="help-block">
							<strong>{{ $errors->first('lead') }}</strong>
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
				<div class="form-group{{ $errors->has('details_title') ? ' has-error' : '' }}">
					<label for="details_title" class="col-sm-2 control-label">Título sessão detalhes</label>

					<div class="col-sm-10">
						<input type="text" name="details_title" class="form-control" id="details_title" value="{{ $item->details_title }}" maxlength="255">

						@if ($errors->has('details_title'))
						<span class="help-block">
							<strong>{{ $errors->first('details_title') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('details_description') ? ' has-error' : '' }}">
					<label for="details_description" class="col-sm-2 control-label">Descrição sessão detalhes</label>
					<div class="col-sm-10">
						<ui-textarea
							name="details_description"
							value="{{ $item->details_description }}"
							></ui-textarea>

						@if ($errors->has('details_description'))
						<span class="help-block">
							<strong>{{ $errors->first('details_description') }}</strong>
						</span>
						@endif
					</div>
				</div>
                <hr>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                	<label for="price" class="col-sm-2 control-label">Valor (R$)*</label>
					<div class="col-sm-10">
						<ui-money
							name="price"
							value="{{ $item->price }}"
							required="true"
							></ui-money>

	                    @if ($errors->has('price'))
							<span class="help-block">
								<strong>{{ $errors->first('price') }}</strong>
							</span>
						@endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Promoção</label>

                  	<div class="col-sm-10">
                  		<div class="checkbox{{ $errors->has('promotion_active') ? ' has-error' : '' }}">
          					<label for="promotion_active">
                  				<input type="checkbox" name="promotion_active" id="promotion_active" {{ $item->promotion_active ? 'checked' : '' }}> Ativa?
                  			</label>
                  		</div>

                  		@if ($errors->has('promotion_active'))
							<span class="help-block">
								<strong>{{ $errors->first('promotion_active') }}</strong>
							</span>
						@endif
                	</div>
                </div>
                <div class="form-group{{ $errors->has('promotional_price') ? ' has-error' : '' }}">
                	<label for="promotional_price" class="col-sm-2 control-label">Valor Promocional (R$)</label>
					<div class="col-sm-10">
						<ui-money
							name="promotional_price"
							value="{{ $item->promotional_price ? $item->promotional_price : 0 }}"
							required="false"
							></ui-money>

	                    @if ($errors->has('promotional_price'))
							<span class="help-block">
								<strong>{{ $errors->first('promotional_price') }}</strong>
							</span>
						@endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('promotional_phrase') ? ' has-error' : '' }}">
					<label for="promotional_phrase" class="col-sm-2 control-label">Frase de Promoção</label>

					<div class="col-sm-10">
						<input type="text" name="promotional_phrase" class="form-control" id="promotional_phrase" value="{{ $item->promotional_phrase }}" maxlength="255">

						@if ($errors->has('promotional_phrase'))
						<span class="help-block">
							<strong>{{ $errors->first('promotional_phrase') }}</strong>
						</span>
						@endif
					</div>
				</div>
			</ui-form>
		</div>
	</div>
@endsection
