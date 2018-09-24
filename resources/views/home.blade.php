@extends('layouts.app')

@section('content')

<div class="col-md-12" style="min-height: 40px">
    <strong>Mis Aplicaciones</strong>
    <a class="btn btn-primary btn-sm float-right" href="#">Nueva Aplicación</a>
</div>
@foreach($applications as $application)
<div class="card {{ $application->status == 'A' ? 'border-success' : 'border-danger' }}" style="margin-bottom: 1rem">
    <div class="card-header">
        {{$application->name}}
        <a class="btn btn-danger btn-sm float-right" href="{{ route('seeApplication', $application->id) }}">{{ __('ELIMINAR') }}</a>
        <a class="btn {{ $application->status == 'A' ? 'btn-warning' : 'btn-success' }} btn-sm float-right" href="{{ route('seeApplication', $application->id) }}">{{ $application->status == 'A' ? __('INACTIVAR') : __('ACTIVAR') }}</a>
        <a class="btn btn-primary btn-sm float-right" href="{{ route('seeApplication', $application->id) }}">{{ __('ACTUALIZAR') }}</a>
    </div>
    <div class="card-body {{ $application->status == 'A' ? 'text-success' : 'text-danger' }}" style="padding: 0.25rem 1.25rem">
    	<div class="form-group row" style="margin-bottom: 0.25rem">
    		<label for="email" class="col-sm-4 col-form-label text-md-left">{{ __('URL') }}</label>
	        <div class="col-md-6">
	            <input class="form-control " name="email" value="{{ $application->code . '.' . config('app.url_applications', '127.0.0.1')}}" readonly>
    		</div>
    	</div>
    	<div class="form-group row" style="margin-bottom: 0.25rem">
    		<label for="email" class="col-sm-4 col-form-label text-md-left">{{ __('FECHA MODIFICACIÓN') }}</label>
	        <div class="col-md-6">
	            <input class="form-control " name="email" value="{{ $application->updated_at }}" readonly>
    		</div>	
    	</div>
    	<div class="form-group row" style="margin-bottom: 0.25rem">
    		<label for="email" class="col-sm-4 col-form-label text-md-left">{{ __('FECHA INICIO') }}</label>
	        <div class="col-md-6">
	            <input class="form-control " name="email" value="{{ $application->started_at }}" readonly>
    		</div>
    	</div>
	</div>
	<div class="card-footer">
		<a class="btn btn-primary btn-sm float-right" href="{{ route('seeApplication', $application->id) }}">Ver más</a>
	</div>
</div>
@endforeach

@endsection
