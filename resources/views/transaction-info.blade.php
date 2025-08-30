@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 500px; width:100%; border: none;">
        <h2 class="mb-4 text-center text-success fw-bold">💳 Enter Your Transaction ID</h2>

        <!-- Form -->
        <form id="transactionForm">
            @csrf
            <div class="mb-3">
                <input type="text" 
                       name="transaction_id" 
                       id="transaction_id" 
                       placeholder="Enter Transaction ID" 
                       class="form-control form-control-lg text-center border-success rounded-3 shadow-sm" 
                       required>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-3 shadow-sm">
                ✅ Submit
            </button>
        </form>

        <!-- Success Message -->
        <div id="successMessage" 
             class="alert alert-success mt-4 fw-semibold text-center rounded-3 shadow-sm" 
             style="display:none; font-size: 1.1rem;">
        </div>
    </div>
</div>

<style>
    body {
        background: #f5f8fa;
    }
    .card {
        animation: fadeIn 0.6s ease-in-out;
    }
    #transaction_id:focus {
        border-color: #28a745;
        box-shadow: 0 0 8px rgba(40,167,69,0.3);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
document.getElementById('transactionForm').addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('transaction-info.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            // Hide form
            document.getElementById('transactionForm').style.display = "none";
            // Show success message
            let msg = document.getElementById('successMessage');
            msg.style.display = "block";
            msg.innerText = data.message;
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endsection
