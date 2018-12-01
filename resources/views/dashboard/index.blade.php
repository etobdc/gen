@extends('layouts.page')

@section('content')

    <div class="row">
    @if (0 > 1)
		<div class="col-md-12">
            <div class="col-md-12">
	            <div class="box box-default">
		            <div class="box-header with-border">
		              <h3 class="box-title">Estatísticas de Vendas</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              	@foreach($counters['courses'] as $key => $value)
			                <div class="progress-group">
			                    <span class="progress-text">{{ $value['name'] }}</span>
			                    <span class="progress-number"><b>{{ $value['value'] }}</b>/{{ $counters['totalOrders'] }}</span>

			                    <div class="progress sm">
			                      <div class="progress-bar progress-bar-{{ $value['color'] }}" style="width: {{ $value['percent'] }}%"></div>
			                    </div>
			                </div>
		              	@endforeach
		        	</div>
	        	</div>
	        </div>
		</div>
    @endIf
		<div class="col-md-12">
			<div class="col-md-4 col-xs-12">
        <a href="{{ route('imovel.index') }}">
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>{{ $totalImoveis }}</h3>
              <p>Imóveis</p>
            </div>
            <div class="icon">
              <i class="fa fa-home"></i>
            </div>
          </div>
        </a>
      </div>
		</div>
	</div>

@endsection
