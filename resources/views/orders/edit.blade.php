@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ui-form
				form-class="form-horizontal"
				title="Atualizar Registro"
				token="{{ csrf_token() }}"
				url="{{ route('orders.update', $item->id) }}"
				cancel-url="{{ route('orders.index') }}"
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
					<label class="col-sm-2 control-label">Cliente</label>

					<div class="col-sm-10">
						<a href="{{ route('clients.show', $client->id) }}" target="_blank" data-toggle="tooltip" title="Ver Cliente">
							<big>
							#{{ $client->id }} - {{ $client->name }}
							</big>
							<br>
							<span>{{ $client->email }}</span>
						</a>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Curso comprado</label>

					<div class="col-sm-10">
						<table class="table">
							<tr>
								<th>Curso</th>
								<th>Valor</th>
							</tr>
							<tr>
								<td>
									<a href="{{ route('courses.edit', $course->id) }}" target="_blank" data-toggle="tooltip" title="Ver Curso">
										<big>
										#{{ $course->id }} - {{ $course->name }}
										</big>
									</a>
								</td>
								<td>
									R${{ number_format($item->price/100, 2, ',', '.') }}
								</td>
							</tr>

						</table>
						<div class="row">
							<div class="col-md-4">
								
							</div>
						</div>
					</div>
				</div>
				<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
					<label class="col-sm-2 control-label">Status</label>
					<div class="col-sm-10">
						<ui-select
							name="status"
							id="status"
							:options="{{ $status_select }}"
							:selected="{{ $item->status }}"
							required="true"
							>				                  			
						</ui-select>

						@if ($errors->has('status'))
						<span class="help-block">
							<strong>{{ $errors->first('status') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Disponibilidade</label>

					<div class="col-sm-10">
						<div class="row">
							<div class="col-md-8">
								<label>Acesso até</label><br>
								
								<ui-mask-input
									name="end"
									value="{{ mask_date($item->end, false) }}"
									required="true"
									class-name="form-control"
									mask="##/##/####"
									></ui-mask-input>

			                    @if ($errors->has('end'))
									<span class="help-block">
										<strong>{{ $errors->first('end') }}</strong>
									</span>
								@endif
							</div>
							<div class="col-md-4">
								<br>
								<div class="checkbox{{ $errors->has('available') ? ' has-error' : '' }}">
									<label for="available">
										<input type="checkbox" name="available" id="available" {{ ($item->available == 1) ? 'checked' : '' }}> Disponível?
									</label>
								</div>

								@if ($errors->has('available'))
								<span class="help-block">
									<strong>{{ $errors->first('available') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
			</ui-form>
		</div>
	</div>
@endsection
