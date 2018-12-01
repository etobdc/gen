@extends('layouts.page')

@section('content')
		<div class="row">
			<div class="col-md-12">
				<div class="box box-widget">
					<div class="box-header with-border">
						<h3 class="box-title">Detalhes do Cliente</h3>
					</div>
				<div class="box-body">
					<div class="form-group col-md-12">
	                  <h3>{{ $item->name }}</h3>

	                  <p>
	                  	<b>E-mail: </b>{{ $item->email }}<br>
	                  	<b>CPF: </b>{{ mask_cpf($item->cpf) }}<br>
	                  	<b>Data de Nascimento: </b>{{ mask_date($item->birthdate) }}<br>
	                  </p>
	                  <hr>
	                  <h4>Dados de Contato</h4>
	                  <p>
	                  	<b>Telefone: </b>{{ mask_phone($item->phone, false) }}<br>
	                  	<b>Telefone Celular: </b>{{ mask_phone($item->cellphone, false) }}<br>
	                  </p>
	                  <hr>
	                  <h4>Endereço</h4>
	                  <p>
	                  	<b>Rua: </b>{{ $item->street }}, <b>Número</b> {{ $item->number }}
	                  	{{ strlen($item->complement) ? '<b>Complemento:</b>' . $item->complement : '' }}<br>
	                  	<b>Bairro: </b>{{ $item->district }}<br>
	                  	<b>Cidade/UF: </b>{{ $item->city }} - {{ $item->state }}<br>
	                  	<b>CEP: </b>{{ $item->zipcode }}<br>
	                  </p>
	                  <hr>
	                  <h4>Cursos Comprados:</h4>
	                  <table class="table table-stripped">
	                  	<tr>
	                  		<th>#</th>
	                  		<th>Data</th>
	                  		<th>Curso</th>
	                  		<th>Pagamento</th>
	                  		<th>Disponibilidade</th>
	                  		<th>Acesso até</th>
	                  		<th>Ações</th>
	                  	</tr>
	                  	@foreach($orders as $key => $value)
	                  	<tr>
	                  		<th>{{ $value->id }}</th>
	                  		<td>{{ mask_datetime($value->created_at, false) }}</td>
	                  		<td>{{ $value->course->name }}</td>
	                  		<td>
	                  			<label class="label label-{{ $value->status['status'] }}">{{ $value->status['text'] }}</label>
	                  		</td>
	                  		<td>
	                  			<label class="label label-{{ $value->available['status'] }}">{{ $value->available['text'] }}</label>
	                  		</td>
	                  		<td>{{ mask_date($value->end, false) }}</td>
	                  		<td>
	                  			<a href="{{ route('orders.edit', $value->id) }}" target="_blank" class="btn btn-primary btn-flat" data-toggle="tooltip" title="Editar Item">
	                  				<i class="fa fa-pencil"></i>
	                  			</a>
	                  		</td>
	                  	</tr>
	                  	@endforeach
	                  </table>
	                </div>
				</div>
                <div class="box-footer">
                  <a class="btn btn-flat btn-default" href="{{ route('clients.index') }}"><i class="fa fa-arrow-left"></i> Voltar</a>
                </div>
			</div>
		</div>

@endsection
