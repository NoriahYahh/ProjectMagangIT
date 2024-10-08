@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ash Fusion Temperature</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ashfts.update', ['activity' => $activity->id, 'shipment' => $shipment->id, 'ashft' => $ashft->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="shipment_id" value="{{ old('shipment_id', $shipment->id) }}">
        <input type="hidden" name="activity_id" value="{{ old('activity_id', $activity->id) }}">

        <div class="form-group">
            <label for="idt">IDT:</label>
            <input type="number" name="idt" class="form-control" id="idt" value="{{ old('idt', $ashft->idt) }}" required>
        </div>

        <div class="form-group">
            <label for="st">ST:</label>
            <input type="number" name="st" class="form-control" id="st" value="{{ old('st', $ashft->st) }}" required>
        </div>

        <div class="form-group">
            <label for="ht">HT:</label>
            <input type="number" name="ht" class="form-control" id="ht" value="{{ old('ht', $ashft->ht) }}" required>
        </div>

        <div class="form-group">
            <label for="ft">FT:</label>
            <input type="number" name="ft" class="form-control" id="ft" value="{{ old('ft', $ashft->ft) }}" required>
        </div>

        <div class="form-group">
            <label for="idt1">IDT1:</label>
            <input type="number" name="idt1" class="form-control" id="idt1" value="{{ old('idt1', $ashft->idt1) }}" required>
        </div>

        <div class="form-group">
            <label for="st1">ST1:</label>
            <input type="number" name="st1" class="form-control" id="st1" value="{{ old('st1', $ashft->st1) }}" required>
        </div>

        <div class="form-group">
            <label for="ht1">HT1:</label>
            <input type="number" name="ht1" class="form-control" id="ht1" value="{{ old('ht1', $ashft->ht1) }}" required>
        </div>

        <div class="form-group">
            <label for="ft1">FT1:</label>
            <input type="number" name="ft1" class="form-control" id="ft1" value="{{ old('ft1', $ashft->ft1) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('ashfts.index', ['activity' => $activity->id, 'shipment' => $shipment->id]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
