{{-- resources/views/parkingSlots.blade.php --}}

@extends(auth()->user()->is_admin ? 'layouts.admin' : 'layouts.userLayout')

@section('content')
<div class="container mt-4">
    <h2>🅿️ Parking Slots</h2>
{{-- Add Slot Form (only for admin) --}}
@if(auth()->user()->is_admin)
  <form action="{{ route('admin.parkingSlots.add') }}" method="POST" class="mb-3">
    @csrf
    <div class="row g-2 align-items-center">
        <div class="col-auto">
            <select name="vehicle_type" class="form-select" required>
                <option value="">Select Vehicle Type</option>
                <option value="two_wheeler">Two-Wheeler</option>
                <option value="four_wheeler">Four-Wheeler</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success">➕ Add New Slot</button>
        </div>
    </div>
</form>

@endif


    {{-- Vehicle Type Filter --}}
    <form method="GET" action="{{ route('parking.slots') }}" class="mb-4">
        <label for="vehicle_type" class="form-label">Select Vehicle Type:</label>
        <select name="vehicle_type" id="vehicle_type" class="form-select w-50 d-inline-block">
            <option value="">-- All Types --</option>
            <option value="two_wheeler" {{ request('vehicle_type') == 'two_wheeler' ? 'selected' : '' }}>Two-Wheeler</option>
            <option value="four_wheeler" {{ request('vehicle_type') == 'four_wheeler' ? 'selected' : '' }}>Four-Wheeler</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    {{-- Slots Grid --}}
    <div class="grid mt-3" style="display:grid; grid-template-columns:repeat(4, 1fr); gap:15px;">
        @forelse($slots as $slot)
            <div class="slot {{ $slot->is_booked ? 'booked' : '' }}"
                 style="background-color: {{ $slot->is_booked ? '#dc3545' : '#28a745' }};
                        color:white;
                        padding:30px 0;
                        text-align:center;
                        border-radius:10px;
                        transition:0.3s;">
                <strong>{{ strtoupper($slot->vehicle_type) }}</strong><br>
                {{ $slot->slot_number }} <br>
                {{ $slot->is_booked ? 'Booked' : 'Available' }}

                {{-- Booking button only for regular users --}}
                @if(!$slot->is_booked && !auth()->user()->is_admin)
                    <form action="{{ url('/book/'.$slot->slot_number) }}" method="get" class="mt-2">
                        <button type="submit" class="btn btn-light btn-sm">Book Slot</button>
                    </form>
                    {{-- Check Availability button for every slot --}}
<form action="{{ url('/slot-availability/'.$slot->slot_number) }}" method="get" class="mt-2">
    <button type="submit" class="btn btn-info btn-sm">Check Availability</button>
</form>
                @endif
            </div>
        @empty
            <p>No slots available for this type.</p>
        @endforelse
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .grid {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        }
        .slot {
            padding: 20px 0;
            font-size: 14px;
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
    }
</style>
@endsection
