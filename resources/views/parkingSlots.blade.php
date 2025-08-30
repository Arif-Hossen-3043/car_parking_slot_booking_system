{{-- resources/views/parkingSlots.blade.php --}}

@extends(auth()->user()->is_admin ? 'layouts.admin' : 'layouts.userLayout')

@section('content')
<div class="container mt-4">
    <h2>🅿️ Parking Slots</h2>

    {{-- Add Slot Button (only for admin) --}}
    @if(auth()->user()->is_admin)
        <form action="{{ route('admin.parkingSlots.add') }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to add a new slot?');" 
              class="mb-3">
            @csrf
            <button type="submit" class="btn btn-success">➕ Add New Slot</button>
        </form>
    @endif

    {{-- Slots Grid --}}
    <div class="grid mt-3" style="display:grid; grid-template-columns:repeat(4, 1fr); gap:15px;">
        @foreach($slots as $slot)
            <div class="slot {{ $slot->is_booked ? 'booked' : '' }}"
                 style="background-color: {{ $slot->is_booked ? '#dc3545' : '#28a745' }};
                        color:white;
                        padding:30px 0;
                        text-align:center;
                        border-radius:10px;
                        transition:0.3s;">
                {{ $slot->slot_number }} <br>
                {{ $slot->is_booked ? 'Booked' : 'Available' }}

                {{-- Booking button only for regular users --}}
                @if(!$slot->is_booked && !auth()->user()->is_admin)
                    <form action="{{ url('/book/'.$slot->slot_number) }}" method="get" class="mt-2">
                        <button type="submit" class="btn btn-primary btn-sm">Book Slot</button>
                    </form>
                @endif
            </div>
        @endforeach
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
